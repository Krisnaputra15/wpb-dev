<?php

namespace App\Http\Controllers;

use App\Models\BoothTransaction;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $setting = Setting::first();
        if(in_array(Auth::user()->role, ['humas','perwakilan-perusahaan'])){
            $latestTransactions = BoothTransaction::from('booth_transactions as bt')
                                              ->join('agenda_participants as ap', 'ap.id', 'bt.participant_id')
                                              ->join('agendas as a', 'a.id', 'ap.agenda_id')
                                              ->join('users as u', 'u.id', 'ap.user_id')
                                              ->leftJoin('companies as c', 'c.id', 'u.company_id')
                                              ->select(['bt.id', 'bt.created_at', 'a.name as agenda_name', 'u.fullname', 'c.name as company_name','bt.additional_fee_price', 'bt.total_price','bt.status']);
            $totalTransaction = BoothTransaction::from('booth_transactions as bt')
                                                ->join('agenda_participants as ap', 'ap.id', 'bt.participant_id')
                                                ->join('users as u', 'u.id', 'ap.user_id');
            $unverifiedTransaction = $completedTransaction = $canceledTransaction = $totalTransaction;
            if(Auth::user()->role == 'perwakilan-perusahaan'){
                $latestTransactions = $latestTransactions->where('u.id', Auth::user()->id);
                $totalTransaction = $totalTransaction->where('u.id', Auth::user()->id);
                $unverifiedTransaction = $unverifiedTransaction->where('u.id', Auth::user()->id);
                $completedTransaction = $completedTransaction->where('u.id', Auth::user()->id);
                $canceledTransaction = $canceledTransaction->where('u.id', Auth::user()->id);
            }
            $latestTransactions = $latestTransactions->orderBy('bt.created_at', 'desc')
                                                     ->limit(5)->get()->map(function($item) use($setting){
                                                        $totalAdditional = 0;
                                                        // dd($item->additional_fee_price);
                                                        if($item->additional_fee_price != null){
                                                            $additional = json_decode($item->additional_fee_price, true);
                                                            $totalAdditional += array_sum(array_column($additional, 'amount'));
                                                        }

                                                        return (object)[
                                                            'id' => $item->id,
                                                            'created_at' => $item->created_at->locale('id_ID')->isoFormat('D MMMM Y'),
                                                            'agenda_name' => $item->agenda_name,
                                                            'fullname' => $item->fullname,
                                                            'company_name' => $item->company_name,
                                                            'status' => $item->status,
                                                            'total_amount' => number_format($item->total_price + $totalAdditional, 0, ',', '.'),
                                                        ];
                                                     });
            $totalTransaction = $totalTransaction->count();
            $unverifiedTransaction = $unverifiedTransaction->whereIn('bt.status', ['menunggu verifikasi transaksi','menunggu verifikasi pembayaran','belum upload surat permohonan'])->count();
            $completedTransaction = $completedTransaction->where('bt.status', 'selesai')->count();
            $canceledTransaction = $canceledTransaction->where('bt.status', 'ditolak')->count();

            return view('admin.dashboard', compact('totalTransaction', 'unverifiedTransaction', 'completedTransaction','canceledTransaction', 'latestTransactions'));
        } else {
            return view('admin.dashboard');
        }
    }
}
