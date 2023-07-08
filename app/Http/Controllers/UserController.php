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
    public function lihatnotifikasiwaktu()
    {
        $jumlahnotif = 0;
        $notif = DB::table('tbl_schedule')
            ->where('status_schedule', 1)
            ->get();
        foreach ($notif as $value) {
            if (substr($value->tgl_start, 0, 10) >= date('Y-m-d')){

                $cekdata = DB::table('tbl_schadule_log')->where('kd_schedule',$value->kd_schedule)->where('id_user',auth::user()->id_user)->count();

                if ($cekdata == 0){
                    $jumlahnotif = $jumlahnotif + 1;
                }else{

                }
            }
        }
        return view('waktu',['id'=>$jumlahnotif]);
    }
    public function lihatnotifikasi($id)
    {
        $datachedule = DB::table('tbl_schedule')
                        ->join('tbl_kinerja','tbl_kinerja.kd_kinerja','=','tbl_schedule.kd_kinerja')
                        ->where('status_schedule',1)->get();
        return view('notif',['id'=>$id , 'datachedule'=>$datachedule]);
    }
    public function lihattaskkinerja($id)
    {
        $datachedule = DB::table('tbl_schedule')
                        ->join('tbl_kinerja','tbl_kinerja.kd_kinerja','=','tbl_schedule.kd_kinerja')
                        ->where('kd_schedule',$id)->get();
        return view('userleader.modal.taskkinerja',['id'=>$id,'datachedule'=>$datachedule]);
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
                'tempat_lahir' => $request->input('tempat_lahir'),
                'alamat' => $request->input('alamat'),
                'gambar' => $request->file('gambar')->storeAs('data_file/fileupload/'.auth::user()->email,auth::user()->id_user.''.'pp.jpg'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            Session::flash('sukses','Berhasil Melengkapi Data Profil');
            return redirect()->back();
    }
    public function postschedule(Request $request)
    {
        DB::table('tbl_schadule_log')->insert(
            [
                'kd_schedule' => $request->input('id'),
                'id_user' => auth::user()->id_user,
                'deskripsi_schedule' => $request->input('keterangan'),
                'status_schedule_user' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            Session::flash('sukses','Berhasil Menyelesaikan 1 Task');
            return redirect()->back();
    }
    public function buattikettask(Request $request)
    {
        // $id_group = DB::table('group_user')->where('id_group_user',$request->input('usercabang'))->first();
        DB::table('tbl_tiket_task')->insert(
            [
                'kd_tiket_task' => "task-".Str::random(50),
                'id_leader' => auth::user()->id_user,
                'kd_cabang' => $request->input('usercabang'),
                'kd_kinerja' => $request->input('kd_kinerja'),
                'kd_group' => '-',
                'deskripsi_task' => $request->input('keterangan'),
                'status_task' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            Session::flash('sukses','Berhasil Menyelesaikan 1 Task');
            return redirect()->back();
    }

    public function beritugasuser()
    {
        $groupcabang = DB::table('handler_cabang')
        ->join('group_user','group_user.kd_group','=','handler_cabang.kd_group')
        ->join('tbl_cabang','tbl_cabang.kd_cabang','=','handler_cabang.kd_cabang')
        ->where('group_user.id_user',auth::user()->id_user)->get();
        $kinerja = DB::table('tbl_kinerja')->where('status_kinerja',1)->get();
        return view('userleader.modal.beritugas',['kinerja'=>$kinerja,'groupcabang'=>$groupcabang]);
    }
    public function lihattugasuser()
    {
        $datatikettask = DB::table('tbl_tiket_task')
        ->select('tbl_tiket_task.*','tbl_cabang.nama_cabang','tbl_kinerja.kinerja')
        ->join('tbl_cabang','tbl_cabang.kd_cabang','=','tbl_tiket_task.kd_cabang')
        ->join('tbl_kinerja','tbl_kinerja.kd_kinerja','=','tbl_tiket_task.kd_kinerja')
        ->where('tbl_tiket_task.id_leader',auth::user()->id_user)->get();
        $kinerja = DB::table('tbl_kinerja')->where('status_kinerja',1)->get();
        return view('userleader.modal.lihattugas',['kinerja'=>$kinerja , 'datatikettask'=>$datatikettask]);
    }
    public function periodekpi()
    {
        $tbl_periode = DB::table('tbl_periode')->get();
        return view('userleader.modal.periodekpi',['tbl_periode'=>$tbl_periode ]);
    }
}
