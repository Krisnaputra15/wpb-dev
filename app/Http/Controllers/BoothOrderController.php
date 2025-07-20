<?php

namespace App\Http\Controllers;

use App\Helper\GeneralHelper;
use App\Models\Agenda;
use App\Models\AgendaParticipant;
use App\Models\BoothTransaction;
use App\Models\RegisteredBooth;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BoothOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.boothOrder.index');
    }

    public function fetchAgenda(Request $request){
        $agenda = Agenda::where('is_active', 1)->whereNotNull('layout_id');
        foreach($request->all() as $key => $value){
            $explode = explode('_', $key);
            if(count($explode) == 1){
                if($value != '' || $value != null){
                    $agenda = $agenda->where($key, 'LIKE', '%'.$value.'%');
                }
            } else {
                if($explode[count($explode)-1] == 'date'){
                    if($value != '' || $value != null){
                        $agenda = $agenda->whereDate($key, $explode[0] == 'start' ? '>=' : '<=', $value);
                    }
                }
            }
        }
        $agenda = $agenda->get();
        return response()->json(['data' => $agenda], 200);
    }

    public function boothSelection($agendaId){
        $agenda = Agenda::with('layout')->findOrFail($agendaId);
        return view('admin.boothOrder.booth-selection', compact('agenda'));
    }

    public function boothSelectionStore(Request $request, $agendaId){
        $validator = Validator::make($request->all(), [
            'registered_booth_id.*' => 'required|exists:registered_booths,id'
        ]);

        if($validator->fails()){
            toastr()->error('Pilihan booth tidak valid / sudah terisi, silakan pilih ulang booth');
            return redirect()->route('boothOrder.booth-selection', ['agendaId' => $agendaId]);
        }

        $boothData = RegisteredBooth::from('registered_booths as rb')
                                    ->whereIn('rb.id', $request->input('registered_booth_id'))
                                    ->sum('rb.fixed_price');

        $totalAdditionalFee = GeneralHelper::calculateAdditionalFee($boothData);

        $participant = AgendaParticipant::create([
            'agenda_id' => $agendaId,
            'user_id' => Auth::user()->id
        ]);

        $transaction = BoothTransaction::create([
            'transaction_number' => BoothTransaction::count()+1,
            'participant_id' => $participant->id,
            'status' => 'belum checkout',
            'total_price' => $boothData,
            'additional_fee_price' => json_encode($totalAdditionalFee),
            'is_paid' => 0,
            'is_verified' => 0,
            'is_payment_verified' => 0,
        ]);

        $updateBooth = RegisteredBooth::whereIn('id', $request->input('registered_booth_id'))->update([
            'booth_transaction_id' => $transaction->id,
            'is_booked' => 1,
        ]);

        return redirect()->route('boothOrder.checkout', [$transaction->id]);
    }

    public function checkout($transactionId){
        $boothData = RegisteredBooth::from('registered_booths as rb')
                                    ->join('booth_layouts as bl', 'bl.id', 'rb.booth_layout_id')
                                    ->join('booths as b', 'b.id', 'bl.booth_id')
                                    ->select('rb.id', 'bl.label', 'b.type', 'b.default_price', 'b.description')
                                    ->where('rb.booth_transaction_id', $transactionId)
                                    ->get();
        $transaction = BoothTransaction::find($transactionId)->toArray();
        $setting = Setting::select([
            'booth_bank_account_code',
            'booth_bank_account_name',
            'booth_bank_account_number',
            'tax_bank_account_code',
            'tax_bank_account_name',
            'tax_bank_account_number',
            ])->first();

        return view('admin.boothOrder.checkout', compact('boothData','transaction', 'setting'));
    }

    public function checkoutSave(Request $request, $transactionId){
        $validator = Validator::make($request->all(), [
            'payment_type' =>'required|string|in:transfer,direct',
            'feature_request' => 'nullable|string',
            'additional_request' => 'nullable|string',
        ],
        [
            'payment_type.required' => 'Metode pembayaran tidak boleh kosong',
            'payment_type.in' => 'Metode pembayaran tidak valid',
        ]
        );

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $payload = $request->except(['_method', '_token']);
        $payload['status'] = 'belum upload surat permohonan';
        $transaction = BoothTransaction::where('id', $transactionId)->update($payload);

        toastr()->success('Berhasil menyelesaikan transaksi');
        return redirect()->route('boothTransaction.show', $transactionId);
    }
}
