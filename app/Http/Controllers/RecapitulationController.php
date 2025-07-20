<?php

namespace App\Http\Controllers;

use App\Models\BoothTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecapitulationController extends Controller
{
    public function index(){
        return view('admin.recap.index');
    }

    public function show(string $id){
        $columns = ['bt.id', 'a.name as agenda_name', 'bt.documentation_link', 'bt.applicant_recap_link', 'a.start_date', 'a.end_date', 'bt.status', 'bt.total_price', 'u.fullname as user_name', 'c.name as company_name'];
        $transaction = BoothTransaction::from('booth_transactions as bt')
                                ->join('agenda_participants as ap', 'ap.id', 'bt.participant_id')
                                ->join('agendas as a', 'a.id', 'ap.agenda_id')
                                ->join('users as u', 'u.id', 'ap.user_id')
                                ->leftJoin('companies as c', 'c.id', 'u.company_id')
                                ->select($columns)->where('bt.id',$id)->first()->toArray();
        $transaction['documentation_link'] = json_decode($transaction['documentation_link']);
        $transaction['applicant_recap_link'] = json_decode($transaction['applicant_recap_link']);

        return view('admin.recap.show', compact('transaction'));
    }

    public function update(Request $request, string $id){
        $keys = array_keys($request->except(['_method', '_token']));
        $payload = array();
        $rules = array();

        foreach($keys as $key){
            $rules[$key.'.*'] ='required|string';
            if (!empty(array_filter($request->$key, fn($v) => !is_null($v)))) {
                $payload[$key] = json_encode($request->$key);
            }
        }

        $validator = Validator::make($request->except(['_method', '_token']), $rules);
        if($validator->fails()){
            toastr()->error('Input link tidak valid, silakan coba lagi');
            return redirect()->route('recap.show', $id)->withErrors($validator)->withInput($request->all());
        }

        $update = BoothTransaction::where('id', $id)->update($payload);

        if($update){
            toastr()->success('Berhasil mengubah link');
            return redirect()->route('recap.show', $id);
        } else {
            toastr()->error('Gagal mengubah link, silakan coba lagi');
            return redirect()->route('recap.show', $id);
        }
    }
}
