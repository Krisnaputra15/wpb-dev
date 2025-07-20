<?php

namespace App\Http\Controllers;

use App\Helper\GeneralHelper;
use App\Models\BoothTransaction;
use App\Models\RegisteredBooth;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Browsershot\Browsershot;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;
use Spatie\LaravelPdf\Facades\Pdf;

class BoothTransactionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Auth::user()->role;
        $status = GeneralHelper::getStatusColor();

        return view('admin.transaction.index', compact('role', 'status'));
    }

    public function fetch(Request $request){
        $columns = ['bt.id', 'a.name as agenda_name', 'bt.created_at', 'a.start_date', 'a.end_date', 'bt.status', 'bt.total_price', 'bt.additional_fee_price', 'u.fullname as user_name', 'c.name as company_name'];
        $user = Auth::user();

        $data = BoothTransaction::from('booth_transactions as bt')
                                ->join('agenda_participants as ap', 'ap.id', 'bt.participant_id')
                                ->join('agendas as a', 'a.id', 'ap.agenda_id')
                                ->join('users as u', 'u.id', 'ap.user_id')
                                ->leftJoin('companies as c', 'c.id', 'u.company_id')
                                ->select($columns);

        $output = [];

        if($user->role == 'perwakilan-perusahaan'){
            $data = $data->where('u.id', $user->id);
        }

        if($request->query('isRecap')){
            $data = $data->where('bt.status', 'selesai');
        }

        foreach($request->query('searches') as $value){
            if($value['value'] == null || $value['value'] == '') continue;
            if($value['name'] == 'bt.start_date'){
                $data = $data->whereDate('bt.created_at', '>=', $value['value']);
            } else if($value['name'] == 'bt.end_date'){
                $data = $data->whereDate('bt.created_at', '<=', $value['value']);
            } else {
                $data = $data->where($value['name'], 'like', '%'.$value['value'].'%');
            }
        }

        if($request->query('paginated')){
            $data = $data->paginate(10);
            $statusColor = GeneralHelper::getStatusColor();
            $transformedData = $data->getCollection()->map(function($item) use($statusColor){
                $totalPrice = $item->total_price;
                if($item->additional_fee_price != null){
                    $arrAdditional = json_decode($item->additional_fee_price, true);
                    $totalPrice += array_sum(array_column($arrAdditional, 'amount'));
                }

                return (object) [
                    'id' => $item->id,
                    'agenda_name' => $item->agenda_name,
                    'created_at' => $item->created_at->locale('id_ID')->isoFormat('D MMMM Y'),
                    'start_date' => $item->start_date,
                    'end_date' => $item->end_date,
                    'raw_status' => $item->status,
                    'status' => '<p class="text-'.$statusColor[$item->status][0].' m-0">: '.ucwords($item->status).'</p>',
                    'total_price' => number_format($totalPrice, 0, ',', '.'),
                    'company_name' => $item->company_name,
                    'user_name' => $item->user_name,
                    'link' => Auth::user()->role == 'perwakilan-perusahaan' && $item->status == 'belum checkout' ? route('boothOrder.checkout', [$item->id]) : route('boothTransaction.show', [$item->id]),
                ];
            });
            $data->setCollection($transformedData);
        } else {
            $data = $data->get();
        }

        return response()->json([
            'data' => $data,
            'message' => 'berhasil mendapatkan transaksi booth',
            'additional_data' => $statusColor
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bookedBooth = RegisteredBooth::from('registered_booths as rb')
                                    ->join('booth_layouts as bl', 'bl.id', 'rb.booth_layout_id')
                                    ->join('booths as b', 'b.id', 'bl.booth_id')
                                    ->select('rb.id', 'bl.label', 'b.type', 'b.default_price', 'b.description')
                                    ->where('rb.booth_transaction_id', $id)
                                    ->get();
        $transaction = BoothTransaction::from('booth_transactions as bt')
                                ->join('agenda_participants as ap', 'ap.id', 'bt.participant_id')
                                ->join('agendas as a', 'a.id', 'ap.agenda_id')
                                ->join('users as u', 'u.id', 'ap.user_id')
                                ->leftJoin('companies as c', 'c.id', 'u.company_id')
                                ->where('bt.id', $id)
                                ->select(['bt.*', 'c.name', 'u.fullname', 'u.id as user_id', 'u.phone_number'])
                                ->first();
        // dd((array)json_decode($transaction->additional_transaction_items));
        $statusColor = GeneralHelper::getStatusColor();
        $setting = Setting::select('surat_permohonan_template_file')->first();
        return view('admin.transaction.show', compact('bookedBooth', 'transaction', 'statusColor', 'setting'));
    }
    public function editBooth(string $id){
        $boothTransaction = BoothTransaction::from('booth_transactions as bt')
                   ->join('agenda_participants as ap', 'ap.id', 'bt.participant_id')
                   ->join('agendas as a', 'a.id', 'ap.agenda_id')
                   ->select('a.*')
                   ->where('bt.id', $id)
                   ->first();
        if(!$boothTransaction){
            abort(404);
        }
        return view('admin.transaction.editBooth', compact('id', 'boothTransaction'));
    }

    public function updateBooth(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'registered_booth_id.*' => 'required|exists:registered_booths,id'
        ]);

        if($validator->fails()){
            toastr()->error('Pilihan booth tidak valid / sudah terisi, silakan pilih ulang booth');
            return redirect()->route('boothTransaction.editBooth', [$id]);
        }

        $updateRegisteredBooth = RegisteredBooth::where('booth_transaction_id', $id)
                                                ->update([
                                                    'booth_transaction_id' => null,
                                                    'is_booked' => 0
                                                ]);

        $boothData = RegisteredBooth::from('registered_booths as rb')
                                    ->whereIn('rb.id', $request->input('registered_booth_id'))
                                    ->sum('rb.fixed_price');

        $prevTransaction = BoothTransaction::find($id);
        $newTotalPrice = $boothData;
        if($prevTransaction->additional_transaction_items != null){
            $prevAdditionalItems = (array)json_decode($prevTransaction->additional_transaction_items, true);
            $prevprevAdditionalItemsTotalPrice = array_sum($prevAdditionalItems['total_price']);
            $newTotalPrice += $prevprevAdditionalItemsTotalPrice;
        }

        $totalAdditionalFee = GeneralHelper::calculateAdditionalFee($newTotalPrice);

        $newTransaction = BoothTransaction::where('id', $id)->update([
            'total_price' => $newTotalPrice,
            'additional_fee_price' => json_encode($totalAdditionalFee)
        ]);

        $updateBooth = RegisteredBooth::whereIn('id', $request->input('registered_booth_id'))->update([
            'booth_transaction_id' => $id,
            'is_booked' => 1,
        ]);

        if($updateRegisteredBooth & $updateBooth){
            toastr()->success('Berhasil melakukan perubahan pilihan booth');
            return redirect()->route('boothTransaction.show', [$id]);
        } else {
            toastr()->error('Gagal melakukan perubahan pilihan booth');
            return redirect()->back();
        }
    }

    public function editTransactionItem(string $id){
        $transaction = BoothTransaction::find($id);
        return view('admin.transaction.editTransaction', compact('transaction'));
    }

    public function updateTransactionItem(Request $request, string $id){
        $validator = validator::make($request->all(), [
            'additional_transaction_items.name.*' => 'required|string',
            'additional_transaction_items.price.*' => 'required|numeric|min:1',
            'additional_transaction_items.quantity.*' => 'required|numeric|min:1',
            'additional_transaction_items.description.*' => 'nullable|string',
            'additional_transaction_items.unit.*' => 'required|string|min:1',
            'additional_transaction_items.total_price.*' => 'required|numeric|min:1',
        ]);

        if($validator->fails()){
            dd($validator->errors());
            toastr()->error('Input data item transaksi tertiban tidak valid, silakan coba lagi');
            return redirect()->route('boothTransaction.editTransactionItem', [$id]);
        }

        $transaction = BoothTransaction::find($id);

        $items = $request->input('additional_transaction_items', []);
        $totalPrice = $transaction->total_price;
        if($transaction->additional_transaction_items != null){
            $prevAdditionalItems = (array)json_decode($transaction->additional_transaction_items, true);
            $prevTotalPrice = array_sum($prevAdditionalItems['total_price']);
            $totalPrice -= $prevTotalPrice;
        }

        $newTotalPrice = array_sum($items['total_price']);
        $totalPrice += $newTotalPrice;

        $totalAdditionalFee = GeneralHelper::calculateAdditionalFee($totalPrice);

        $transaction->additional_transaction_items = json_encode($request->input('additional_transaction_items'));
        $transaction->additional_fee_price = json_encode($totalAdditionalFee);
        $transaction->total_price = $totalPrice;
        $transaction->save();

        toastr()->success('Berhasil melakukan perubahan data item transaksi');
        return redirect()->route('boothTransaction.show', [$id]);
    }

    public function uploadPaymentProof(Request $request, $id){
        $validator = Validator::make($request->except(['_method','_token']), [
            'payment_proof_file' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'tax_payment_proof_file' => 'required|file|mimes:pdf,jpg,jpeg,png'
        ]);

        if($validator->fails()){
            toastr()->error('Input file tidak valid, silakan coba lagi');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $payload = $request->except(['_method', '_token']);

        $transaction = BoothTransaction::find($id);
        foreach($payload as $key => $value) {
            $transaction->$key = GeneralHelper::uploadFile(
                BoothTransaction::class,
                $request->file($key),
                'misc/transaction/'.$id,
                $id,
                $key,
                $key
            );
        }
        $transaction->status = 'menunggu verifikasi pembayaran';
        $transaction->save();

        toastr()->success('Berhasil unggah bukti pembayaran');
        return redirect()->route('boothTransaction.show', [$id]);
    }

    public function uploadSuratPermohonan(Request $request, $id){
        $validator = Validator::make($request->except(['_method','_token']), [
            'surat_permohonan_file' => 'required|file|mimes:pdf,doc,docx'
        ]);

        if($validator->fails()){
            toastr()->error('Input file tidak valid, silakan coba lagi');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $transaction = BoothTransaction::find($id);
        $transaction->surat_permohonan_file = GeneralHelper::uploadFile(
            BoothTransaction::class,
            $request->file('surat_permohonan_file'),
            'misc/transaction/'.$id,
            $id,
            'surat_permohonan_file',
            'surat_permohonan_file'
        );
        $transaction->status = $transaction->is_verified ? 'menunggu pembayaran' : 'menunggu verifikasi transaksi';
        $transaction->save();

        toastr()->success('Berhasil unggah surat permohonan');
        return redirect()->route('boothTransaction.show', [$id]);
    }

    public function uploadFakturFile(Request $request, $id){
        $validator = Validator::make($request->except(['_method','_token']), [
            'faktur_file' => 'required|file|mimes:pdf,doc,docx'
        ]);

        if($validator->fails()){
            toastr()->error('Input file tidak valid, silakan coba lagi');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $transaction = BoothTransaction::find($id);
        $transaction->faktur_file = GeneralHelper::uploadFile(
            BoothTransaction::class,
            $request->file('faktur_file'),
            'misc/transaction/'.$id,
            $id,
            'faktur_file',
            'faktur_file'
        );
        $transaction->save();

        toastr()->success('Berhasil unggah faktur');
        return redirect()->route('boothTransaction.show', [$id]);
    }

    public function verifyTransaction(Request $request, $id){
        $validator = Validator::make($request->except(['_method','_token']), [
            'is_verified' => 'required|numeric|in:0,1',
            'rejection_reason' => 'nullable|string'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $transaction = BoothTransaction::find($id);
        $transaction->is_verified = $request->is_verified;
        if($request->is_verified){
            $transaction->status = $transaction->surat_permohonan_file != null ? 'menunggu pembayaran' : 'belum upload surat permohonan';
        } else {
            $transaction->status = 'ditolak';
            $transaction->rejection_reason = $request->rejection_reason;
        }

        $transaction->save();

        toastr()->success('Berhasil memverifikasi transaksi');
        return redirect()->route('boothTransaction.show', [$id])->with('success', 'Berhasil verifikasi transaksi');
    }

    public function verifyPayment(Request $request, $id){
        $validator = Validator::make($request->except(['_method','_token']), [
            'is_payment_verified' => 'required|numeric|in:0,1',
            'rejection_reason' => 'nullable|string'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $transaction = BoothTransaction::find($id);
        $transaction->is_payment_verified = $request->is_payment_verified;
        $transaction->status = $request->is_payment_verified ? 'selesai' : 'ditolak';
        $transaction->rejection_reason = $request->rejection_reason ?? null;

        $transaction->save();

        toastr()->success('Berhasil memverifikasi pembayaran transaksi');
        return redirect()->route('boothTransaction.show', [$id])->with('success', 'Berhasil verifikasi transaksi');
    }

    public function generateInvoice(string $id){
        // try{

        // } catch(\Exception $e){
        //     toastr()->error('Gagal mengunduh invoice, silakan coba lagi');
        //     return redirect()->route('boothTransaction.show', $id);
        // }
        $setting = Setting::first();

            $bookedBooths = RegisteredBooth::from('registered_booths as rb')
                                        ->join('booth_layouts as bl', 'bl.id', 'rb.booth_layout_id')
                                        ->join('booths as b', 'b.id', 'bl.booth_id')
                                        ->select('rb.id', 'b.name', 'bl.label', 'b.type', 'b.default_price', 'rb.fixed_price', 'b.description', 'b.name as booth_name')
                                        ->where('rb.booth_transaction_id', $id)
                                        ->get();

            $columns = ['bt.id', 'bt.additional_transaction_items', 'bt.additional_fee_price', 'bt.payment_type', 'a.name as agenda_name', 'bt.created_at', 'a.start_date', 'a.end_date', 'bt.status', 'bt.transaction_number', 'bt.total_price', 'c.name as company_name'];
            $transaction = BoothTransaction::from('booth_transactions as bt')
                                        ->join('agenda_participants as ap', 'ap.id', 'bt.participant_id')
                                        ->join('agendas as a', 'a.id', 'ap.agenda_id')
                                        ->join('users as u', 'u.id', 'ap.user_id')
                                        ->leftJoin('companies as c', 'c.id', 'u.company_id')
                                        ->where('bt.id', $id)
                                        ->select($columns)
                                        ->first()
                                        ->toArray();
            $items = $transaction['additional_transaction_items'];
            $additionalFee = $transaction['additional_fee_price'];
            $grandTotal = $transaction['total_price'];
            if($items != null){
                $items = json_decode($items, true);
            }
            if($additionalFee != null){
                $additionalFee = json_decode($additionalFee, true);
                $grandTotal += (int) array_sum(array_column($additionalFee, 'amount'));
            }
            $transaction['grand_total_terbilang'] = GeneralHelper::generateTerbilang($grandTotal);
            $transaction['grand_total'] = number_format($grandTotal, 0, ',', '.');
            $transaction['total_price'] = number_format($transaction['total_price'], 0, ',', '.');
            $transaction['created_at'] = Carbon::parse($transaction['created_at']);
            $transaction['invoice_generated'] = $transaction['created_at']->locale('id_ID')->isoFormat('D MMMM Y');
            $transaction['start_date'] = Carbon::parse($transaction['start_date'])->locale('id_ID')->isoFormat('D MMMM Y');
            $transaction['end_date'] = Carbon::parse($transaction['end_date'])->locale('id_ID')->isoFormat('D MMMM Y');
            $currentDate = Carbon::now()->locale('id_ID')->isoFormat('D MMMM Y');
            return view('admin.transaction.newInvoice', ['bookedBooths' => $bookedBooths, 'items' => $items, 'additionalFee' => $additionalFee, 'transaction' => $transaction,'setting' => $setting,'currentDate' => $currentDate, 'id' => $id]);

            // $pdf = LaravelMpdf::loadView('admin.transaction.newInvoice', ['bookedBooths' => $bookedBooths, 'items' => $items, 'additionalFee' => $additionalFee, 'transaction' => $transaction,'setting' => $setting,'currentDate' => $currentDate]);
            // return $pdf->stream('invoice_'.$transaction['company_name'].'_'.$transaction['agenda_name'].'.pdf');
            // $pdf = Browsershot::html(view('admin.transaction.newInvoice', ['bookedBooths' => $bookedBooths, 'items' => $items, 'additionalFee' => $additionalFee, 'transaction' => $transaction,'setting' => $setting,'currentDate' => $currentDate])->render())
            //                 ->noSandbox()
            //                 ->disableJavascript()
            //                 ->waitUntilNetworkIdle()
            //                 ->debug(true)
            //                 ->timeout(60)
            //                 ->pdf();
            // return response($pdf)
            // ->header('Content-Type', 'application/pdf')
            // ->header('Content-Disposition', 'invoice_'.$transaction['company_name'].'_'.$transaction['agenda_name'].'.pdf');
    }
}
