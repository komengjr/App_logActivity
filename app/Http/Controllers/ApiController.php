<?php

namespace App\Http\Controllers;

use Telegram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        DB::table('v_log_whatsapp')->where('v_log_whatsapp_code', $code)->update([
            'v_log_whatsapp_status' => 1
        ]);
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
        DB::transaction(function () use ( $request, $otpCheck) {

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
}
