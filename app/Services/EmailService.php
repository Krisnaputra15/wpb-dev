<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;

class EmailService
{

    public function send($html, $receivers, $subject)
    {
        foreach ($receivers as $data) {
            $mail = new PHPMailer(true); // fresh instance per user
            try {
                $mail->isSMTP();
                $mail->Host       = env('MAIL_HOST');
                $mail->SMTPAuth   = true;
                $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');
                $mail->Username   = env('MAIL_USERNAME');
                $mail->Password   = env('MAIL_PASSWORD');
                $mail->Port       = env('MAIL_PORT', 587);

                $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->addAddress($data['email'], $data['name']);
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $html;

                $mail->send();
            } catch (\Exception $e) {
                Log::error("Gagal kirim ke {$data['email']}: " . $e->getMessage());
            }
        }
    }
}
