<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class VerifikatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function datatask($id)
    {
        $data = DB::table('tbl_schedule')
        ->join('tbl_kinerja','tbl_kinerja.kd_kinerja','=','tbl_schedule.kd_kinerja')
        ->where('kd_schedule',$id)
        ->first();
        return view('verifikator.modal.datatask',['data'=>$data]);
    }
}
