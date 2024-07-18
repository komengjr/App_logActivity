<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Commands\Command;
use Telegram;

class PublicController extends Controller
{
    public function newcase()
    {
        // $data = DB::table('tbl_kinerja')->
        return view('formcase');
    }
    public function postnewcase(Request $request)
    {
        // DB::table('tbl_laporan_user')->insert([
        //     'tiket_laporan' => $request->tiket,
        //     'kd_cabang' => $request->kd_cabang,
        //     'nama_user' => $request->nama,
        //     'nip_user' => $request->nip,
        //     'divisi' => $request->divisi,
        //     'kategori_laporan' => $request->kategori_laporan,
        //     'deskripsi_laporan' => $request->deskripsi,
        //     'email' => $request->email,
        //     'no_hp' => $request->telegram,
        //     'status_laporan' => 0,
        //     'tingkat_laporan' => $request->tingkat_laporan,
        //     'tgl_laporan' => date('Y-m-d H:i:s'),
        // ]);
        $datacabang = DB::table('tbl_cabang')->where('kd_cabang', $request->kd_cabang)->first();
        $text = "Ada Tiket Baru Dengan Nomor : $request->tiket \nDari cabang $datacabang->nama_cabang \n Nomor Kontak : $request->telegram";
        // $response = $this->getUpdate();
        // $chat_id = $response->getChat()->getId();
        // $btn = Keyboard::button([
        //     'text' => $request->telegram,
        //     'request_contact' => true,
        // ]);
        // $keyboards = [
        //     [$request->telegram],
        // ];
        // $keyboard = Keyboard::make([
        //     'keyboard' => $keyboards,
        //     'resize_keyboard' => true,
        //     'one_time_keyboard' => true
        // ]);
        Telegram::sendMessage([
            'chat_id' => '-1002095197699',
            'text' => $text,
            // 'reply_markup' => $keyboard
        ]);
        return ($request->tiket);
    }
    public function caricabang($id)
    {
        $data = DB::table('tbl_cabang')->select('nama_cabang', 'kd_cabang')->where('nama_cabang', 'like', '%' . $id . '%')->limit(6)->get();
        return view('datacabang', ['data' => $data]);
    }
    public function pilihcabang($id)
    {
        $tiket = $id . "_" . date('Y-m-d') . '_' . date('H:i:s') . '_' . mt_rand(100, 999);
        $data = DB::table('tbl_cabang')->select('nama_cabang', 'kd_cabang', 'alamat')->where('kd_cabang', $id)->first();
        return view('pilihcabang', ['data' => $data, 'tiket' => $tiket]);
    }
    public function cek_status_laporan()
    {
        return view('cek-status-laporan');
    }
    public function caridatatiket($id)
    {
        $data = DB::table('tbl_laporan_user')->where('tiket_laporan',$id)->first();
        $penyelesaian = DB::table('tbl_laporan_user_log')->where('tiket_laporan',$id)->first();
        return view('data-tiket',[
            'data'=>$data,
            'penyelesaian'=>$penyelesaian,
        ]);
    }
}
