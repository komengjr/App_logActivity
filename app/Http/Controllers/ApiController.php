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
        $updates = Telegram::getUpdates();
        $data = DB::table('telegram_log')->get();
        // dd(count($updates));
        // dd(count($data));
        $data_arr = array();
        $no = 0;
        if (count($updates) == count($data)) {
            return 0;
        } else {
            foreach ($updates as $data) {
                // $data_arr[] = array(
                //     'update_id' => $data['update_id'],
                //     'chat_id' => $data['message']['chat']['id'],
                //     'first_name' => $data['message']['chat']['first_name'],
                //     'last_name' => $data['message']['chat']['last_name'],
                //     'text' => $data['message']['text'],
                //     'date' => $data['message']['date'],
                // );
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
                    if ($datachat == '/start') {
                        Telegram::sendMessage([
                            'chat_id' => $chatid,
                            'text' => "Halo ". $nama_depan . "\nPerkenalkan Nama Saya SOLEH , Ada Yang Bisa Saya Bantu",
                        ]);
                    }elseif($datachat == '/help'){
                        Telegram::sendMessage([
                            'chat_id' => $chatid,
                            'text' => "/help : Bantuan\n /start : Memulai Chat.\n /updateno_0855229383918 : Update No Hp.\n /cekkasus_PA_2024-02-29_11:04:24_945 : Cek Status Laporan.\n Terima Kasih",
                        ]);
                    }elseif(is_numeric($datachat)){
                        Telegram::sendMessage([
                            'chat_id' => $chatid,
                            'text' => 'No Hp :'.$data['message']['text']. ' Sudah Didaftarkan',
                        ]);
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
            return response()->json($data_arr);
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
            'chat_id' => '-1002095197699',
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
