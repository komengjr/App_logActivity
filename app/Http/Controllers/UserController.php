<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PDF;

// use SimpleSoftwareIO\QrCode\Facades\QrCode;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function lihattiketpersonal($id)
    {
        return view('userleader.modal.test', ['id' => $id]);
    }
    public function lihattiketgroup($id)
    {
        return view('userleader.modal.tiketgroup', ['id' => $id]);
    }
    public function lihatnotifikasiwaktu()
    {
        // $jumlahnotif = 0;
        // $notif = DB::table('tbl_schedule')
        //     ->where('status_schedule', 1)
        //     ->get();
        // foreach ($notif as $value) {
        //     if (substr($value->tgl_akhir, 0, 10) >= date('Y-m-d')){
        //         if (substr($value->tgl_start, 0, 10) <= date('Y-m-d')) {
        //         $cekdata = DB::table('tbl_schadule_log')->where('kd_schedule',$value->kd_schedule)->where('id_user',auth::user()->id_user)->count();

        //         if ($cekdata == 0){
        //             $jumlahnotif = $jumlahnotif + 1;
        //         }else{
        //         }
        //     }
        //     }
        // }
        $dataschedule = DB::table('tbl_schedule')->join('users_handler', 'users_handler.kd_cabang', '=', 'tbl_schedule.kd_cabang')
            ->where('tbl_schedule.status_schedule', 0)->where('users_handler.id_user', Auth::user()->id_user)->count();
        $datalaporan = DB::table('tbl_laporan_user')
            ->join('users_handler', 'users_handler.kd_cabang', '=', 'tbl_laporan_user.kd_cabang')
            ->where('users_handler.id_user', Auth::user()->id_user)
            ->where('tbl_laporan_user.status_laporan', '<', 2)->count();
        $jumlahnotif = $datalaporan + $dataschedule;
        return view('waktu', ['id' => $jumlahnotif]);
    }
    public function lihatnotifikasi($id)
    {
        $datapesan = DB::table('tbl_laporan_user')
            ->join('users_handler', 'users_handler.kd_cabang', '=', 'tbl_laporan_user.kd_cabang')
            ->where('users_handler.id_user', Auth::user()->id_user)
            ->where('tbl_laporan_user.status_laporan', '<', 2)->get();
        $dataschadule = DB::table('tbl_schedule')
            ->join('users_handler', 'users_handler.kd_cabang', '=', 'tbl_schedule.kd_cabang')->where('users_handler.id_user', Auth::user()->id_user)->where('tbl_schedule.status_schedule', 0)->get();
        // dd($dataschadule);
        return view('notifikasi.notifpesan', ['id' => $id, 'datapesan' => $datapesan, 'dataschedule' => $dataschadule]);
        // $datachedule = DB::table('tbl_schedule')
        //                 ->join('tbl_kinerja','tbl_kinerja.kd_kinerja','=','tbl_schedule.kd_kinerja')
        //                 ->where('status_schedule',1)->get();
        // return view('notifikasi.notifpesan',['id'=>$id , 'datachedule'=>$datachedule]);
    }
    public function lihattaskkinerja($id)
    {
        $datalaporan = DB::table('tbl_laporan_user')
            ->where('tiket_laporan', $id)->first();
        $date = date_create($datalaporan->tgl_respon_laporan);
        date_add($date, date_interval_create_from_date_string('1 hours'));
        return view('notifikasi.formtask', ['id' => $id, 'datalaporan' => $datalaporan, 'date' => $date]);
        // $datachedule = DB::table('tbl_schedule')
        //                 ->join('tbl_kinerja','tbl_kinerja.kd_kinerja','=','tbl_schedule.kd_kinerja')
        //                 ->where('kd_schedule',$id)->get();
        // return view('userleader.modal.taskkinerja',['id'=>$id,'datachedule'=>$datachedule]);
    }
    public function lihattaskkinerjaadmin($id)
    {
        $datalaporan = DB::table('tbl_schedule')
            ->join('tbl_kinerja', 'tbl_kinerja.kd_kinerja', '=', 'tbl_schedule.kd_kinerja')
            ->where('tbl_schedule.kd_schedule', $id)->first();
        return view('notifikasi.formtaskadmin', ['id' => $id, 'datalaporan' => $datalaporan]);
    }
    public function lihattugaspersonal()
    {
        $worklistperson = DB::table('tbl_tiket_person_worklist')
            ->join('worklist_person', 'worklist_person.kd_worklist_person', '=', 'tbl_tiket_person_worklist.kd_worklist_person')
            ->join('tbl_worklist', 'tbl_worklist.kd_worklist', '=', 'worklist_person.kd_worklist')
            ->where('worklist_person.id_user', auth::user()->id_user)
            ->where('tbl_tiket_person_worklist.status_tiket', 0)
            ->get();
        $groupworklist = DB::table('tbl_tiket_group_worklist')
            ->join('group_worklist', 'group_worklist.kd_group', '=', 'tbl_tiket_group_worklist.kd_group')
            ->join('tbl_worklist', 'tbl_worklist.kd_worklist', '=', 'group_worklist.kd_worklist')
            ->join('group_user', 'group_user.kd_group', '=', 'group_worklist.kd_group')
            ->where('group_user.id_user', auth::user()->id_user)->get();
        // dd($groupworklist);
        return view('userleader.modal.tbltugaspersonal', ['worklistperson' => $worklistperson, 'groupworklist' => $groupworklist]);
    }
    public function laporantambah()
    {
        $type_laporan = DB::table('type_laporan')->get();
        $kinerja = DB::table('tbl_kinerja')->get();
        return view('userleader.modal.laporan', ['type_laporan' => $type_laporan, 'kinerja' => $kinerja]);
    }
    public function posttambahlaporan(Request $request)
    {
        $kd_laporan = "laporan-" . Str::random(10);
        $no_tiket = "tiket/laporan/" . date('Y-m-d') . "/" . date('H:i:s') . "/" . Str::random(5);

        DB::table('tbl_tiket_laporan')->insert(
            [
                'no_tiket' => $no_tiket,
                'kd_kinerja' => $request->input('kd_kinerja'),
                'id_user' => auth::user()->id_user,
                'deskripsi_laporan' => $request->input('deskripsi_laporan'),
                'status_tiket' => 0,
                'tgl_buat' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
        Session::flash('sukses', 'Berhasil Membuat Laporan Dengan Kode Tiket : ' . $no_tiket);
        return redirect()->back();
    }
    public function postpenyelesaianlaporan(Request $request)
    {
        DB::table('tbl_tiket_laporan_log')->insert(
            [
                'no_tiket' => $request->input('no_tiket'),
                'id_user' => auth::user()->id_user,
                'keterangan' => $request->input('keterangan'),
                'tgl_buat' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
        DB::table('tbl_tiket_laporan')
            ->where('no_tiket', $request->input('no_tiket'))
            ->update([
                'status_tiket' => 1,
            ]);
        Session::flash('sukses', 'Berhasil Penyelesaian data laporan');
        return redirect()->back();
    }
    public function lihatdatalaporan($id)
    {
        $data = DB::table('tbl_tiket_laporan')
            ->join('users', 'users.id_user', '=', 'tbl_tiket_laporan.id_user')
            ->where('tbl_tiket_laporan.id_tiket_laporan', $id)
            ->get();
        return view('userleader.modal.detaillaporan', ['data' => $data]);
    }
    public function lihatlaporan($id)
    {
        $data = DB::table('tbl_tiket_laporan')
            ->where('id_tiket_laporan', $id)
            ->get();
        return view('userleader.modal.detaillaporan', ['data' => $data]);
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
                'no_hp' => $request->input('nomor_hp'),
                'alamat' => $request->input('alamat'),
                'kd_cabang' => $request->input('cabang'),
                'gambar' => $request->file('gambar')->storeAs('data_file/fileupload/' . auth::user()->email, auth::user()->id_user . '' . 'pp.jpg'),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
        Session::flash('sukses', 'Berhasil Melengkapi Data Profil');
        return redirect()->back();
    }
    public function postschedule(Request $request)
    {

        DB::table('tbl_laporan_user_log')->insert(
            [
                'tiket_laporan' => $request->tiket,
                'id_user' => Auth::user()->id_user,
                'deskripsi_penyelesaian' => $request->keterangan,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
        DB::table('tbl_laporan_user')
            ->where('tiket_laporan', $request->tiket)
            ->update([
                'tgl_selesai_laporan' => date('Y-m-d H:i:s'),
                'status_laporan' => 2,
            ]);
        Session::flash('sukses', 'Berhasil Menyelesaikan 1 Laporan');
        return redirect()->back();
    }
    public function postscheduleadmin(Request $request)
    {
        // DB::table('tbl_schadule_log')->insert(
        //     [
        //         'kd_schedule' => $request->input('id'),
        //         'id_user' => auth::user()->id_user,
        //         'deskripsi_schedule' => $request->input('keterangan'),
        //         'status_schedule_user' => 1,
        //         'created_at' => date('Y-m-d H:i:s'),
        //     ]);
        DB::table('tbl_schadule_log')->insert(
            [
                'kd_schedule' => $request->tiket,
                'id_user' => Auth::user()->id_user,
                'deskripsi_schedule' => $request->keterangan,
                'status_schedule_user' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
        DB::table('tbl_schedule')
            ->where('kd_schedule', $request->tiket)
            ->update([
                'updated_at' => date('Y-m-d H:i:s'),
                'status_schedule' => 1,
            ]);
        Session::flash('sukses', 'Berhasil Menyelesaikan 1 Laporan');
        return redirect()->back();
    }
    public function buattikettask(Request $request)
    {
        // $id_group = DB::table('group_user')->where('id_group_user',$request->input('usercabang'))->first();
        DB::table('tbl_tiket_task')->insert(
            [
                'kd_tiket_task' => "task-" . Str::random(50),
                'id_leader' => auth::user()->id_user,
                'kd_cabang' => $request->input('usercabang'),
                'kd_kinerja' => $request->input('kd_kinerja'),
                'tgl_start' => $request->input('start'),
                'tgl_end' => $request->input('end'),
                'deskripsi_task' => $request->input('keterangan'),
                'status_task' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
        Session::flash('sukses', 'Berhasil Menyelesaikan 1 Task');
        return redirect()->back();
    }

    public function beritugasuser()
    {
        $groupcabang = DB::table('handler_cabang')
            ->join('group_user', 'group_user.kd_group', '=', 'handler_cabang.kd_group')
            ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'handler_cabang.kd_cabang')
            ->where('group_user.id_user', auth::user()->id_user)->get();
        $kinerja = DB::table('tbl_kinerja')->where('status_kinerja', 1)->get();
        return view('userleader.modal.beritugas', ['kinerja' => $kinerja, 'groupcabang' => $groupcabang]);
    }
    public function lihattugasuser()
    {
        $datatikettask = DB::table('tbl_tiket_task')
            ->select('tbl_tiket_task.*', 'tbl_cabang.nama_cabang', 'tbl_kinerja.kinerja')
            ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'tbl_tiket_task.kd_cabang')
            ->join('tbl_kinerja', 'tbl_kinerja.kd_kinerja', '=', 'tbl_tiket_task.kd_kinerja')
            ->where('tbl_tiket_task.id_leader', auth::user()->id_user)->get();
        $kinerja = DB::table('tbl_kinerja')->where('status_kinerja', 1)->get();
        return view('userleader.modal.lihattugas', ['kinerja' => $kinerja, 'datatikettask' => $datatikettask]);
    }
    public function periodekpi()
    {
        $tbl_periode = DB::table('tbl_periode')->get();
        return view('userleader.modal.periodekpi', ['tbl_periode' => $tbl_periode]);
    }
    public function printlaporanuser()
    {
        return view('userleader.modal.printlaporanuser');
    }
    public function laporandatakinerja()
    {
        return view('userleader.modal.laporandatakinerja');
    }
    public function postprintlaporan(Request $request)
    {
        $startdate = $request->start;
        // $startdate = date_create_from_format('d-m-Y', $startdate);
        // $startdate = date_format($startdate, 'Y-m-d');
        $startdate = strtotime($startdate);

        $enddate = $request->end;
        // $enddate = date_create_from_format('d-m-Y', $enddate);
        // $enddate = date_format($enddate, 'Y-m-d');
        $enddate = strtotime($enddate);
        $harimasuk = array();
        // $harilibur = array();

        for ($i = $startdate; $i <= $enddate; $i += (60 * 60 * 24)) {
            if (date('w', $i) !== '0') {
                $harimasuk[] = $i;
            } else {
                // $harilibur[] = $i;
            }

        }
        $hendlecabang = DB::table('users_handler')
            ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
            ->where('users_handler.id_user', Auth::user()->id_user)->get();
        $dataharian = DB::table('tbl_kinerja_sub')->where('jenis_kinerja_sub', 1)->get();
        $image = base64_encode(file_get_contents(public_path('logo.png')));
        $pdf = PDF::loadview('userleader.report.laporan', ['dataharian' => $dataharian, 'harimasuk' => $harimasuk, 'hendlecabang' => $hendlecabang], compact('image'))->setPaper('A3', 'landscape')->setOptions(['defaultFont' => 'Courier']);
        return base64_encode($pdf->stream());
    }
    public function postprintlaporanid($id)
    {
        $startdate = '2023-11-01';
        // $startdate = date_create_from_format('d-m-Y', $startdate);
        // $startdate = date_format($startdate, 'Y-m-d');
        $startdate = strtotime($startdate);

        $enddate = '2023-11-15';
        // $enddate = date_create_from_format('d-m-Y', $enddate);
        // $enddate = date_format($enddate, 'Y-m-d');
        $enddate = strtotime($enddate);
        $harimasuk = array();
        // $harilibur = array();

        for ($i = $startdate; $i <= $enddate; $i += (60 * 60 * 24)) {
            if (date('w', $i) !== '0') {
                $harimasuk[] = $i;
            } else {
                // $harilibur[] = $i;
            }

        }
        $hendlecabang = DB::table('users_handler')
            ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
            ->where('users_handler.id_user', Auth::user()->id_user)->get();
        $dataharian = DB::table('tbl_kinerja_sub')->where('jenis_kinerja_sub', 1)->get();
        // $image = base64_encode(file_get_contents(public_path('logo.png')));
        $pdf = PDF::loadview('userleader.report.laporan', ['dataharian' => $dataharian, 'harimasuk' => $harimasuk, 'hendlecabang' => $hendlecabang])->setPaper('A3', 'landscape')->setOptions(['defaultFont' => 'Calibri']);
        return base64_encode($pdf->stream());
    }
    public function detaildatatask($id)
    {
        $tbl_tiket_task = DB::table('tbl_tiket_task')
            ->join('tbl_kinerja', 'tbl_kinerja.kd_kinerja', '=', 'tbl_tiket_task.kd_kinerja')
            ->where('tbl_tiket_task.kd_tiket_task', $id)
            ->first();
        $tbl_tiket_task_log = DB::table('tbl_tiket_task_log')
            ->where('kd_tiket_task', $id)
            ->get();
        return view('userleader.modal.detailtask', ['tbl_tiket_task' => $tbl_tiket_task, 'tbl_tiket_task_log' => $tbl_tiket_task_log]);
    }
    public function penilaiantask(Request $request)
    {

        DB::table('tbl_tiket_task_log')
            ->where('kd_tiket_task', $request->input('id_laporan'))
            ->update([
                'nilai_task' => $request->input('nilai'),
                'status_task_log' => 2,
            ]);
        Session::flash('sukses', 'Verifikasi Task Telah Selesai');
        return redirect()->back();
    }
    public function kerjakandatatask($id)
    {
        $tbl_tiket_task = DB::table('tbl_tiket_task')
            ->join('tbl_kinerja', 'tbl_kinerja.kd_kinerja', '=', 'tbl_tiket_task.kd_kinerja')
            ->where('tbl_tiket_task.kd_tiket_task', $id)
            ->first();
        $tbl_tiket_task_log = DB::table('tbl_tiket_task_log')
            ->where('kd_tiket_task', $id)
            ->get();
        return view('user.modal.kerjakantask', ['tbl_tiket_task' => $tbl_tiket_task, 'tbl_tiket_task_log' => $tbl_tiket_task_log]);
    }

    public function posttaskuser(Request $request)
    {
        // $id_group = DB::table('group_user')->where('id_group_user',$request->input('usercabang'))->first();
        DB::table('tbl_tiket_task_log')->insert(
            [
                'kd_tiket_task' => $request->input('kd_tiket'),
                'id_user' => auth::user()->id_user,
                'tgl_buat_task_log' => date('Y-m-d H:i:s'),
                'status_task_log' => 1,
                'deskripsi_task_log' => $request->input('keterangan'),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
        Session::flash('sukses', 'Berhasil Menyelesaikan 1 Task');
        return redirect()->back();
    }
    public function hendledatacabang()
    {
        $datahendlecabang = DB::table('users_handler')->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
            ->where('users_handler.id_user', Auth::user()->id_user)->get();
        $cekdata = DB::table('users_handler_backup')->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler_backup.kd_cabang')
            ->where('users_handler_backup.id_user', Auth::user()->id_user)->where('tgl_hendler_backup', date('Y-m-d'))->get();
        return view('userleader.cabang.hendlecabang', ['data' => $datahendlecabang, 'cekdata' => $cekdata]);
    }
    public function taskharianhendledatacabang($id)
    {
        $cabang = DB::table('tbl_cabang')->where('kd_cabang', $id)->first();
        $sub_kinerja = DB::table('tbl_kinerja_sub')->where('jenis_kinerja_sub', 1)->get();
        return view('userleader.cabang.taskharian', ['data' => $sub_kinerja, 'cabang' => $cabang]);
    }
    public function taskbulananhendledatacabang($id)
    {
        $cabang = DB::table('tbl_cabang')->where('kd_cabang', $id)->first();
        $data = DB::table('users_schedule_maintenance')->where('kd_cabang', $id)->get();
        return view('userleader.cabang.taskbulanan', ['data' => $data, 'cabang' => $cabang]);
    }
    public function tambahmaintenancebulananhendledatacabang($id)
    {

        return view('userleader.cabang.bulanan.form-tambah-maintenance-bulanan', ['id' => $id]);
    }
    public function posttambahmaintenancebulananhendledatacabang(Request $request)
    {
        DB::table('users_schedule_maintenance')->insert([
            'kd_schedule_maintenance' => Str::uuid(),
            'periode' => $request->periode,
            'awal_periode' => $request->awal_periode,
            'akhir_periode' => $request->akhir_periode,
            'verifikator' => $request->verifikator,
            'kd_cabang' => $request->kd_cabang,
            'status_schedule_maintenance' => 0,
            'created_at' => now(),
        ]);
        $data = DB::table('users_schedule_maintenance')->where('kd_cabang', $request->kd_cabang)->get();
        return view('userleader.cabang.bulanan.table-periode-maintenance', ['kd_cabang' => $request->kd_cabang, 'data' => $data]);
    }
    public function detailmaintenancebulananhendledatacabang($id)
    {
        $data = DB::table('users_schedule_maintenance')->where('kd_schedule_maintenance', $id)->first();
        $dataperangkat = DB::table('users_schedule_maintenance_sub')->where('kd_schedule_maintenance', $id)->get();
        return view('userleader.cabang.bulanan.detail-maintenance-bulanan', ['data' => $data, 'dataperangkat' => $dataperangkat]);
    }
    public function tambahdetailmaintenancebulananhendledatacabang($id)
    {
        $data = DB::table('users_schedule_maintenance')->where('kd_schedule_maintenance', $id)->first();
        return view('userleader.cabang.bulanan.form-tambah-perangkat-maintenance', ['data' => $data]);

    }
    public function caridetailmaintenancebulananhendledatacabang(Request $request)
    {
        $url = "http://192.168.50.247/api/datanoinventaris/" . $request->cabang . "/" . $request->nama;
        // $get_result_arr = json_decode($response->getContent($url), true);
        // echo $result;
        $kode = $request->kd_maintenance;
        $response = file_get_contents($url, true);
        $newsData = json_decode($response);
        return view('userleader.cabang.bulanan.list-perangkat', ['newsData' => $newsData, 'kode' => $kode]);
        // return 123;

    }
    public function pilihdetailmaintenancebulananhendledatacabang(Request $request)
    {
        $id = $request->id;
        $no = $request->no;
        $nama = $request->nama;
        $type = $request->type;
        $kode = $request->kode;
        return view('userleader.cabang.bulanan.data-barang', [
            'id' => $id,
            'no' => $no,
            'nama' => $nama,
            'type' => $type,
            'kode' => $kode
        ]);
    }
    public function simpanpilihdetailmaintenancebulananhendledatacabang(Request $request)
    {
        $cek = DB::table('users_schedule_maintenance_sub')->where('kd_schedule_maintenance', $request->kode)->where('id_inventaris', $request->id_inventaris)->first();
        if ($cek) {
            return 'salah';
        } else {
            DB::table('users_schedule_maintenance_sub')->insert([
                'kd_schedule_maintenance' => $request->kode,
                'id_inventaris' => $request->id_inventaris,
                'no_inventaris' => $request->no_inventaris,
                'nama_inventaris' => $request->nama_inventaris,
                'type_inventaris' => $request->type_inventaris,
                'tgl_maintenance_sub' => $request->tgl_maintenance,
                'status_maintenance_sub' => 0,
                'created_at' => now(),
            ]);
            $data = DB::table('users_schedule_maintenance_sub')->where('kd_schedule_maintenance', $request->kode)->get();
            return view('userleader.cabang.bulanan.table-perangkat-maintenance', ['data' => $data]);
        }


    }
    public function perangkatdatadetailmaintenancebulanan($id)
    {
        $url = "http://192.168.50.247/api/datanidinventaris/" . $id;
        // $get_result_arr = json_decode($response->getContent($url), true);
        // echo $result;
        $response = file_get_contents($url, true);
        $newsData = json_decode($response);
    }
    public function maintenanceperangkatdetail($id,$kode)
    {
        $url = "http://192.168.50.247/api/datanidinventaris/" . $id;
        // $get_result_arr = json_decode($response->getContent($url), true);
        // echo $result;
        $response = file_get_contents($url, true);
        $newsData = json_decode($response);
        $dataperangkat = DB::table('users_schedule_maintenance_sub_log')->where('id_maintenance_sub',$kode)->get();
        return view('userleader.cabang.bulanan.detail-perangkat-maintenance',['newsData'=>$newsData ,'kode'=>$kode, 'dataperangkat'=>$dataperangkat]);
    }
    public function maintenanceperangkatsimpandatadetail(Request $request)
    {
        DB::table('users_schedule_maintenance_sub_log')->insert([
            'id_maintenance_sub'=>$request->kode,
            'parameter'=>$request->parameter,
            'parameter_value'=>$request->parameter_value,
            'tgl_input'=>now(),
            'created_at'=>now(),
        ]);
        $dataperangkat = DB::table('users_schedule_maintenance_sub_log')->where('id_maintenance_sub',$request->kode)->get();
        return view('userleader.cabang.bulanan.table-perangkat-maintenance-detail',['dataperangkat'=>$dataperangkat]);
    }
    public function maintenanceverifperangkatsimpandatadetail(Request $request)
    {
        DB::table('users_schedule_maintenance_sub')->where('id_maintenance_sub', $request->id_verif)->update(
            [
                'status_maintenance_sub' => 1,
            ]
        );
        Session::flash('sukses', 'Berhasil Menyelesaikan 1 Prangkat Maintenance');
        return redirect()->back();
    }
    public function customtaskhendledatacabang($id)
    {
        $user = DB::table('tbl_biodata')->where('id_user', Auth::user()->id_user)->first();
        $cabang = DB::table('tbl_cabang')->where('kd_cabang', $id)->first();
        // $sub_kinerja = DB::table('tbl_kinerja_sub')->where('jenis_kinerja_sub', 1)->get();
        $data = DB::table('custom_task')
            ->join('tbl_kinerja', 'tbl_kinerja.kd_kinerja', '=', 'custom_task.kd_kinerja')
            ->where('custom_task.kd_cabang', $id)->get();
        return view('userleader.cabang.customtask', ['cabang' => $cabang, 'data' => $data]);
    }
    public function tambahcustomtaskhendledatacabang(Request $request)
    {
        $kinerja = DB::table('tbl_kinerja')->get();
        $kd_cabang = $request->id;
        return view('userleader.cabang.custom-task.form-custom', ['kinerja' => $kinerja, 'kd_cabang' => $kd_cabang]);
    }
    public function simpantambahcustomtaskhendledatacabang(Request $request)
    {
        $user = DB::table('tbl_biodata')->where('id_user', Auth::user()->id_user)->first();
        DB::table('custom_task')->insert([
            'kd_custom_task' => 'TASK_' . date('Y-m-d_H:i:s') . mt_rand(1000000, 9999999),
            'kd_kinerja' => $request->kd_kinerja,
            'kd_cabang' => $request->kd_cabang,
            'kategori_task' => $request->kategori_task,
            'nama_task' => $request->judul_task,
            'tgl_buat_custom' => date('Y-m-d H:i:s'),
            'deskripsi_custom_task' => $request->desk_task,
            'status_custom_task' => 0,
        ]);
        $data = DB::table('custom_task')
            ->join('tbl_kinerja', 'tbl_kinerja.kd_kinerja', '=', 'custom_task.kd_kinerja')
            ->where('custom_task.kd_cabang', $request->kd_cabang)->get();
        return view('userleader.cabang.custom-task.table-custom-task', ['data' => $data]);
    }
    public function simpantambahcustomtasksubhendledatacabang(Request $request)
    {
        $user = DB::table('tbl_biodata')->where('id_user', Auth::user()->id_user)->first();
        $cek = DB::table('custom_task_sub')->where('kd_custom_task', $request->kode)->where('id_inventaris', $request->id)->first();
        if ($cek) {
            Session::flash('sukses', 'Data Sudah Di Selesaikan');
            return redirect()->back();
        } else {
            DB::table('custom_task_sub')->insert([
                'kd_custom_task' => $request->kode,
                'nama_barang' => $request->nama_barang,
                'id_inventaris' => $request->id,
                'no_inventaris' => $request->no_inventaris,
                'deskripsi_barang' => $request->keterangan,
                'status_barang' => 1,
            ]);
            Session::flash('sukses', 'Berhasil Menyelesaikan 1 Task');
            return redirect()->back();
        }

    }
    public function lengkapicustomtaskhendledatacabang($id)
    {
        $cekdata = DB::table('custom_task')->where('kd_custom_task', $id)->first();
        if ($cekdata->kd_kinerja == 'P001') {
            return view('userleader.customtask.melengkapi', ['data' => $cekdata]);
        } elseif ($cekdata->kd_kinerja == 'P002') {
            return view('userleader.customtask.melengkapi', ['data' => $cekdata]);
        } elseif ($cekdata->kd_kinerja == 'P003') {
            return view('userleader.customtask.melengkapi', ['data' => $cekdata]);
        } elseif ($cekdata->kd_kinerja == 'P004') {
            return view('userleader.customtask.melengkapi', ['data' => $cekdata]);
        } elseif ($cekdata->kd_kinerja == 'P005') {
            return view('userleader.customtask.melengkapi', ['data' => $cekdata]);
        } elseif ($cekdata->kd_kinerja == 'P006') {
            return 'P006';
        } elseif ($cekdata->kd_kinerja == 'P008') {
            return 'P007';
        } elseif ($cekdata->kd_kinerja == 'P009') {

            $cek = DB::table('custom_task')->where('kd_custom_task', $id)->first();
            $url = "http://192.168.50.247/api/datainventaris/" . $cek->kd_cabang . "/05.04.03";
            // $get_result_arr = json_decode($response->getContent($url), true);
            // echo $result;
            $response = file_get_contents($url, true);
            $newsData = json_decode($response);
            //  Initiate curl
            $data = DB::table('custom_task')->where('kd_custom_task', $id)->first();
            // dd($newsData);
            // return view('userleader.customtask.lengkapi');
            return view('userleader.customtask.lengkapi', ['newsData' => $newsData, 'data' => $data]);
        } elseif ($cekdata->kd_kinerja == 'P010') {
            return 'P007';
        } elseif ($cekdata->kd_kinerja == 'P011') {
            $cek = DB::table('custom_task')->where('kd_custom_task', $id)->first();
            return view('userleader.customtask.cari-data-inventaris', ['data' => $cekdata]);
        }


    }
    public function caridatainventaris_formcustomtasksub(Request $request)
    {
        $url = "http://192.168.50.247/api/datanoinventaris/" . $request->kode_costum_cabang . "/" . $request->nama;
        // $get_result_arr = json_decode($response->getContent($url), true);
        // echo $result;
        $response = file_get_contents($url, true);
        $newsData = json_decode($response);
        return view('userleader.customtask.maintenance.maintenance_barang', ['newsData' => $newsData]);
    }
    public function pilihdatainventaris_formcustomtasksub(Request $request)
    {
        $no = $request->no;
        $nama = $request->nama;
        return view('userleader.customtask.maintenance.data-barang', [
            'no' => $no,
            'nama' => $nama
        ]);
    }
    public function simpandata_pilihdatainventaris_formcustomtasksub(Request $request)
    {
        Session::flash('sukses', 'Berhasil Menyelesaikan Task');
        return redirect()->back();
    }
    public function lengkapisubcustomtaskhendledatacabang(Request $request)
    {
        $nama_barang = $request->nama;
        $no_inventaris = $request->no;
        $id = $request->id;
        $kode = $request->kode;
        // $sub_kinerja = DB::table('tbl_kinerja_sub')->where('jenis_kinerja_sub', 1)->get();
        return view('userleader.customtask.lengkapisubdata', ['nama_barang' => $nama_barang, 'no_inventaris' => $no_inventaris, 'id' => $id, 'kode' => $kode]);
    }
    public function posthendlecabang(Request $request)
    {
        $data = DB::table('tbl_kinerja_sub')->where('jenis_kinerja_sub', 1)->get();
        foreach ($data as $value) {
            $cekdata = DB::table('users_handler_record_log')
                ->where('kd_kinerja_sub', $value->kd_kinerja_sub)
                ->where('id_user', Auth::user()->id_user)
                ->where('kd_cabang', $request->input('kd_cabang'))
                ->where('tgl_record', date('Y-m-d'))->first();

            if ($cekdata) {
                Session::flash('sukses', 'Sudah Mengerjakan Task Harian');
                // return redirect()->back();
            } else {
                DB::table('users_handler_record_log')->insert(
                    [
                        'kd_kinerja_sub' => $value->kd_kinerja_sub,
                        'id_user' => auth::user()->id_user,
                        'kd_cabang' => $request->input('kd_cabang'),
                        'tgl_record' => date('Y-m-d'),
                        'ket_kinerja_sub' => $request->input('data' . $value->kd_kinerja_sub),
                        'status_kinerja_sub' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]
                );

            }

        }
        Session::flash('sukses', 'Berhasil Menyelesaikan Task Harian');
        return redirect()->back();

    }
    public function posthendlecabangbackupharian(Request $request)
    {
        DB::table('users_backup_harian')->insert([
            'kd_users_backup_harian' => 'BACKUP_' . date('Y-m-d_H:i:s') . mt_rand(1000000, 9999999),
            'sistem_backup_harian' => $request->sistem_backup,
            'proses_backup_harian' => $request->proses_backup,
            'deskripsi_backup_harian' => $request->deskripsi_backup,
            'status_backup_harian' => 1,
            'tgl_backup_harian' => date('Y-m-d'),
            'kd_cabang' => $request->kd_cabang,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        Session::flash('sukses', 'Berhasil Menyelesaikan Task Harian');
        return redirect()->back();

    }
    public function respondatalaporanuser($id)
    {

        $dataawal = DB::table('tbl_laporan_user')->where('tiket_laporan', $id)->first();
        if ($dataawal->tgl_respon_laporan == "") {
            DB::table('tbl_laporan_user')->where('tiket_laporan', $id)->update(
                [
                    'status_laporan' => 1,
                    'tgl_respon_laporan' => date('Y-m-d H:i:s'),
                ]
            );
        }
        $data = DB::table('tbl_laporan_user')->where('tiket_laporan', $id)->first();
        $date = date_create($data->tgl_respon_laporan);
        date_add($date, date_interval_create_from_date_string('1 hours'));
        return view('userleader.modal.wakturesponuser', ['data' => $data, 'date' => $date]);
    }
}


