<?php

namespace App\Http\Controllers;

use Telegram;
use Illuminate\Http\Request;
use DB;
use Auth;

class ApiController extends Controller
{
    public function log_telegram()
    {
        $data = DB::table('telegram_log')->get();
        return view('telegram.log-view', ['data' => $data]);
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
        if (count($updates) == count($data)) {
            return 0;
        } else {
            if (count($updates) == 0) {
                return 0;
            } else {
                foreach ($updates as $data) {

                    $cek = DB::table('telegram_log')->where('update_id', $data['update_id'])->first();
                    if (!$cek) {
                        DB::table('telegram_log')->insert([
                            'update_id' => $data['update_id'],
                            'chat_id' => $data['message']['chat']['id'],
                            'first_name' => $data['message']['chat']['first_name'],
                            'last_name' => $data['message']['chat']['last_name'],
                            'text' => $data['message']['text'],
                            'date' => $data['message']['date'],
                            'created_at' => now()
                        ]);
                        $data_arr[] = array(
                            'update_id' => $data['update_id'],
                            'chat_id' => $data['message']['chat']['id'],
                            'first_name' => $data['message']['chat']['first_name'],
                            'last_name' => $data['message']['chat']['last_name'],
                            'text' => $data['message']['text'],
                            'date' => $data['message']['date'],
                        );
                        $datachat = $data['message']['text'];
                        $chatid = $data['message']['chat']['id'];
                        $nama_depan = $data['message']['chat']['first_name'];
                        $no_hp = substr($datachat, 10);
                        $no_tiket = substr($datachat, 10);
                        if ($datachat == '/start') {
                            Telegram::sendMessage([
                                'chat_id' => $chatid,
                                'text' => "Halo " . $nama_depan . "\nPerkenalkan Nama Saya SOLEH , Ada Yang Bisa Saya Bantu",
                            ]);
                        } elseif ($datachat == '/help') {
                            Telegram::sendMessage([
                                'chat_id' => $chatid,
                                'text' => "/help : Bantuan\n /start : Memulai Chat.\n /updateno_<no_hp> : Update No Hp.\n /cekkasus_<no_tiket> : Cek Status Laporan.\n /laporanbaru : Membuat Laporan Baru \n/info : Informasi",
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
                            $info = DB::table('telegram_chat_no')->where('chat_id',$chatid)->first();
                            if ($info) {
                                Telegram::sendMessage([
                                    'chat_id' => $chatid,
                                    'text' => "Status No Hp Terdaftar \nDengan No : ". $info->no_hp,
                                ]);
                            } else {
                                Telegram::sendMessage([
                                    'chat_id' => $chatid,
                                    'text' => "Status No Hp Belum Terdaftar \nSegera Daftar Dengan ketik /updateno_<no_hp>",
                                ]);
                            }


                        }else {
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
}
