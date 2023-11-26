<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class PublicController extends Controller
{
    public function newcase()
    {
        return view('formcase');
    }
    public function postnewcase(Request $request)
    {
        return redirect()->back();
    }
    public function caricabang($id)
    {
        $data = DB::table('tbl_cabang')->select('nama_cabang','kd_cabang')->where('nama_cabang','like', '%' . $id . '%')->limit(6)->get();
        return view('datacabang',['data'=>$data]);
    }
    public function pilihcabang($id)
    {
        return view('pilihcabang');
    }
}
