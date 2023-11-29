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
        DB::table('tbl_laporan_user')->insert([
            'tiket_laporan'=>$request->tiket,
            'kd_cabang'=>$request->kd_cabang,
            'nama_user'=>$request->nama,
            'nip_user'=>$request->nip,
            'divisi'=>$request->divisi,
            'deskripsi_laporan'=>$request->deskripsi,
            'email'=>$request->email,
            'status_laporan'=>0,
            'tgl_laporan'=>date('Y-m-d H:i:s'),
        ]);
        return($request->tiket);
    }
    public function caricabang($id)
    {
        $data = DB::table('tbl_cabang')->select('nama_cabang','kd_cabang')->where('nama_cabang','like', '%' . $id . '%')->limit(6)->get();
        return view('datacabang',['data'=>$data]);
    }
    public function pilihcabang($id)
    {
        $tiket = $id."_".date('Y-m-d').'_'.date('H:i:s').'_'. mt_rand(100, 999);
        $data = DB::table('tbl_cabang')->select('nama_cabang','kd_cabang','alamat')->where('kd_cabang',$id)->first();
        return view('pilihcabang',['data'=>$data,'tiket'=>$tiket]);
    }
}
