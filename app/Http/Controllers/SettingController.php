<?php

namespace App\Http\Controllers;

use App\Helper\GeneralHelper;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(){
        $setting = Setting::first();
        if(!$setting){
            $setting = Setting::create([
                'default_email' => '',
                'message_template' => '',
                'default_wa_number' => '',
                'booth_bank_account_code' => '',
                'booth_bank_account_name' => '',
                'booth_bank_account_number' => '',
                'booth_bank_account_owner' => '',
                'tax_bank_account_code' => '',
                'tax_bank_account_name' => '',
                'tax_bank_account_number' => '',
                'tax_bank_account_owner' => '',
                'surat_permohonan_template_file' => '',
                'invoice_number_format' => ''
            ]);
        }
        $bankList = GeneralHelper::generateIndonesiaBankList();
        return view('admin.setting.index', compact('setting', 'bankList'));
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'default_email' => 'nullable|email|max:255',
            'message_template' => 'nullable|string|max:255',
            'default_wa_number' => 'nullable|string|max:15',
            'booth_bank_account_code' => 'nullable|string|max:4',
            'booth_bank_account_name' => 'nullable|string|max:255',
            'booth_bank_account_number' => 'nullable|numeric|digits_between:1,50',
            'booth_bank_account_owner' => 'nullable|string|max:255',
            'tax_bank_account_code' => 'nullable|string|max:4',
            'tax_bank_account_name' => 'nullable|string|max:255',
            'tax_bank_account_number' => 'nullable|numeric|digits_between:1,50',
            'tax_bank_account_owner' => 'nullable|string|max:255',
            'surat_permohonan_template_file' => 'nullable|file|mimes:doc,docx,pdf',
            'invoice_number_format' => 'required|string',
            'additional_fee_settings.fee_name.*' => 'nullable|string',
            'additional_fee_settings.fee_type.*' => 'nullable|string|in:percentage,exact,formula',
            'additional_fee_settings.fee_tax_type.*' => 'nullable|string|in:tax,non-tax',
            'additional_fee_settings.fee_value.*' => 'nullable|string'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $payload = $request->except(['_method', '_token']);

        $setting = Setting::first();

        if($request->hasFile('surat_permohonan_template_file')){
            $payload['surat_permohonan_template_file'] = GeneralHelper::uploadFile(
                Setting::class,
                $request->file('surat_permohonan_template_file'),
                'misc/setting',
                $setting->id ?? '',
                'surat_permohonan_template_file',
                'surat_permohonan_template'
            );
        }

        if(!empty($request->additional_fee_settings['fee_name'][0]) && !empty($request->additional_fee_settings['fee_value'][0])){
            $payload['additional_fee_settings'] = json_encode($request->additional_fee_settings);
        } else {
            $payload['additional_fee_settings'] = null;
        }

        if($setting){
            $setting->update($payload);
        } else {
            $setting = Setting::create($payload);
        }

        toastr()->success('Pengaturan berhasil diubah');
        return redirect()->route('setting.index');
    }
}
