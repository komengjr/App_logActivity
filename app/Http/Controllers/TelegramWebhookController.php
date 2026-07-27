<?php

namespace App\Http\Controllers;

use App\TelegramUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelegramWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Ambil data pesan dari update Telegram
        $update = $request->all();

        // Pastikan ada pesan masuk
        if (isset($update['message'])) {
            $chatId    = $update['message']['chat']['id'];
            $firstName = $update['message']['chat']['first_name'] ?? 'User';
            $username  = $update['message']['chat']['username'] ?? null;
            $text      = $update['message']['text'] ?? '';

            // Simpan atau update ke database agar tidak duplikat
            TelegramUser::updateOrCreate(
                ['chat_id' => $chatId],
                [
                    'first_name' => $firstName,
                    'username'   => $username,
                ]
            );

            // Opsional: Kirim balasan otomatis ke pengguna
            $token = env('TELEGRAM_BOT_TOKEN');
            $replyText = "Halo {$firstName}! Chat ID Anda ({$chatId}) berhasil disimpan ke sistem kami.";

            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text'    => $replyText,
            ]);
        }

        return response()->json(['status' => 'success']);
    }
}
