<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class GatewatyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function telegram()
    {
        if (Auth::user()->kd_akses == 2) {
            $data = DB::table('tbl_laporan_user')->where('status_telegram', '=!', 1)->get();
            // dd($data);
            return view('admin.gateway.telegram', ['data' => $data]);
        }
    }
    public function no_telegram()
    {
        if (Auth::user()->kd_akses == 2) {
            $data = DB::table('telegram_chat_no')->get();
            return view('admin.gateway.no-telegram',['data'=>$data]);
        }
    }
    public function log_telegram()
    {
        if (Auth::user()->kd_akses == 2) {
            $data = DB::table('telegram_log')->orderBy('id_telegram', 'DESC')->get();
            return view('admin.gateway.log-telegram',['data'=>$data]);
        }
    }
}
