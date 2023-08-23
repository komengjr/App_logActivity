<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use PDF;
class MasterAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function datatiketmasteradmin()
    {
        if (auth::user()->kd_akses == 1) {
            return view('masteradmin.form.tiket.tiketbaru');
        }
    }
    public function getdataoptiontiket($id)
    {
        if (auth::user()->kd_akses == 1) {
            if ($id == 1) {
                $data = DB::table('tbl_worklist')
                    ->get();
                $person = DB::table('users')->where('kd_akses', '>', 2)->get();
                return view('masteradmin.form.tiket.optionpersonal', ['data' => $data, 'person' => $person]);
            } elseif ($id == 2) {
                $data = DB::table('tbl_worklist')
                    ->get();
                $group = DB::table('tbl_group')
                    ->join('group_user', 'tbl_group.kd_group', '=', 'group_user.kd_group')
                    ->join('handler_cabang', 'handler_cabang.kd_group', '=', 'tbl_group.kd_group')
                    ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'handler_cabang.kd_cabang')
                    ->get()->unique('nama_group');
                return view('masteradmin.form.tiket.optiongroup', ['data' => $data, 'group' => $group]);
            }
        }
    }
    public function buattiketpersonal(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
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
                                'no_tiket' => "tiket/personal/".date('Y-m-d').'_'.date('H:i:s').'_'. Str::random(10),
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
        if (auth::user()->kd_akses == 1) {
            if ($request->input('kd_tugas') == 'all') {
                if ($request->input('kd_group') == 'all') {
                    $tiket = DB::table('group_worklist')
                    ->get();
                    foreach ($tiket as $item) {
                        DB::table('tbl_tiket_group_worklist')->insert(
                            [
                                'no_tiket' => "tiket_group_".date('Y-m-d').'_'.date('H:i:s').'_'. Str::random(10),
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
                                'no_tiket' => "tiket_group_".date('Y-m-d').'_'.date('H:i:s').'_'. Str::random(10),
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
                                'no_tiket' => "tiket_group_".date('Y-m-d').'_'.date('H:i:s').'_'. Str::random(10),
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
                                'no_tiket' => "tiket_group_".date('Y-m-d').'_'.date('H:i:s').'_'. Str::random(10),
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
    public function datauser()
    {
        if (auth::user()->kd_akses == 1) {

            $data = DB::table('users')
                // ->select('users.*')
                ->join('tbl_akses', 'tbl_akses.kd_akses', '=', 'users.kd_akses')
                ->get();
            // dd($data);
            return view('masteradmin.form.user', ['data' => $data]);
        }
    }
    public function datausertambah()
    {
        if (auth::user()->kd_akses == 1) {
            return view('masteradmin.form.tambahuser');
        }
    }
    public function datauseredit($id)
    {
        if (auth::user()->kd_akses == 1) {
            $data = DB::table('users')
                ->where('id', $id)
                ->get();
            return view('masteradmin.form.edituser', ['data' => $data]);
        }
    }
    public function datausertambahpost(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
            DB::table('users')->insert(
                [
                    'id_user' => "user-" . Str::random(5),
                    'name' => $request->input('nama'),
                    'email' => $request->input('username'),
                    'password' => Hash::make($request->input('password')),
                    'kd_akses' => $request->input('akses'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
            $data = DB::table('users')
                ->join('tbl_akses', 'tbl_akses.kd_akses', '=', 'users.kd_akses')
                ->get();
            return view('masteradmin.form.tbluser', ['data' => $data]);
        }
    }
    public function datausereditpost(Request $request)
    {
        if (auth::user()->kd_akses == 1) {

            if ($request->input('password') == "") {
                DB::table('users')
                    ->where('id', $request->input('id'))
                    ->update([
                        'name' => $request->input('nama'),
                        'email' => $request->input('username'),
                        'kd_akses' => $request->input('akses'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            } else {
                DB::table('users')
                    ->where('id', $request->input('id'))
                    ->update([
                        'name' => $request->input('nama'),
                        'email' => $request->input('username'),
                        'kd_akses' => $request->input('akses'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'password' => Hash::make($request->input('password')),
                    ]);
            }

            $data = DB::table('users')
                ->join('tbl_akses', 'tbl_akses.kd_akses', '=', 'users.kd_akses')
                ->get();
            return view('masteradmin.form.tbluser', ['data' => $data]);
        }
    }
    public function datacabang()
    {
        if (auth::user()->kd_akses == 1) {
            $cabang = DB::table('tbl_cabang')
                ->get();
            return view('masteradmin.form.cabang', ['cabang' => $cabang]);
        }
    }
    public function datacabangtambah()
    {
        if (auth::user()->kd_akses == 1) {
            return view('masteradmin.form.tambahcabang');
        }
    }
    public function datacabangdetail($id)
    {
        if (auth::user()->kd_akses == 1) {
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
            return view('masteradmin.form.cabang.detail',['tiket_personal'=>$tiket_personal,'tiket_group'=>$tiket_group]);
        }
    }
    public function datacabangtambahpost(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
            DB::table('tbl_cabang')->insert(
                [
                    'kd_cabang' => $request->input('kd_cabang'),
                    'nama_cabang' => $request->input('nama_cabang'),
                    'latitude' => $request->input('latitude'),
                    'longtitude' => $request->input('longtitude'),
                    'city' => $request->input('city'),
                    'phone' => $request->input('phone'),
                    'alamat' => $request->input('alamat'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
            $cabang = DB::table('tbl_cabang')
                ->get();
            return view('masteradmin.form.tblcabang', ['cabang' => $cabang]);
        }
    }
    public function datagroup()
    {
        if (auth::user()->kd_akses == 1) {
            $data = DB::table('tbl_group')
                ->get();
            return view('masteradmin.form.group', ['data' => $data]);
        }
    }
    public function datagrouptambah()
    {
        if (auth::user()->kd_akses == 1) {
            return view('masteradmin.form.tambahgroup');
        }
    }
    public function datagrouptambahpost(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
            DB::table('tbl_group')->insert(
                [

                    'kd_group' => $request->input('kd_group'),
                    'nama_group' => $request->input('nama_group'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
            $data = DB::table('tbl_group')
                ->get();
            return view('masteradmin.form.tblgroup', ['data' => $data]);
        }
    }
    public function datagroupshow($id)
    {
        if (auth::user()->kd_akses == 1) {
            $cabang = DB::table('handler_cabang')
                ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'handler_cabang.kd_cabang')
                ->where('kd_group', $id)
                ->get();
            $user = DB::table('group_user')
                ->join('users', 'users.id_user', '=', 'group_user.id_user')
                ->where('kd_group', $id)
                ->get();
            return view('masteradmin.form.showdatagroup', ['id' => $id, 'cabang' => $cabang, 'user' => $user]);
        }
    }
    public function datagrouptambahcabang($id)
    {
        if (auth::user()->kd_akses == 1) {
            $data = DB::table('tbl_cabang')
                ->get();
            return view('masteradmin.form.subgroup.tambahcabang', ['id' => $id, 'data' => $data]);
        }
    }
    public function datagrouptambahuser($id)
    {
        if (auth::user()->kd_akses == 1) {
            $data = DB::table('users')
                ->where('kd_akses', '>', 2)
                ->get();
            return view('masteradmin.form.subgroup.tambahuser', ['id' => $id, 'data' => $data]);
        }
    }
    public function datagrouptambahpostcabangbaru(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
            DB::table('handler_cabang')->insert(
                [
                    'kd_group' => $request->input('id'),
                    'kd_cabang' => $request->input('kd_cabang'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
            $cabang = DB::table('handler_cabang')
                ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'handler_cabang.kd_cabang')
                ->where('kd_group', $request->input('id'))
                ->get();
            $user = DB::table('group_user')
                ->join('users', 'users.id_user', '=', 'group_user.id_user')
                ->where('kd_group', $request->input('id'))
                ->get();
            return view('masteradmin.form.showdatagroup', ['id' => $request->input('id'), 'cabang' => $cabang, 'user' => $user]);
        }
    }
    public function datagrouptambahpostuserbaru(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
            DB::table('group_user')->insert(
                [
                    'kd_group' => $request->input('id'),
                    'id_user' => $request->input('id_user'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
            $cabang = DB::table('handler_cabang')
                ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'handler_cabang.kd_cabang')
                ->where('kd_group', $request->input('id'))
                ->get();
            $user = DB::table('group_user')
                ->join('users', 'users.id_user', '=', 'group_user.id_user')
                ->where('kd_group', $request->input('id'))
                ->get();
            return view('masteradmin.form.showdatagroup', ['id' => $request->input('id'), 'cabang' => $cabang, 'user' => $user]);
        }
    }
    public function dataworklist()
    {
        if (auth::user()->kd_akses == 1) {
            $data = DB::table('tbl_worklist')
                ->get();
            return view('masteradmin.form.worklist', ['data' => $data]);
        }
    }
    public function datatask()
    {
        if (auth::user()->kd_akses == 1) {
            $data = DB::table('tbl_tiket_task')
            ->select('tbl_tiket_task.*','tbl_cabang.nama_cabang','tbl_kinerja.kinerja')
            ->join('tbl_cabang','tbl_cabang.kd_cabang','=','tbl_tiket_task.kd_cabang')
            ->join('tbl_kinerja','tbl_kinerja.kd_kinerja','=','tbl_tiket_task.kd_kinerja')
            ->get();
            return view('masteradmin.form.task', ['data' => $data]);
        }
    }
    public function showdattask($id)
    {
        if (auth::user()->kd_akses == 1) {
            $datakinerja = DB::table('tbl_kinerja')->get();
            $tbl_periode = DB::table('tbl_periode')->get();
            $pdf = PDF::loadview('masteradmin.form.report.task',['id'=>$id,'datakinerja'=>$datakinerja ])->setPaper('A4','potrait');
            return $pdf->stream();
        }
    }

    public function dataworklisttambah()
    {
        if (auth::user()->kd_akses == 1) {
            $type = DB::table('type_worklist')->get();
            return view('masteradmin.form.tambahworklist', ['type' => $type]);
        }
    }
    public function dataworklistedit($id)
    {
        if (auth::user()->kd_akses == 1) {
            $data = DB::table('tbl_worklist')
            ->where('id_worklist',$id)
            ->get();
            $type = DB::table('type_worklist')->get();
            return view('masteradmin.form.worklist.edit', ['data' => $data,'type' => $type]);
        }
    }
    public function dataworklisttambahpost(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
            DB::table('tbl_worklist')->insert(
                [
                    'kd_worklist' => "WRK-" . Str::random(7),
                    'nama_worklist' => $request->input('nama_worklist'),
                    'type_worklist' => $request->input('type'),
                    'jenis_worklist' => $request->input('jenis'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
            $data = DB::table('tbl_worklist')
                ->get();
            return view('masteradmin.form.tblworklist', ['data' => $data]);
        }
    }
    public function dataworklisteditpost(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
            // DB::table('tbl_worklist')->insert(
            //     [
            //         'kd_worklist' => "WRK-" . Str::random(7),
            //         'nama_worklist' => $request->input('nama_worklist'),
            //         'type_worklist' => $request->input('type'),
            //         'jenis_worklist' => $request->input('jenis'),
            //         'created_at' => date('Y-m-d H:i:s'),
            //     ]
            // );
            $data = DB::table('tbl_worklist')
                ->get();
            return view('masteradmin.form.worklist.tblworklist',['data'=>$data]);
        }
    }
    public function dataworklisthapuspost(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
            // DB::table('tbl_worklist')->insert(
            //     [
            //         'kd_worklist' => "WRK-" . Str::random(7),
            //         'nama_worklist' => $request->input('nama_worklist'),
            //         'type_worklist' => $request->input('type'),
            //         'jenis_worklist' => $request->input('jenis'),
            //         'created_at' => date('Y-m-d H:i:s'),
            //     ]
            // );
            $data = DB::table('tbl_worklist')
                ->get();
            return view('masteradmin.form.worklist.tblworklist',['data'=>$data]);
        }
    }
    public function dataworklistgroup()
    {
        if (auth::user()->kd_akses == 1) {
            $data = DB::table('group_worklist')
                ->join('tbl_group', 'tbl_group.kd_group', '=', 'group_worklist.kd_group')
                ->join('tbl_worklist', 'tbl_worklist.kd_worklist', '=', 'group_worklist.kd_worklist')
                ->get();
            return view('masteradmin.form.group.groupworklist', ['data' => $data]);
        }
    }
    public function dataworklistgrouptambah()
    {
        if (auth::user()->kd_akses == 1) {
            $group = DB::table('tbl_group')->get();
            $worklist = DB::table('tbl_worklist')->where('jenis_worklist',2)->get();
            return view('masteradmin.form.group.tambahgroupworklist', ['group' => $group, 'worklist' => $worklist]);
        }
    }
    public function dataworklistgroupedit($id)
    {
        if (auth::user()->kd_akses == 1) {
            $data = DB::table('group_worklist')->where('id_group_worklist',$id)->get();
            $group = DB::table('tbl_group')->get();
            $worklist = DB::table('tbl_worklist')->where('jenis_worklist',2)->get();
            return view('masteradmin.form.group.editgroupworklist', ['group' => $group, 'worklist' => $worklist ,'data'=>$data]);
        }
    }
    public function datagroupworklisttambahpost(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
            DB::table('group_worklist')->insert(
                [
                    'kd_worklist_group' => "grwrk-" . Str::random(10),
                    'kd_worklist' => $request->input('kd_worklist'),
                    'kd_group' => $request->input('kd_group'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
            $data = DB::table('group_worklist')
                ->join('tbl_group', 'tbl_group.kd_group', '=', 'group_worklist.kd_group')
                ->join('tbl_worklist', 'tbl_worklist.kd_worklist', '=', 'group_worklist.kd_worklist')
                ->get();
            return view('masteradmin.form.group.tblgroupworklist', ['data' => $data]);
        }
    }
    public function datagroupworklisteditpost(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
            // DB::table('group_worklist')->insert(
            //     [
            //         'kd_worklist_group' => "grwrk-" . Str::random(10),
            //         'kd_worklist' => $request->input('kd_worklist'),
            //         'kd_group' => $request->input('kd_group'),
            //         'created_at' => date('Y-m-d H:i:s'),
            //     ]
            // );
            $data = DB::table('group_worklist')
                ->join('tbl_group', 'tbl_group.kd_group', '=', 'group_worklist.kd_group')
                ->join('tbl_worklist', 'tbl_worklist.kd_worklist', '=', 'group_worklist.kd_worklist')
                ->get();
            return view('masteradmin.form.group.tblgroupworklist', ['data' => $data]);
        }
    }
    public function datagroupworklisthapuspost(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
            // DB::table('group_worklist')->insert(
            //     [
            //         'kd_worklist_group' => "grwrk-" . Str::random(10),
            //         'kd_worklist' => $request->input('kd_worklist'),
            //         'kd_group' => $request->input('kd_group'),
            //         'created_at' => date('Y-m-d H:i:s'),
            //     ]
            // );
            $data = DB::table('group_worklist')
                ->join('tbl_group', 'tbl_group.kd_group', '=', 'group_worklist.kd_group')
                ->join('tbl_worklist', 'tbl_worklist.kd_worklist', '=', 'group_worklist.kd_worklist')
                ->get();
            return view('masteradmin.form.group.tblgroupworklist', ['data' => $data]);
        }
    }
    public function datapersonworklist()
    {
        if (auth::user()->kd_akses == 1) {
            $data = DB::table('worklist_person')
                ->join('tbl_worklist', 'tbl_worklist.kd_worklist', '=', 'worklist_person.kd_worklist')
                ->join('users', 'users.id_user', '=', 'worklist_person.id_user')
                ->get();
            return view('masteradmin.form.personworklist.personworklist', ['data' => $data]);
        }
    }
    public function datapersonworklisttambah()
    {
        if (auth::user()->kd_akses == 1) {
            $user = DB::table('users')->where('kd_akses', '>', 2)->get();
            $worklist = DB::table('tbl_worklist')->where('jenis_worklist',1)->get();
            return view('masteradmin.form.personworklist.tambahpersonworklist', ['user' => $user, 'worklist' => $worklist]);
        }
    }
    public function datapersonworklistedit($id)
    {
        if (auth::user()->kd_akses == 1) {
            $data = DB::table('worklist_person')->where('id_worklist_person',$id)->get();
            $user = DB::table('users')->where('kd_akses', '>', 2)->get();
            $worklist = DB::table('tbl_worklist')->where('jenis_worklist',1)->get();
            return view('masteradmin.form.personworklist.editpersonworklist', ['user' => $user, 'worklist' => $worklist,'data'=>$data]);
        }
    }
    public function datapersonworklisttambahpost(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
            DB::table('worklist_person')->insert(
                [
                    'kd_worklist_person' => "WRK-" . Str::random(7),
                    'kd_worklist' => $request->input('kd_worklist'),
                    'id_user' => $request->input('id_user'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
            $data = DB::table('worklist_person')
                ->join('tbl_worklist', 'tbl_worklist.kd_worklist', '=', 'worklist_person.kd_worklist')
                ->join('users', 'users.id_user', '=', 'worklist_person.id_user')
                ->get();
            return view('masteradmin.form.personworklist.tblpersonworklist', ['data' => $data]);
        }
    }
    public function datapersonworklisteditpost(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
            // DB::table('worklist_person')->insert(
            //     [
            //         'kd_worklist_person' => "WRK-" . Str::random(7),
            //         'kd_worklist' => $request->input('kd_worklist'),
            //         'id_user' => $request->input('id_user'),
            //         'created_at' => date('Y-m-d H:i:s'),
            //     ]
            // );
            $data = DB::table('worklist_person')
                ->join('tbl_worklist', 'tbl_worklist.kd_worklist', '=', 'worklist_person.kd_worklist')
                ->join('users', 'users.id_user', '=', 'worklist_person.id_user')
                ->get();
            return view('masteradmin.form.personworklist.tblpersonworklist', ['data' => $data]);
        }
    }
    public function datapersonworklisthapuspost(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
            // DB::table('worklist_person')->insert(
            //     [
            //         'kd_worklist_person' => "WRK-" . Str::random(7),
            //         'kd_worklist' => $request->input('kd_worklist'),
            //         'id_user' => $request->input('id_user'),
            //         'created_at' => date('Y-m-d H:i:s'),
            //     ]
            // );
            $data = DB::table('worklist_person')
                ->join('tbl_worklist', 'tbl_worklist.kd_worklist', '=', 'worklist_person.kd_worklist')
                ->join('users', 'users.id_user', '=', 'worklist_person.id_user')
                ->get();
            return view('masteradmin.form.personworklist.tblpersonworklist', ['data' => $data]);
        }
    }
    public function datatypeworklist()
    {
        if (auth::user()->kd_akses == 1) {
            $data = DB::table('type_worklist')->get();
            return view('masteradmin.form.typeworklist.typeworklist', ['data' => $data]);
        }
    }
    public function datatypeworklisttambah()
    {
        if (auth::user()->kd_akses == 1) {
            return view('masteradmin.form.typeworklist.tambahtypeworklist');
        }
    }
    public function datatypeworklisttambahpost(Request $request)
    {
        if (auth::user()->kd_akses == 1) {
            DB::table('type_worklist')->insert(
                [
                    'type_worklist' => $request->input('type_worklist'),
                    'kriteria_worklist' => $request->input('kriteria_worklist'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
            $data = DB::table('type_worklist')->get();
            return view('masteradmin.form.typeworklist.tbltypeworklist', ['data' => $data]);
        }
    }
    public function datatiketgroupworklist()
    {
        $data = DB::table('tbl_tiket_group_worklist')
        ->join('group_worklist','group_worklist.kd_worklist_group','=','tbl_tiket_group_worklist.kd_worklist_group')
        ->join('tbl_worklist','tbl_worklist.kd_worklist','=','group_worklist.kd_worklist')
        ->get();
        return view('masteradmin.form.tiketgroup.tiketgroupworklist',['data'=>$data]);
    }
    public function datatiketpersonalworklist()
    {
        $data = DB::table('tbl_tiket_person_worklist')
        ->join('worklist_person','worklist_person.kd_worklist_person','=','tbl_tiket_person_worklist.kd_worklist_person')
        ->join('tbl_worklist','tbl_worklist.kd_worklist','=','worklist_person.kd_worklist')
        ->get();
        return view('masteradmin.form.tiketpersonal.datatiketpersonalworklist',['data'=>$data]);
    }
    public function datatiketlaporan()
    {
        return view('masteradmin.form.tiketlaporan.datatiketlaporan');
    }

    public function datamaps()
    {
        if (auth::user()->kd_akses == 1) {
            return view('masteradmin.form.maps.index');
        }
    }
}
