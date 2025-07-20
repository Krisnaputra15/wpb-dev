<?php

namespace App\Http\Controllers;

use App\Jobs\sendBatchEmail;
use App\Models\CompanyContact;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Services\EmailService;

class PromotionMessageController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.promotionMessage.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message_template' => 'nullable',
            'wa_message_template' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $setting = Setting::first();
        $setting->message_template = $request->message_template;
        $setting->wa_message_template = $request->wa_message_template;
        $setting->save();

        if ($setting) {
            toastr()->success('Pesan promosi berhasil diubah');
            return redirect()->route('promotionMessage.index');
        } else {
            toastr()->error('Pesan promosi gagal diubah, silakan coba lagi');
            return redirect()->route('promotionMessage.index');
        }
    }

    public function sendView()
    {
        return view('admin.promotionMessage.send');
    }

    public function send(Request $request)
    {
        $payload = $request->only(['receiver-type', 'message_type', 'receivers']);
        if ($payload['receiver-type'] == 'choosen') {
            $newReceiver = [];
            foreach ($payload['receivers'] as $receiver) {
                $newReceiver[] = json_decode($receiver, true);
            }
            $payload['receivers'] = $newReceiver;
        } else {
            $payload['receivers'] = CompanyContact::select(['id', 'email', 'phone_number'])->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'email' => $item->email,
                    'phone_number' => '62' . substr($item->phone_number, 1)
                ];
            })->toArray();
        }

        $setting = Setting::first();

        $checkIsTemplateEmpty = false;
        if($payload['message_type'] != 'all'){
            $checkIsTemplateEmpty = $setting->{($payload['message_type'] == 'wa' ? 'wa_' : '').'message_template'} == null;
        } else {
            $checkIsTemplateEmpty = $setting->message_template == null && $setting->wa_message_template == null;
        }

        if($checkIsTemplateEmpty){
            return response()->json(['message' => 'Template pesan yang dipilih masih kosong, silakan isi terlebih dahulu'], 404);
        }

        $errors = [];
        try {
            if ($request->message_type == 'all') {
                $sendEmail = $this->sendEmail($setting, $payload['receivers']);
                $sendWa = $this->sendWa($setting, $payload['receivers']);
            } else {
                $method = 'send' . ucwords($request->message_type);
                $sendWa = $this->$method($setting, $payload['receivers']);
            }
        } catch (\Exception $e) {
            $errors[] = [
                'email' => $receiver->email,
                'message' => $e->getMessage()
            ];
        }
        // foreach ($payload['receivers'] as $receiver) {
        //     try {
        //         if ($request->message_type == 'all') {
        //             $this->sendEmail($setting, $receiver);
        //             $this->sendWa($setting, $receiver);
        //         } else {
        //             $method = 'send' . ucwords($request->message_type);
        //             $this->$method($setting, $receiver);
        //         }
        //     } catch (\Exception $e) {
        //         $errors[] = [
        //             'email' => $receiver->email,
        //             'message' => $e->getMessage()
        //         ];
        //     }
        // }

        if (count($errors) == 0) {
            return response()->json(['message' => 'Pesan promosi berhasil dikirim'], 200);
        } else {
            return response()->json(['message' => 'Gagal mengirimkan pesan promosi, silakan coba lagi', 'additionalData' => $errors], 500);
        }
    }

    function sendEmail($setting, $receiver)
    {
        $emailService = new EmailService();
        $html = view('admin.promotionMessage.message', ['data' => $setting->message_template]);
        return $emailService->send($html, $receiver, 'Brawijaya Festival');
    }

    function sendWa($setting, $receiver)
    {
        $token = 'u7DXWohrYGhcMvkK6TCX';

        $fixedReceiver = implode(",", array_column($receiver, 'phone_number'));
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target'      => str_replace('62', '0', $fixedReceiver),
            'message'     => $setting->wa_message_template,
            'delay'       => '2',
            'countryCode' => '62',
        ]);

        return $response->body();
    }
}
