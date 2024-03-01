<?php

namespace App\Http\Controllers;

use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getupdates(Request $request)
    {
        $updates = Telegram::getUpdates();
        // dd($updates);
        return (json_encode($updates));
    }
    public function sendmessage(Request $request)
    {
        Telegram::sendMessage([
            'chat_id' => '-1002095197699',
            'text' => $request->pesan,
        ]);
        return redirect()->back();
    }
}
