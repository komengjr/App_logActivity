<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function datauseradmin()
    {
        if (auth::user()->kd_akses == 2) {
        $user = DB::table('users')->where('kd_akses', '>','2' )->get();

        return view('admin.modal.datauseradmin',['user'=>$user]);
        }
    }
    public function datadetailuseradmin($id)
    {
        $kinerja = DB::table('tbl_kinerja')->get();
        $user = DB::table('users')->where('id_user',$id)->get();
        $cabang = DB::table('tbl_cabang')
        ->select('tbl_cabang.nama_cabang')
        ->join('handler_cabang','handler_cabang.kd_cabang','=','tbl_cabang.kd_cabang')
        ->join('group_user','group_user.kd_group','=','handler_cabang.kd_group')
        ->where('group_user.id_user',$id)
        ->get();
        return view('admin.modal.user.detail',['detailuser'=>$user , 'kinerja'=>$kinerja, 'cabang'=>$cabang]);
    }
    public function buattiketbaru()
    {
        if (auth::user()->kd_akses == 2) {
            $kinerja = DB::table('tbl_kinerja')->get();
            return view('admin.modal.worklist.tambahtiket',['kinerja'=>$kinerja]);
        }


    }
    public function getdataoptionkinerja($id)
    {
        $cekdata = DB::table('tbl_kinerja')->where('kd_kinerja',$id)->get();
        if (auth::user()->kd_akses == 2) {
            if ($cekdata[0]->jenis_kinerja == 0) {
                # code...
            } elseif($cekdata[0]->jenis_kinerja == 2) {
                $cabang = DB::table('tbl_cabang')->get();
                return view('admin.modal.option.optiontiketbaruindividu',['cabang'=>$cabang,'id'=>$id]);
            } elseif($cekdata[0]->jenis_kinerja == 1) {
                $group = DB::table('tbl_group')->get();
                return view('admin.modal.option.optiontiketbarugroup',['group'=>$group]);
            }


            // if ($id == 1) {
            //     $data = DB::table('tbl_worklist')
            //         ->get();
            //     $person = DB::table('users')->where('kd_akses', '>', 2)->get();
            //     return view('admin.modal.option.optionpersonal', ['data' => $data, 'person' => $person]);
            // } elseif ($id == 2) {
            //     $data = DB::table('tbl_worklist')
            //         ->get();
            //     $group = DB::table('tbl_group')
            //         ->join('group_user', 'tbl_group.kd_group', '=', 'group_user.kd_group')
            //         ->join('handler_cabang', 'handler_cabang.kd_group', '=', 'tbl_group.kd_group')
            //         ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'handler_cabang.kd_cabang')
            //         ->get()->unique('nama_group');
            //     return view('admin.modal.option.optiongroup', ['data' => $data, 'group' => $group]);
            // } elseif ($id == 3) {
            //     return view('admin.modal.option.optionlaporan');
            // } elseif ($id == 4) {
            //     return view('admin.modal.option.optionmandiri');
            // }
        }
    }
    public function getdataoptionkinerjax($id)
    {
        $cekdata = DB::table('tbl_kinerja')->where('kd_kinerja',$id)->get();

        return view('admin.modal.option.datakinerja',['cekdata'=>$cekdata,'id'=>$id]);

    }

    public function datatugasharian()
    {
        if (auth::user()->kd_akses == 2) {
        $data_tiket = DB::table('tbl_tiket_group_worklist')
        ->join('group_worklist','group_worklist.kd_worklist_group','=','tbl_tiket_group_worklist.kd_worklist_group')
        ->join('tbl_worklist','tbl_worklist.kd_worklist','group_worklist.kd_worklist')
        ->get();
        $data_tiket1 = DB::table('tbl_tiket_person_worklist')
        ->join('worklist_person','worklist_person.kd_worklist_person','=','tbl_tiket_person_worklist.kd_worklist_person')
        ->join('tbl_worklist','tbl_worklist.kd_worklist','worklist_person.kd_worklist')
        ->get();
        $data = $data_tiket1->merge($data_tiket);
        return view('admin.modal.daftartugasworklist',['data'=>$data]);
        }
    }
    public function tugasuserbelum()
    {
        if (auth::user()->kd_akses == 2) {
        return view('admin.modal.daftartugasuserbelum');
        }
    }
    public function dataperiode()
    {
        if (auth::user()->kd_akses == 2) {
            $data = DB::table('tbl_periode')->where('status_periode',1)->get();
        return view('admin.modal.daftarperiode',['dataperiode'=>$data]);
        }
    }
    public function showtiketadmin($id)
    {
        $data = DB::table('tbl_tiket_person_worklist')->where('no_tiket','=',$id)->get();
        if ($data->isEmpty()) {
            $data = DB::table('tbl_tiket_group_worklist')->where('no_tiket','=',$id)->get();
            if ($data->isEmpty()) {

            }
        }
        return view('admin.modal.action.showdatatiket',['id'=>$id ,'data'=>$data]);
    }
    public function edittiketadmin($id)
    {
        if (auth::user()->kd_akses == 2) {
            return view('admin.modal.action.editdatatiket',['id'=>$id]);
        }
    }
    public function datamapscabang($id)
    {
        if (auth::user()->kd_akses == 2) {
            $datacabang = DB::table('tbl_cabang')
            ->where('kd_cabang',$id)->get();
            $tiket_personal = DB::table('tbl_tiket_person_worklist')
            ->join('worklist_person','worklist_person.kd_worklist_person','=','tbl_tiket_person_worklist.kd_worklist_person')
            ->join('tbl_worklist','tbl_worklist.kd_worklist','=','worklist_person.kd_worklist')
            ->join('users','users.id_user','=','tbl_tiket_person_worklist.id_user')
            ->join('group_user','group_user.id_user','=','tbl_tiket_person_worklist.id_user')
            ->join('handler_cabang','handler_cabang.kd_group','=','group_user.kd_group')
            ->where('kd_cabang',$id)->get();
            $tiket_group = DB::table('tbl_tiket_group_worklist')
            ->join('users','users.id_user','=','tbl_tiket_group_worklist.id_user')
            ->join('group_worklist','group_worklist.kd_worklist_group','=','tbl_tiket_group_worklist.kd_worklist_group')
            ->join('tbl_worklist','tbl_worklist.kd_worklist','=','group_worklist.kd_worklist')
            ->join('handler_cabang','handler_cabang.kd_group','=','group_worklist.kd_group')
            ->where('kd_cabang',$id)
            ->get();
            return view('admin.modal.cabang',[
                                                'datacabang'=>$datacabang,
                                                'tiket_personal'=>$tiket_personal,
                                                'tiket_group'=>$tiket_group
                                            ]);
        }
    }
    public function inputtiketbaru()
    {
        return view('admin.modal.tiketbaru');
    }
    public function getdataoptiontiket($id)
    {
        if (auth::user()->kd_akses == 2) {
            if ($id == 1) {
                $data = DB::table('tbl_worklist')
                    ->get();
                $person = DB::table('users')->where('kd_akses', '>', 2)->get();
                return view('admin.modal.option.optionpersonal', ['data' => $data, 'person' => $person]);
            } elseif ($id == 2) {
                $data = DB::table('tbl_worklist')
                    ->get();
                $group = DB::table('tbl_group')
                    ->join('group_user', 'tbl_group.kd_group', '=', 'group_user.kd_group')
                    ->join('handler_cabang', 'handler_cabang.kd_group', '=', 'tbl_group.kd_group')
                    ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'handler_cabang.kd_cabang')
                    ->get()->unique('nama_group');
                return view('admin.modal.option.optiongroup', ['data' => $data, 'group' => $group]);
            } elseif ($id == 3) {
                return view('admin.modal.option.optionlaporan');
            } elseif ($id == 4) {
                return view('admin.modal.option.optionmandiri');
            }
        }
    }
    public function buattiketpersonal(Request $request)
    {
        if (auth::user()->kd_akses == 2) {
            if ($request->input('kd_tugas') == 'all') {
                if ($request->input('id_user') == 'all') {
                    $tiket = DB::table('worklist_person')
                    ->get();
                    foreach ($tiket as $item) {
                        DB::table('tbl_tiket_person_worklist')->insert(
                            [
                                'no_tiket' => "tiket_personal_".date('Y-m-d').'_'.date('H:i:s').'_'. Str::random(10),
                                'kd_worklist_person' => $item->kd_worklist_person,
                                'id_user' => $item->id_user,
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses','Berhasil Membuat Tiket Tugas All User');
                    return redirect()->back();
                } else {
                    $tiket = DB::table('worklist_person')
                    ->where('id_user', $request->input('id_user'))
                    ->get();
                    foreach ($tiket as $item) {
                        DB::table('tbl_tiket_person_worklist')->insert(
                            [
                                'no_tiket' => "tiket_personal_".date('Y-m-d').'_'.date('H:i:s').'_'. Str::random(10),
                                'kd_worklist_person' => $item->kd_worklist_person,
                                'id_user' => $request->input('id_user'),
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses','Berhasil Membuat Tiket Tugas User'.$request->input('id_user'));
                    return redirect()->back();
                }
            } else {
                if ($request->input('id_user') == 'all') {

                    $tiket = DB::table('worklist_person')
                    ->where('kd_worklist', $request->input('kd_tugas'))
                    ->get();
                    foreach ($tiket as $item) {
                        DB::table('tbl_tiket_person_worklist')->insert(
                            [
                                'no_tiket' => "tiket_personal_".date('Y-m-d').'_'.date('H:i:s').'_'. Str::random(10),
                                'kd_worklist_person' => $item->kd_worklist_person,
                                'id_user' => $item->id_user,
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses','Berhasil Membuat Tiket Tugas User Dengan Kode : '.$request->input('kd_tugas'));
                    return redirect()->back();

                } else {
                    $tiket = DB::table('worklist_person')
                    ->where('kd_worklist', $request->input('kd_tugas'))
                    ->where('id_user', $request->input('id_user'))
                    ->get();
                    foreach ($tiket as $item) {
                        DB::table('tbl_tiket_person_worklist')->insert(
                            [
                                'no_tiket' => "tiket_personal_".date('Y-m-d').'_'.date('H:i:s').'_'. Str::random(10),
                                'kd_worklist_person' => $item->kd_worklist_person,
                                'id_user' => $item->id_user,
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses','Berhasil Membuat Tiket Dengan ID User : '.$request->input('id_user'));
                    return redirect()->back();
                }

            }


        }
    }
    public function buattiketgroupl(Request $request)
    {
        if (auth::user()->kd_akses == 2) {
            if ($request->input('kd_tugas') == 'all') {
                if ($request->input('kd_group') == 'all') {
                    $tiket = DB::table('group_worklist')
                    ->get();
                    foreach ($tiket as $item) {
                        DB::table('tbl_tiket_group_worklist')->insert(
                            [
                                'no_tiket' => "tiket/group/".date('Y-m-d').'/'.date('H:i:s').'/'. Str::random(10),
                                'kd_worklist_group' => $item->kd_worklist_group,
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses','Berhasil Membuat Tiket Dengan ID Group : '.$request->input('kd_group'));
                    return redirect()->back();
                } else {
                    $tiket = DB::table('group_worklist')
                        ->where('kd_group', $request->input('kd_group'))
                        ->get();
                    foreach ($tiket as $item) {
                        DB::table('tbl_tiket_group_worklist')->insert(
                            [
                                'no_tiket' => "tiket/group/".date('Y-m-d').'/'.date('H:i:s').'/'. Str::random(10),
                                'kd_worklist_group' => $item->kd_worklist_group,
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses','Berhasil Membuat Tiket Dengan ID Group : '.$request->input('kd_group'));
                    return redirect()->back();
                }
            } else {
                if ($request->input('kd_group') == 'all') {
                    $tiket = DB::table('group_worklist')
                        ->where('kd_worklist', $request->input('kd_tugas'))
                        ->get();
                    foreach ($tiket as $item) {
                        DB::table('tbl_tiket_group_worklist')->insert(
                            [
                                'no_tiket' => "tiket/group/".date('Y-m-d').'/'.date('H:i:s').'/'. Str::random(10),
                                'kd_worklist_group' => $item->kd_worklist_group,
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses','Berhasil Membuat Tiket Dengan ID Group : '.$request->input('kd_group'));
                    return redirect()->back();
                } else {
                    $tiket = DB::table('group_worklist')
                        ->where('kd_worklist', $request->input('kd_tugas'))
                        ->where('kd_group', $request->input('kd_group'))
                        ->get();
                    foreach ($tiket as $item) {
                        DB::table('tbl_tiket_group_worklist')->insert(
                            [
                                'no_tiket' => "tiket/group/".date('Y-m-d').'/'.date('H:i:s').'/'. Str::random(10),
                                'kd_worklist_group' => $item->kd_worklist_group,
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses','Berhasil Membuat Tiket Dengan ID Group : '.$request->input('kd_group'));
                    return redirect()->back();
                }

            }


        }
    }
    public function buattiketlaporan(Request $request)
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
                'deskripsi_laporan' => $request->input('deskripsi_laporan'),
                'status_tiket' => 0,
                'tgl_buat' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        Session::flash('sukses','Berhasil Membuat Laporan Dengan Kode Tiket : '.$no_tiket);
		return redirect()->back();
    }

    public function schedule()
    {
        if (auth::user()->kd_akses ==2) {
            $data = DB::table('tbl_schedule')
            ->join('tbl_kinerja','tbl_kinerja.kd_kinerja','=','tbl_schedule.kd_kinerja')
            ->get();
            return view('admin.schedule',['data'=>$data]);
        }

    }
    public function datacalender($id)
    {
        $date = substr($id, 4, 11);
        $datex = strtotime($date);
        $tgl = date('m/d/Y', $datex);
        if (auth::user()->kd_akses ==2) {
            $data = DB::table('tbl_kinerja')->get();
            return view('admin.modal.calender',['data'=>$data,'id'=>$tgl]);
        }

    }
    public function ajaxRequestPost(Request $request)
    {
        $date = substr($request->date, 4, 11);
        $datex = strtotime($date);
        DB::table('tbl_schedule')->insert(
            [
                'kd_schedule' => Str::random(10),
                'kd_kinerja' => $request->judul,
                'tgl_start' => date('Y-m-d', $datex),
                'tgl_akhir' => $request->end,
                'ket_schedule' => $request->ket,
                'status_schedule' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );

        return response()->json(['success'=>'Data Tugas telah di jadwalkan']);
    }
}
