<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth::user()->kd_akses == 1) {
            $data_user = DB::table('users')->where('kd_akses','>',1)->count();
            $data_cabang = DB::table('tbl_cabang')->count();
            $data_group = DB::table('tbl_group')->count();
            $data_worklist = DB::table('tbl_worklist')->count();
            $data_group_worklist = DB::table('group_worklist')->count();
            $data_worklist_person = DB::table('worklist_person')->count();
            $data_type_worklist = DB::table('type_worklist')->count();
            $data_tiket_person_worklist = DB::table('tbl_tiket_person_worklist')->count();
            $data_tiket_group_worklist = DB::table('tbl_tiket_group_worklist')->count();
            return view('index',[
                'datauser'=>$data_user,
                'data_cabang'=>$data_cabang,
                'data_group'=>$data_group,
                'data_worklist'=>$data_worklist,
                'data_group_worklist'=>$data_group_worklist,
                'data_worklist_person'=>$data_worklist_person,
                'data_type_worklist'=>$data_type_worklist,
                'data_tiket_person_worklist'=>$data_tiket_person_worklist,
                'data_tiket_group_worklist'=>$data_tiket_group_worklist
            ]);

        }
        elseif(auth::user()->kd_akses == 2) {
            $cabang = DB::table('tbl_cabang')->get();
            $user = DB::table('users')->where('kd_akses', '>','2' )->get();
            $jumlahuser = DB::table('users')->where('kd_akses', '>','1' )->count();
            $data_tiket = DB::table('tbl_tiket_group_worklist')
            ->join('group_worklist','group_worklist.kd_worklist_group','=','tbl_tiket_group_worklist.kd_worklist_group')
            ->join('tbl_worklist','tbl_worklist.kd_worklist','group_worklist.kd_worklist')
            ->get();
            $data_tiket1 = DB::table('tbl_tiket_person_worklist')
            ->join('worklist_person','worklist_person.kd_worklist_person','=','tbl_tiket_person_worklist.kd_worklist_person')
            ->join('tbl_worklist','tbl_worklist.kd_worklist','worklist_person.kd_worklist')
            ->get();
            $jumlah_tiket = DB::table('tbl_tiket_person_worklist','tbl_tiket_group_worklist')
            ->select('tbl_tiket_group_worklist.*','tbl_tiket_person_worklist.*')
            ->count();
            $data = $data_tiket1->merge($data_tiket);
            // dd($data);
            $periode = DB::table('tbl_periode')->where('status_periode',1)->get();
            $tperiode = DB::table('tbl_periode')->where('status_periode',1)->count();
            $datateam = DB::table('tbl_tiket_group_worklist')->count();
            $datateamselesai = DB::table('tbl_tiket_group_worklist')->where('status_tiket',2)->count();
            if ($datateamselesai == 0) {
                $persendatateamselesai = 0;
            } else {
                $persendatateamselesai = ($datateamselesai/$datateam)*100;
            }

            $dataindividu = DB::table('tbl_tiket_person_worklist')->count();
            $dataindividuselesai = DB::table('tbl_tiket_person_worklist')->where('status_tiket',2)->count();
            if ($dataindividuselesai == 0) {
                $persendataindividuselesai = 0;
            } else {
                $persendataindividuselesai = ($dataindividuselesai/$dataindividu)*100;
            }
            $group = DB::table('tbl_group')->count();
            $schedule = DB::table('tbl_schedule')->count();
            return view('index',['cabang'=>$cabang , 'user' => $user , 'tiket' => $data ,
                        'jumlah_tiket' => $jumlah_tiket, 'jumlahuser'=>$jumlahuser, 'periode'=>$periode,
                        'tperiode'=>$tperiode, 'datateam'=>$datateam, 'dataindividu'=>$dataindividu,
                        'persendatateamselesai'=>$persendatateamselesai, 'persendataindividuselesai'=>$persendataindividuselesai,
                        'group'=>$group,'schedule'=>$schedule,
                    ]);
        }
        elseif (auth::user()->kd_akses == 3 ) {

            $worklistperson = DB::table('tbl_tiket_person_worklist')
            ->join('worklist_person','worklist_person.kd_worklist_person','=','tbl_tiket_person_worklist.kd_worklist_person')
            ->join('tbl_worklist','tbl_worklist.kd_worklist','=','worklist_person.kd_worklist')
            ->where('worklist_person.id_user',auth::user()->id_user)
            ->where('tbl_tiket_person_worklist.status_tiket',0)
            ->get();
            $groupworklist = DB::table('tbl_tiket_group_worklist')
            ->join('group_worklist','group_worklist.kd_worklist_group','=','tbl_tiket_group_worklist.kd_worklist_group')
            ->join('tbl_worklist','tbl_worklist.kd_worklist','=','group_worklist.kd_worklist')
            ->join('group_user','group_user.kd_group','=','group_worklist.kd_group')
            ->where('tbl_tiket_group_worklist.status_tiket',0)
            ->where('group_user.id_user',auth::user()->id_user)->get();
            $datalaporan = DB::table('tbl_tiket_laporan')
            ->join('tbl_laporan','tbl_laporan.kd_laporan','=','tbl_tiket_laporan.kd_laporan')
            ->where('tbl_tiket_laporan.status_tiket',0)
            ->get();

            $tugasselesai = DB::table('log_tiket_person_worklist')
            ->where('id_user',auth::user()->id_user)
            ->count();
            $tugasbelumselesai = DB::table('tbl_tiket_person_worklist')
            ->join('worklist_person','worklist_person.kd_worklist_person','=','tbl_tiket_person_worklist.kd_worklist_person')
            ->join('tbl_worklist','tbl_worklist.kd_worklist','=','worklist_person.kd_worklist')
            ->where('worklist_person.id_user',auth::user()->id_user)
            ->where('tbl_tiket_person_worklist.status_tiket',0)
            ->count();
            $tugashariini = DB::table('tbl_tiket_person_worklist')
            ->join('worklist_person','worklist_person.kd_worklist_person','=','tbl_tiket_person_worklist.kd_worklist_person')
            ->join('tbl_worklist','tbl_worklist.kd_worklist','=','worklist_person.kd_worklist')
            ->where('worklist_person.id_user',auth::user()->id_user)
            // ->where('tbl_tiket_person_worklist.status_tiket',0)
            ->where('tbl_tiket_person_worklist.tgl_buat', 'like', '%' . date('Y-m-d') . '%')
            ->count();
            if ($tugasselesai == 0) {
                $persenselesai = $tugasselesai*100/(1+$tugasbelumselesai);
                $persenbelumselesai = $tugasbelumselesai*100/(1+$tugasbelumselesai);
            }else{
                $persenselesai = $tugasselesai*100/($tugasselesai+$tugasbelumselesai);
                $persenbelumselesai = $tugasbelumselesai*100/($tugasselesai+$tugasbelumselesai);
            }
            $tbl_kinerja = DB::table('tbl_kinerja')->get();
            $biodata = DB::table('tbl_biodata')
            ->join('users','users.id_user','=','tbl_biodata.id_user')
            ->where('tbl_biodata.id_user',auth::user()->id_user)->first();

            $groupcabang = DB::table('handler_cabang')
            ->join('group_user','group_user.kd_group','=','handler_cabang.kd_group')
            ->join('tbl_cabang','tbl_cabang.kd_cabang','=','handler_cabang.kd_cabang')
            ->where('group_user.id_user',auth::user()->id_user)->get();
            $periode = DB::table('tbl_periode')->where('status_periode',1)->get();

            $dataschedule = DB::table('tbl_schedule')
            ->get();
            $cabang = DB::table('tbl_cabang')->select('tbl_cabang.kd_cabang','tbl_cabang.nama_cabang')->get();
            return view('index',[   'worklistperson'=>$worklistperson,
                                    'groupworklist'=>$groupworklist,
                                    'tugasselesai'=>$tugasselesai,
                                    'tugasbelumselesai'=>$tugasbelumselesai,
                                    'tugashariini'=>$tugashariini,
                                    'datalaporan'=>$datalaporan,
                                    'persenselesai'=>$persenselesai,
                                    'persenbelumselesai'=>$persenbelumselesai,
                                    'tbl_kinerja'=>$tbl_kinerja,
                                    'biodata'=>$biodata,
                                    'groupcabang'=>$groupcabang,
                                    'periode'=>$periode,
                                    'dataschedule'=>$dataschedule,
                                    'cabang'=>$cabang,
                                ]);
        }
        elseif (auth::user()->kd_akses == 4) {

            $worklistperson = DB::table('tbl_tiket_person_worklist')
            ->join('worklist_person','worklist_person.kd_worklist_person','=','tbl_tiket_person_worklist.kd_worklist_person')
            ->join('tbl_worklist','tbl_worklist.kd_worklist','=','worklist_person.kd_worklist')
            ->where('worklist_person.id_user',auth::user()->id_user)
            ->where('tbl_tiket_person_worklist.status_tiket',0)
            ->get();
            $groupworklist = DB::table('tbl_tiket_group_worklist')
            ->join('group_worklist','group_worklist.kd_worklist_group','=','tbl_tiket_group_worklist.kd_worklist_group')
            ->join('tbl_worklist','tbl_worklist.kd_worklist','=','group_worklist.kd_worklist')
            ->join('group_user','group_user.kd_group','=','group_worklist.kd_group')
            ->where('tbl_tiket_group_worklist.status_tiket',0)
            ->where('group_user.id_user',auth::user()->id_user)->get();
            $datalaporan = DB::table('tbl_tiket_laporan')
            ->join('tbl_laporan','tbl_laporan.kd_laporan','=','tbl_tiket_laporan.kd_laporan')
            ->where('tbl_tiket_laporan.status_tiket',0)
            ->get();

            $tugasselesai = DB::table('log_tiket_person_worklist')
            ->where('id_user',auth::user()->id_user)
            ->count();
            $tugasbelumselesai = DB::table('tbl_tiket_person_worklist')
            ->join('worklist_person','worklist_person.kd_worklist_person','=','tbl_tiket_person_worklist.kd_worklist_person')
            ->join('tbl_worklist','tbl_worklist.kd_worklist','=','worklist_person.kd_worklist')
            ->where('worklist_person.id_user',auth::user()->id_user)
            ->where('tbl_tiket_person_worklist.status_tiket',0)
            ->count();
            $tugashariini = DB::table('tbl_tiket_person_worklist')
            ->join('worklist_person','worklist_person.kd_worklist_person','=','tbl_tiket_person_worklist.kd_worklist_person')
            ->join('tbl_worklist','tbl_worklist.kd_worklist','=','worklist_person.kd_worklist')
            ->where('worklist_person.id_user',auth::user()->id_user)
            // ->where('tbl_tiket_person_worklist.status_tiket',0)
            ->where('tbl_tiket_person_worklist.tgl_buat', 'like', '%' . date('Y-m-d') . '%')
            ->count();
            if ($tugasselesai == 0) {
                $persenselesai = $tugasselesai*100/(1+$tugasbelumselesai);
                $persenbelumselesai = $tugasbelumselesai*100/(1+$tugasbelumselesai);
            }else{
                $persenselesai = $tugasselesai*100/($tugasselesai+$tugasbelumselesai);
                $persenbelumselesai = $tugasbelumselesai*100/($tugasselesai+$tugasbelumselesai);
            }
            $periode = DB::table('tbl_periode')->where('status_periode',1)->get();
            $biodata = DB::table('tbl_biodata')
            ->join('users','users.id_user','=','tbl_biodata.id_user')
            ->where('tbl_biodata.id_user',auth::user()->id_user)->first();
            $groupcabang = DB::table('handler_cabang')
            ->join('group_user','group_user.kd_group','=','handler_cabang.kd_group')
            ->join('tbl_cabang','tbl_cabang.kd_cabang','=','handler_cabang.kd_cabang')
            ->where('group_user.id_user',auth::user()->id_user)->get();
            $tbl_kinerja = DB::table('tbl_kinerja')->get();
            if ($biodata == Null) {
                $data_tiket_task = 0;
            } else {
                $data_tiket_task = DB::table('tbl_tiket_task')
                ->join('tbl_kinerja','tbl_kinerja.kd_kinerja','=','tbl_tiket_task.kd_kinerja')
                ->where('tbl_tiket_task.status_task',1)
                ->where('tbl_tiket_task.kd_cabang',$biodata->kd_cabang)
                ->get();
            }

            $cabang = DB::table('tbl_cabang')->select('tbl_cabang.kd_cabang','tbl_cabang.nama_cabang')->get();
            return view('index',[   'worklistperson'=>$worklistperson,
                                    'groupworklist'=>$groupworklist,
                                    'tugasselesai'=>$tugasselesai,
                                    'tugasbelumselesai'=>$tugasbelumselesai,
                                    'tugashariini'=>$tugashariini,
                                    'datalaporan'=>$datalaporan,
                                    'persenselesai'=>$persenselesai,
                                    'persenbelumselesai'=>$persenbelumselesai,
                                    'periode'=>$periode,
                                    'biodata'=>$biodata,
                                    'groupcabang'=>$groupcabang,
                                    'tbl_kinerja'=>$tbl_kinerja,
                                    'data_tiket_task'=>$data_tiket_task,
                                    'cabang'=>$cabang,
                                ]);
        }
        elseif (auth::user()->kd_akses == 5) {
            $dataschedule = DB::table('tbl_schedule')
            ->join('tbl_kinerja','tbl_kinerja.kd_kinerja','=','tbl_schedule.kd_kinerja')
            ->get();
            return view('index',['dataschedule'=>$dataschedule]);
        }

    }
    public function ubahpassword(Request $request)
    {

        DB::table('users')
                ->where('id',auth::user()->id)
                ->update([
                            'password' => Hash::make($request->input('password')),
                        ]);
        return redirect()->back();
    }
    public function inputdatatiketpersonal(Request $request)
    {
        $tiket = DB::table('tbl_tiket_person_worklist')->where('id_tiket_worklist_person',$request->input('id'))->get();
        DB::table('log_tiket_person_worklist')->insert(
            [
                'no_tiket' => $tiket[0]->no_tiket,
                'id_user' => auth::user()->id_user,
                'keterangan' => $request->input('keterangan'),
                'tgl_buat' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        DB::table('tbl_tiket_person_worklist')
        ->where('no_tiket',$tiket[0]->no_tiket)
        ->update([
                    'status_tiket' => 2,
                ]);
        Session::flash('sukses','Berhasil Input Tugas');
        return redirect()->back();
    }
    public function inputdatatiketgroup(Request $request)
    {
        $tiket = DB::table('tbl_tiket_group_worklist')
        ->join('group_worklist','group_worklist.kd_worklist_group','=','tbl_tiket_group_worklist.kd_worklist_group')
        ->where('id_tiket_group_worklist',$request->input('id'))
        ->get();
        DB::table('log_tiket_worklist_group')->insert(
            [
                'no_tiket' => $tiket[0]->no_tiket,
                'kd_group' => $tiket[0]->kd_group,
                'id_user' => auth::user()->id_user,
                'keterangan' => $request->input('keterangan'),
                'tgl_buat' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        DB::table('tbl_tiket_group_worklist')
        ->where('no_tiket',$tiket[0]->no_tiket)
        ->update([
                    'status_tiket' => 2,
                ]);
        Session::flash('sukses','Berhasil Input Tugas');
        return redirect()->back();
    }
}
