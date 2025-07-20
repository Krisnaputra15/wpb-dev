<?php

namespace App\Http\Controllers;

use App\Helper\GeneralHelper;
use App\Models\Company;
use App\Models\CompanyRegistrationInput;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index($id = null){
        $companyInputs = CompanyRegistrationInput::all();

        $columns = [
            'users.id',
            'fullname',
            'phone_number',
            'is_active',
            'username',
            'role',
            'companies.name',
            'companies.logo',
            'companies.job_vacancies_link'
        ];
        foreach($companyInputs->pluck('column_name') as $column){
            $columns[] = 'companies.'.$column;
        }
        $user = User::leftJoin('companies', 'companies.id', 'users.company_id')
                    ->where('users.id', $id == null ? Auth::user()->id : $id)
                    ->select($columns)
                    ->first();
        $readOnly = $id == null ? false : true;
        return view('admin.profile.edit', compact('user','companyInputs', 'readOnly'));
    }

    public function update(Request $request){
        $companyInputs = CompanyRegistrationInput::all();
        $rules = [
            'fullname' => 'nullable|string',
            'phone_number' => 'nullable|string|min:10|max:15',
            'is_active' => 'required|boolean',
            'password' => 'nullable|string|confirmed',
            'username' => 'required|string',
            'role' => 'required|string|in:administrator,humas,perwakilan-perusahaan',
            'companies-logo' => 'nullable|image|mimes:jpeg,jpg,png',
            'companies-job_vacancies_link' => 'nullable|url',
        ];
        if(Auth::user()->role == 'perwakilan-perusahaan'){
            foreach($companyInputs as $input){
                $detailRule = '';
                if($input->is_nullable){
                    $detailRule = 'nullable';
                } else {
                    $detailRule = 'required';
                }

                if($input->column_type == 'number'){
                    $detailRule.= '|numeric';
                } else {
                    $detailRule.= '|string';
                }
                $rules['companies-'.$input->column_name] = $detailRule;
            }
        }
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $fields = array_keys($request->except(['_method','_token']));
        $exceptionFields = ['password_confirmation'];
        $user = User::find($request->id);
        if(Auth::user()->role == 'perwakilan-perusahaan'){
            $company = $user->company_id == null ? new Company() : Company::find($user->company_id);
            $company->save();
            $companyId = $company->id;
            $user->company_id = $companyId;
        }

        foreach($fields as $field){
            if(in_array($field, $exceptionFields)) continue;

            $explode = explode('-', $field);
            if(count($explode) > 1){
                if($explode[1] == 'logo'){
                    $logoPath = GeneralHelper::uploadFile(
                        Company::class,
                        $request->file($field),
                        'images/company/logo',
                        $user->company_id == null ? '' : $companyId,
                        'logo'
                    );
                    $company->{$explode[1]} = $logoPath;
                    continue;
                }
                $company->{$explode[1]} = $request->input($field);
            } else {
                $user->$field = $field == 'password' ? Hash::make($request->input($field)) : $request->input($field);
            }
        }
        $user->save();
        if(Auth::user()->role == 'perwakilan-perusahaan'){
            $company->save();
        }

        toastr()->success('Berhasil menyimpan data profil');
        return redirect()->route('profile.index');
    }
}
