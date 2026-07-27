<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\TelegramUser;
use Illuminate\Support\Facades\Cache;

class FetchTelegramUpdates extends Command
{
    protected $signature = 'telegram:fetch';
    protected $description = 'Ambil pesan & nomor HP dari Telegram secara berkala';

    public function handle()
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $offset = Cache::get('telegram_offset', 0);

        $response = Http::get("https://api.telegram.org/bot{$token}/getUpdates", [
            'offset' => $offset,
            'timeout' => 5
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (!empty($data['result'])) {
                foreach ($data['result'] as $update) {
                    $offset = $update['update_id'] + 1;
                    Cache::put('telegram_offset', $offset);

                    if (isset($update['message'])) {
                        $chatId    = $update['message']['chat']['id'];
                        $firstName = $update['message']['chat']['first_name'] ?? 'User';
                        $username  = $update['message']['chat']['username'] ?? null;

                        // CEK 1: Jika user mengirim kontak (nomor HP via tombol)
                        if (isset($update['message']['contact'])) {
                            $phoneNumber = $update['message']['contact']['phone_number'];

                            // Simpan nomor HP ke database berdasarkan chat_id
                            TelegramUser::updateOrCreate(
                                ['chat_id' => $chatId],
                                [
                                    'first_name' => $firstName,
                                    'username'   => $username,
                                    'phone'      => '+'.$phoneNumber // Pastikan kolom 'phone' ada di tabel
                                ]
                            );

                            $this->info("Nomor HP {$phoneNumber} berhasil disimpan untuk Chat ID: {$chatId}");

                            // Balas pesan sukses & bersihkan keyboard
                            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                                'chat_id' => $chatId,
                                'text'    => "Terima kasih! Nomor HP Anda ({$phoneNumber}) telah berhasil disimpan.",
                                'reply_markup' => json_encode(['remove_keyboard' => true])
                            ]);
                        }
                        // CEK 2: Jika user baru pertama chat (Kirim tombol minta No HP)
                        else {
                            $this->sendRequestContactButton($token, $chatId, $firstName);
                        }
                    }
                }
            }
        }
    }

    private function sendRequestContactButton($token, $chatId, $firstName)
    {
        $keyboard = [
            'keyboard' => [
                [
                    [
                        'text' => '📱 Bagikan Nomor HP Saya',
                        'request_contact' => true // Fitur resmi Telegram untuk ambil No HP
                    ]
                ]
            ],
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ];

        Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chatId,
            'text'    => "Halo {$firstName}! Silakan klik tombol di bawah ini untuk verifikasi nomor WhatsApp/Telegram Anda secara otomatis:",
            'reply_markup' => json_encode($keyboard)
        ]);
    }
}
