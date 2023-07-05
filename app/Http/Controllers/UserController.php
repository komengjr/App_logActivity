<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function lihattiketpersonal($id)
    {
        return view('userleader.modal.test',['id'=>$id]);
    }
    public function lihattiketgroup($id)
    {
        return view('userleader.modal.tiketgroup',['id'=>$id]);
    }
    public function lihattugaspersonal()
    {
        $worklistperson = DB::table('tbl_tiket_person_worklist')
        ->join('worklist_person','worklist_person.kd_worklist_person','=','tbl_tiket_person_worklist.kd_worklist_person')
        ->join('tbl_worklist','tbl_worklist.kd_worklist','=','worklist_person.kd_worklist')
        ->where('worklist_person.id_user',auth::user()->id_user)
        ->where('tbl_tiket_person_worklist.status_tiket',0)
        ->get();
        $groupworklist = DB::table('tbl_tiket_group_worklist')
        ->join('group_worklist','group_worklist.kd_group','=','tbl_tiket_group_worklist.kd_group')
        ->join('tbl_worklist','tbl_worklist.kd_worklist','=','group_worklist.kd_worklist')
        ->join('group_user','group_user.kd_group','=','group_worklist.kd_group')
        ->where('group_user.id_user',auth::user()->id_user)->get();
        // dd($groupworklist);
        return view('userleader.modal.tbltugaspersonal',['worklistperson'=>$worklistperson,'groupworklist'=>$groupworklist]);
    }
    public function laporantambah()
    {
        $type_laporan = DB::table('type_laporan')->get();
        return view('userleader.modal.laporan',['type_laporan'=>$type_laporan]);
    }
    public function posttambahlaporan(Request $request)
    {
        $kd_laporan = "laporan-".Str::random(10);
        $no_tiket = "tiket/laporan/".date('Y-m-d')."/".date('H:i:s')."/".Str::random(5);
        DB::table('tbl_laporan')->insert(
            [
                'kd_laporan' => $kd_laporan,
                'nama_laporan' => $request->input('judul_laporan'),
                'type_laporan' => $request->input('type_laporan'),
                'status_laporan' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        DB::table('tbl_tiket_laporan')->insert(
            [
                'no_tiket' => $no_tiket,
                'kd_laporan' => $kd_laporan,
                'id_user' => $request->input('type_laporan'),
                'deskripsi_laporan' => $request->input('deskripsi'),
                'status_tiket' => 0,
                'tgl_buat' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        Session::flash('sukses','Berhasil Membuat Laporan Dengan Kode Tiket : '.$no_tiket);
		return redirect()->back();
    }
    public function lihatlaporan($id)
    {
        $data = DB::table('tbl_tiket_laporan')
        ->where('id_tiket_laporan',$id)
        ->get();
        return view('userleader.modal.detaillaporan',['data'=>$data]);
    }

    public function lengkapidatabiodata(Request $request)
    {
        DB::table('tbl_biodata')->insert(
            [
                'id_user' => auth::user()->id_user,
                'nama_lengkap' => $request->input('nama_lengkap'),
                'nip' => $request->input('nip'),
                'tgl_lahir' => $request->input('tgl_lahir'),
                'tempat_lahir' => $request->input('tempat_lahir_lahir'),
                'alamat' => $request->input('alamat'),
                'gambar' => $request->file('gambar')->storeAs('data_file/fileupload/'.auth::user()->email,auth::user()->id_user.''.'pp.jpg'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            Session::flash('sukses','Berhasil Melengkapi Data Profil');
            return redirect()->back();
    }
}
