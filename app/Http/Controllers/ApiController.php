<?php

namespace App\Http\Controllers;

use Telegram;
use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{
    public function getupdates(Request $request)
    {
        $updates = Telegram::getUpdates();
        // dd($updates);
        $data_arr = array();
        $no = 0;
        foreach ($updates as $data) {
            $data_arr[] = array(
                'update_id' => $data['update_id'],
                'chat_id' => $data['message']['chat']['id'],
                'first_name' => $data['message']['chat']['first_name'],
                'last_name' => $data['message']['chat']['last_name'],
                'text' => $data['message']['text'],
                'date' => $data['message']['date'],
            );
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
            }
        }
        return view('telegram.log_telegram',['data'=>$data_arr]);
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
