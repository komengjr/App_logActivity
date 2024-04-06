<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram;
class BotTelegramController extends Controller
{
    public function setWebhook()
    {
        $response = Telegram::setWebhook(['url' => env('TELEGRAM_WEBHOOK_URL')]);
        dd($response);
    }
    public function commandHandlerWebHook()
    {
        $updates = Telegram::commandsHandler(true);
    }
}
