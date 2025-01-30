<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class PiketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (auth::user()->kd_akses == 2) {
            $data = DB::table('tbl_schedule')
                ->join('tbl_kinerja', 'tbl_kinerja.kd_kinerja', '=', 'tbl_schedule.kd_kinerja')
                ->get();
            return view('admin.piket', ['data' => $data]);
        }
    }
    public function formpiket($id)
    {
        $date = substr($id, 4, 11);
        $datex = strtotime($date);
        $tgl = date('m/d/Y', $datex);
        if (auth::user()->kd_akses == 2) {
            $data = DB::table('tbl_kinerja')
                ->join('tbl_kinerja_detail', 'tbl_kinerja_detail.kd_kinerja', '=', 'tbl_kinerja.kd_kinerja')
                ->get();
            $cabang = DB::table('tbl_cabang')->get();
            $group = DB::table('tbl_group')->get();
            $user = DB::table('tbl_biodata')->get();
            return view('admin.piket.form-piket', ['data' => $data, 'id' => $tgl, 'cabang' => $cabang, 'user'=>$user,'group'=>$group]);
        }

    }
}
