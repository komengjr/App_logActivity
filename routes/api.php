<?php

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
