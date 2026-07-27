<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TelegramWebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('bot/getupdates',['as'=>'bot/getupdates','uses'=> 'ApiController@getupdates']);
Route::post('bot/sendmessage',['as'=>'bot/sendmessage','uses'=> 'ApiController@sendmessage']);
Route::get('bot/update',['as'=>'bot/update','uses'=> 'ApiController@update']);
Route::get('setwebhook', [\App\Http\Controllers\BotTelegramController::class, 'setWebhook']);
Route::post('abonsapibot/webhook', [\App\Http\Controllers\BotTelegramController::class, 'commandHandlerWebHook']);


Route::prefix('v2/')->group(function (): void {
    Route::get('getway/whatsapp', [ApiController::class, 'getway_whatsapp'])->name('getway_whatsapp');
    Route::get('getway/whatsapp-update/{code}', [ApiController::class, 'getway_whatsapp_status'])->name('getway_whatsapp_status');
    Route::post('getway/whatsapp-update', [ApiController::class, 'getway_whatsapp_update'])->name('getway_whatsapp_update');
    Route::get('getway/whatsapp-sending', [ApiController::class, 'getway_whatsapp_send'])->name('getway_whatsapp_send');
    Route::get('getway/checking-telegram', [ApiController::class, 'getway_telegram_checking'])->name('getway_telegram_checking');
    Route::post('getway/checking-webhook', [ApiController::class, 'getway_telegram_webhook'])->name('getway_telegram_webhook');
});
Route::prefix('password/')->group(function (): void {
    Route::post('send-otp', [ApiController::class, 'password_send_otp'])->name('password_send_otp');
    Route::post('update', [ApiController::class, 'password_update'])->name('password_update');
});

Route::post('/telegram/webhook', [TelegramWebhookController::class, 'handle']);
