<?php

namespace App\Http\Controllers;

use App\TelegramUser;
use Telegram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function log_telegram()
    {
        $data = DB::table('telegram_log')->get();
        return view('telegram.log-view', ['data' => $data]);
    }
    public function update()
    {
        $updates = Telegram::getUpdates();
        dd($updates);
    }
    public function getupdates()
    {
        // $updates = Telegram::getUpdates(offset = NULL, limit = 100L, timeout = 0L, allowed_updates = NULL);
        $updates = Telegram::getUpdates();

        // dd($updates);
        $data = DB::table('telegram_log')->get();
        // dd($updates);
        // dd(count($data));
        $data_arr = array();
        if (count($updates) == count($data) || $data->isEmpty()) {
            return 0;
        } else {
            if (count($updates) == 0) {
                return 0;
            } else {
                foreach ($updates as $data) {

                    $cek = DB::table('telegram_log')->where('update_id', $data['update_id'])->first();
                    if (!$cek) {

                        if ($data['message']['chat']['type'] == "supergroup") {
                            $datachat = "notifikasi-grup";
                            $chatid = $data['message']['chat']['id'];
                        } elseif ($data['message']['chat']['type'] == "private") {
                            $datachat = $data['message']['text'];
                            $chatid = $data['message']['chat']['id'];
                        }


                        DB::table('telegram_log')->insert([
                            'update_id' => $data['update_id'],
                            'chat_id' => $data['message']['from']['id'],
                            'first_name' => $data['message']['from']['first_name'],
                            'last_name' => $data['message']['from']['last_name'],
                            'text' => $datachat,
                            'date' => $data['message']['date'],
                            'created_at' => now()
                        ]);
                        $data_arr[] = array(
                            'update_id' => $data['update_id'],
                            'chat_id' => $data['message']['from']['id'],
                            'first_name' => $data['message']['from']['first_name'],
                            'last_name' => $data['message']['from']['last_name'],
                            'text' => $datachat,
                            'date' => $data['message']['date'],
                        );
                        $nama_depan = $data['message']['from']['first_name'];
                        $no_hp = substr($datachat, 10);
                        $no_tiket = substr($datachat, 10);
                        if ($datachat == '/start') {
                            Telegram::sendMessage([
                                'chat_id' => $chatid,
                                'text' => "Halo " . $nama_depan . "\nPerkenalkan Nama Saya SOLEH , Ada Yang Bisa Saya Bantu \nKetik /help untuk bantuan",
                            ]);
                        } elseif ($datachat == '/help') {
                            Telegram::sendMessage([
                                'chat_id' => $chatid,
                                'text' => "/help : Bantuan\n/start : Memulai Chat.\n/updateno_<no_hp> : Update No Hp.\n/cekkasus_<no_tiket> : Cek Status Laporan.\n/laporanbaru : Membuat Laporan Baru \n/info : Informasi",
                            ]);
                        } elseif ($datachat == '/updateno_' . $no_hp) {
                            $datapersonal = DB::table('telegram_chat_no')->where('chat_id', $chatid)->first();
                            if ($datapersonal) {
                                DB::table('telegram_chat_no')->where('chat_id', $chatid)
                                    ->update([
                                        'no_hp' => $no_hp,
                                        'nama_depan' => $data['message']['chat']['first_name'],
                                        'nama_belakang' => $data['message']['chat']['last_name'],
                                        'updated_at' => now()
                                    ]);
                            } else {
                                DB::table('telegram_chat_no')->insert([
                                    'chat_id' => $chatid,
                                    'no_hp' => $no_hp,
                                    'nama_depan' => $data['message']['chat']['first_name'],
                                    'nama_belakang' => $data['message']['chat']['last_name'],
                                    'created_at' => now()
                                ]);
                            }
                            Telegram::sendMessage([
                                'chat_id' => $chatid,
                                'text' => "No Anda Telah diperbahurui dengan : " . $no_hp,
                            ]);
                        } elseif ($datachat == '/cekkasus_' . $no_tiket) {
                            $datalaporan = DB::table('tbl_laporan_user')->where('tiket_laporan', $no_tiket)->first();
                            if ($datalaporan) {
                                if ($datalaporan->status_laporan == 2) {
                                    Telegram::sendMessage([
                                        'chat_id' => $chatid,
                                        'text' => "Laporan Dengan No Tiket : " . $no_tiket . " Sudah Selesai",
                                    ]);
                                } elseif ($datalaporan->status_laporan < 2) {
                                    Telegram::sendMessage([
                                        'chat_id' => $chatid,
                                        'text' => "Laporan Dengan No Tiket : " . $no_tiket . " Belum Selesai",
                                    ]);
                                }
                            } else {
                                Telegram::sendMessage([
                                    'chat_id' => $chatid,
                                    'text' => "Laporan Dengan No Tiket : " . $no_tiket . " Tidak di Temukan",
                                ]);
                            }
                        } elseif (is_numeric($datachat)) {
                            Telegram::sendMessage([
                                'chat_id' => $chatid,
                                'text' => 'No Hp :' . $data['message']['text'] . ' Sudah Didaftarkan',
                            ]);
                        } elseif ($datachat == '/laporanbaru') {
                            Telegram::sendMessage([
                                'chat_id' => $chatid,
                                'text' => 'http://logit.pramita.co.id:2023/newcase',
                            ]);
                        } elseif ($datachat == '/info') {
                            $info = DB::table('telegram_chat_no')->where('chat_id', $chatid)->first();
                            if ($info) {
                                Telegram::sendMessage([
                                    'chat_id' => $chatid,
                                    'text' => "Status No Hp Terdaftar \nDengan No : " . $info->no_hp,
                                ]);
                            } else {
                                Telegram::sendMessage([
                                    'chat_id' => $chatid,
                                    'text' => "Status No Hp Belum Terdaftar \nSegera Daftar Dengan ketik /updateno_<no_hp>",
                                ]);
                            }
                        } elseif ($datachat == 'notifikasi-grup') {
                            Telegram::sendMessage([
                                'chat_id' => $chatid,
                                'text' => "Notifikasi Group",
                            ]);
                        } else {
                            Telegram::sendMessage([
                                'chat_id' => $chatid,
                                'text' => 'Kode Yang Anda Masukan Salah',
                            ]);
                        }
                    }
                }
                // $datafull = DB::table('telegram_log')->get();
                // return view('telegram.notif-telegram',['data'=>$datafull]);
                if (empty($data_arr)) {
                    return 0;
                } else {
                    return response()->json($data_arr);
                }
            }
        }
        // return response()->json($data_arr);
        // return ($data_arr);
        // echo json_encode($data_arr);
        // exit;
        // dd($data_arr);
        // return 'masuk';
    }
    public function sendmessage(Request $request)
    {
        Telegram::sendMessage([
            'chat_id' => '1258044592',
            'text' => $request->pesan,
        ]);
        // $updates = Telegram::commandsHandler(true);
        // $chat_id = $updates->getChat()->getId();
        // $username = $updates->getChat()->getFirstName();

        // if(strtolower($updates->getMessage()->getText() === 'halo')) return Telegram::sendMessage([
        //     'chat_id' => $chat_id,
        //     'text' => 'Halo ' . $username
        // ]);
        return redirect()->back();
    }
    public function getway_whatsapp()
    {
        $data = DB::table('v_log_whatsapp')->where('v_log_whatsapp_status', 0)->first();
        return response()->json($data);
    }
    public function getway_whatsapp_status($code)
    {
        $data = DB::table('v_log_whatsapp')->where('v_log_whatsapp_code', $code)->first();
        if ($data) {
            # code...
            $telegram = DB::table('telegram_users')->where('phone', $data->v_log_whatsapp_number)->first();
            if ($telegram) {
                Telegram::sendMessage([
                    'chat_id' => $telegram->chat_id,
                    'text' => $data->v_log_whatsapp_text,
                ]);
            }
            DB::table('v_log_whatsapp')->where('v_log_whatsapp_code', $code)->update([
                'v_log_whatsapp_status' => 1
            ]);
        }
        return response()->json('Berhasil Kirim');
    }
    public function getway_whatsapp_update(Request $request)
    {
        DB::table('v_log_whatsapp')->where('v_log_whatsapp_code', $request->code)->update([
            'v_log_whatsapp_status' => $request->status
        ]);
        return response()->json('Berhasil Kirim');
    }

    /// OTP
    public function password_send_otp(Request $request)
    {
        // 1. Ambil data user yang sedang login (Menggunakan Auth session)
        $user = DB::table('tbl_biodata')->where('id_user', Auth::user()->id_user)->first();
        $phoneNumber = $user->phone_number;

        // 2. Generate 6 Digit Angka Acak
        $otpCode = rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(5); // Berlaku 5 menit

        // 3. Simpan kode OTP ke tabel password_otp_tokens
        DB::table('password_otp_tokens')->insert([
            'phone_number' => $phoneNumber,
            'otp_code' => $otpCode,
            'expires_at' => $expiresAt,
            'is_used' => false,
            'created_at' => Carbon::now()
        ]);

        // 4. Integrasi Vendor SMS/WhatsApp Gateway Anda di sini
        // Contoh: $this->whatsAppService->send($phoneNumber, "Kode OTP Anda adalah: " . $otpCode);

        return response()->json([
            'success' => true,
            'message' => 'Kode OTP berhasil dikirim ke nomor HP Anda.'
        ]);
    }
    public function password_update(Request $request)
    {
        // 1. Validasi Input Request dari Form Bootstrap
        $request->validate([
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|same:new_password',
            'otp_code' => 'required|string|size:6',
        ]);

        $user = DB::table('tbl_biodata')->where('id_user', Auth::user()->id_user)->first();
        $phoneNumber = $user->no_hp;

        // 2. Cari data OTP terakhir yang cocok, belum kedaluwarsa, dan belum digunakan
        $otpCheck = DB::table('password_otp_tokens')
            ->where('phone_number', $phoneNumber)
            ->where('otp_code', $request->otp_code)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->first();

        // 3. Jika OTP tidak ditemukan atau sudah tidak valid
        if (!$otpCheck) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP salah, sudah kedaluwarsa, atau telah digunakan.'
            ], 400);
        }

        // 4. Jalankan Query Update secara aman menggunakan Database Transaction
        DB::transaction(function () use ($request, $otpCheck) {

            // A. Update password baru milik user (di-hash menggunakan bcrypt)
            DB::table('users')->where('id_user', FacadesAuth::user()->id_user)->update([
                'password' => Hash::make($request->new_password)
            ]);

            // B. Tandai kode OTP tersebut sudah hangus/terpakai
            DB::table('password_otp_tokens')
                ->where('id', $otpCheck->id)
                ->update(['is_used' => true, 'updated_at' => Carbon::now()]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Selamat! Password Anda berhasil diperbarui.'
        ]);
    }
    public function getway_whatsapp_send()
    {
        $response = Http::withHeaders([
            'Authorization' => env('WA_API_KEY'),
        ])->post(env('WA_ENDPOINT'), [
            'target' => '081973939957', // Format: 08123456789 atau 628123456789
            'message' => 'Halo semuanya',
        ]);

        return $response->json();
    }
    public function getway_telegram_checking()
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
                                    'phone'      => '+' . $phoneNumber // Pastikan kolom 'phone' ada di tabel
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

    public function getway_telegram_webhook(Request $request)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $update = $request->all();

        if (isset($update['message'])) {
            $chatId    = $update['message']['chat']['id'];
            $firstName = $update['message']['chat']['first_name'] ?? 'User';
            $username  = $update['message']['chat']['username'] ?? null;
            $textInput = strtolower(trim($update['message']['text'] ?? ''));

            // 1. JIKA USER KETIK "halo" (Atau pesan teks biasa)
            // Jangan simpan dulu, tapi kirimkan tombol untuk meminta nomor HP
            if ($textInput === 'halo' || !isset($update['message']['contact'])) {
                $this->sendRequestContactButton($token, $chatId, $firstName);
            }
        }

        // 2. JIKA USER KLIK TOMBOL "OK / Bagikan No HP" (Mengirim Kontak)
        // Di sinilah proses penyimpanan ke database terjadi
        if (isset($update['message']['contact'])) {
            $chatId      = $update['message']['chat']['id'];
            $firstName   = $update['message']['chat']['first_name'] ?? 'User';
            $username    = $update['message']['chat']['username'] ?? null;
            $phoneNumber = $update['message']['contact']['phone_number'];

            // Simpan ke database
            TelegramUser::updateOrCreate(
                ['chat_id' => $chatId],
                [
                    'first_name' => $firstName,
                    'username'   => $username,
                    'phone'      => '+' . $phoneNumber
                ]
            );

            // Balas pesan sukses & hapus tombolnya
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text'    => "Nomor HP Anda (+{$phoneNumber}) berhasil disimpan! Terima kasih.",
                'reply_markup' => json_encode(['remove_keyboard' => true])
            ]);
        }

        return response()->json(['status' => 'success'], 200);
    }


    public function v3_getway_telegram(Request $request)
    {
        $token = '7372867009:AAHS08RqpVYUtd4vAXz2ESIrLyRUxokWY4Q';
        $update = $request->all();

        // 1. JIKA USER MENGIRIM PESAN TEKS BIASA
        if (isset($update['message'])) {
            $chatId    = $update['message']['chat']['id'];
            $firstName = $update['message']['chat']['first_name'] ?? 'User';
            $textInput = trim($update['message']['text'] ?? '');
            $textLower = strtolower($textInput);

            // Cek apakah user sedang dalam sesi menunggu input nomor tiket (Cek Laporan)
            $waitingTicketKey = "waiting_ticket_{$chatId}";
            if (Cache::has($waitingTicketKey)) {
                Cache::forget($waitingTicketKey);

                $noTiket = $textInput;

                // Cari data laporan di tabel tbl_laporan_user berdasarkan tiket_laporan
                $laporan = DB::table('tbl_laporan_user')
                    ->where('tiket_laporan', $noTiket)
                    ->first();

                if ($laporan) {
                    $pesanRespon  = "🔍 *DETAIL LAPORAN DIKETAHUI*\n\n";
                    $pesanRespon .= "🎫 *No Tiket:* {$laporan->tiket_laporan}\n";
                    $pesanRespon .= "👤 *Nama Pelapor:* {$laporan->nama_user}\n";
                    $pesanRespon .= "🏢 *Divisi / Cabang:* {$laporan->divisi} ({$laporan->kd_cabang})\n";
                    $pesanRespon .= "📌 *Kategori:* {$laporan->kategori_laporan}\n";
                    $pesanRespon .= "⚡ *Tingkat:* {$laporan->tingkat_laporan}\n";
                    $pesanRespon .= "📊 *Status Laporan:* *{$laporan->status_laporan}*\n";
                    $pesanRespon .= "📅 *Tanggal Dibuat:* {$laporan->tgl_laporan}\n";

                    if (!empty($laporan->tgl_selesai_laporan)) {
                        $pesanRespon .= "✅ *Tanggal Selesai:* {$laporan->tgl_selesai_laporan}\n";
                    }
                } else {
                    $pesanRespon = "❌ Maaf, laporan dengan nomor tiket *{$noTiket}* tidak ditemukan di sistem kami.";
                }

                Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id'    => $chatId,
                    'text'       => $pesanRespon,
                    'parse_mode' => 'Markdown'
                ]);

                return response()->json(['status' => 'success'], 200);
            }

            // Jika mengetik "halo"
            if ($textLower === 'halo') {
                $this->sendMenuButtons($token, $chatId, $firstName);
            } else {
                Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id' => $chatId,
                    'text'    => "Ketik 'halo' untuk memunculkan menu utama."
                ]);
            }
        }

        // 2. JIKA USER KLIK TOMBOL INLINE (3 Menu Pilihan)
        if (isset($update['callback_query'])) {
            $callbackId = $update['callback_query']['id'];
            $chatId     = $update['callback_query']['message']['chat']['id'];
            $firstName  = $update['callback_query']['from']['first_name'] ?? 'User';
            $messageId  = $update['callback_query']['message']['message_id'];
            $data       = $update['callback_query']['data'];

            // Matikan loading tombol seketika
            Http::post("https://api.telegram.org/bot{$token}/answerCallbackQuery", [
                'callback_query_id' => $callbackId
            ]);

            // Proteksi anti-spam klik ganda (2 detik)
            $lockKey = "telegram_click_{$chatId}_{$data}";
            if (!Cache::add($lockKey, true, 2)) {
                return response()->json(['status' => 'ignored'], 200);
            }

            // Hapus tombol inline setelah diklik
            Http::post("https://api.telegram.org/bot{$token}/editMessageReplyMarkup", [
                'chat_id'      => $chatId,
                'message_id'   => $messageId,
                'reply_markup' => json_encode(['inline_keyboard' => []])
            ]);

            // Logika 3 Tombol
            if ($data === 'cek_laporan') {
                Cache::put("waiting_ticket_{$chatId}", true, 300);

                Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id'    => $chatId,
                    'text'       => "📄 Silakan ketik dan kirim *Nomor Tiket* laporan Anda:",
                    'parse_mode' => 'Markdown'
                ]);
            } elseif ($data === 'daftar_kontak') {
                // Memunculkan tombol keyboard bawah untuk izin kontak
                $this->sendRequestContactButton($token, $chatId, $firstName);
            } elseif ($data === 'help') {
                Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id' => $chatId,
                    'text'    => "🆘 *Bantuan*\n\nGunakan tombol menu yang tersedia atau ketik *'halo'* untuk kembali ke menu utama.",
                    'parse_mode' => 'Markdown'
                ]);
            }
        }

        // 3. JIKA USER MENGIRIM KONTAK (Proses Simpan ke Database TelegramUsers)
        if (isset($update['message']['contact'])) {
            $chatId      = $update['message']['chat']['id'];
            $firstName   = $update['message']['chat']['first_name'] ?? 'User';
            $username    = $update['message']['chat']['username'] ?? null;
            $phoneNumber = $update['message']['contact']['phone_number'];
            $nomor = $phoneNumber;

            if (substr($nomor, 0, 1) !== '+') {
                $nomor = '+' . $nomor;
            }
            TelegramUser::updateOrCreate(
                ['chat_id' => $chatId],
                [
                    'first_name' => $firstName,
                    'username'   => $username,
                    'phone'      => $nomor
                ]
            );

            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id'      => $chatId,
                'text'         => "✅ Nomor HP Anda ({$nomor}) berhasil didaftarkan dan disimpan! Terima kasih.",
                'reply_markup' => json_encode(['remove_keyboard' => true])
            ]);
        }
        return response()->json(['status' => 'success'], 200);
    }
    private function sendMenuButtons($token, $chatId, $firstName)
    {
        // Membuat 3 Inline Button (Cek Laporan, Buat Laporan, Help)
        $inlineKeyboard = [
            'inline_keyboard' => [
                [
                    ['text' => '📊 Cek Laporan', 'callback_data' => 'cek_laporan']
                ],
                [
                    ['text' => '📝 Daftar Kontak', 'callback_data' => 'daftar_kontak']
                ],
                [
                    ['text' => '❓ Help', 'callback_data' => 'help']
                ]
            ]
        ];

        Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chatId,
            'text'    => "Halo {$firstName}! Silakan pilih menu di bawah ini:",
            'reply_markup' => json_encode($inlineKeyboard)
        ]);
    }
    private function sendRequestContactButton($token, $chatId, $firstName)
    {
        $keyboard = [
            'keyboard' => [
                [
                    [
                        'text'            => '📱 Bagikan Nomor HP Saya',
                        'request_contact' => true
                    ]
                ]
            ],
            'resize_keyboard'   => true,
            'one_time_keyboard' => true
        ];

        Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id'      => $chatId,
            'text'         => "Halo {$firstName}! Silakan klik tombol *Bagikan Nomor HP Saya* di bawah untuk mendaftarkan kontak Anda:",
            'parse_mode'   => 'Markdown',
            'reply_markup' => json_encode($keyboard)
        ]);
    }
}
