<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Piket;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function datauseradmin()
    {
        if (auth::user()->kd_akses == 2) {
            $user = DB::table('users')
                ->where('kd_akses', '>', '2')->get();

            return view('admin.modal.datauseradmin', ['user' => $user]);
        }
    }
    public function datadetailuseradmin($id)
    {
        $kinerja = DB::table('tbl_kinerja')->get();
        $user = DB::table('users')->where('id_user', $id)->get();
        $cabang = DB::table('tbl_cabang')
            ->select('tbl_cabang.nama_cabang')
            ->join('handler_cabang', 'handler_cabang.kd_cabang', '=', 'tbl_cabang.kd_cabang')
            ->join('group_user', 'group_user.kd_group', '=', 'handler_cabang.kd_group')
            ->where('group_user.id_user', $id)
            ->get();
        return view('admin.modal.user.detail', ['detailuser' => $user, 'kinerja' => $kinerja, 'cabang' => $cabang]);
    }
    public function tambahdatauseradmin()
    {
        return view('admin.modal.user.tambah', []);
    }
    public function nonaktifdatauseradmin($id)
    {
        DB::table('users')
            ->where('id_user', $id)
            ->update([
                'status_user' => 0,
            ]);
        Session::flash('sukses', 'Berhasil menonaktifkan user ' . $id);
        return redirect()->back();
    }
    public function aktifdatauseradmin($id)
    {
        DB::table('users')
            ->where('id_user', $id)
            ->update([
                'status_user' => 1,
            ]);
        Session::flash('sukses', 'Berhasil Mengaktifkan user ' . $id);
        return redirect()->back();
    }
    public function tambahdataperiodeadmin()
    {
        return view('admin.modal.periode.tambah', []);
    }
    public function buattiketbaru()
    {
        if (auth::user()->kd_akses == 2) {
            $kinerja = DB::table('tbl_kinerja')->get();
            return view('admin.modal.worklist.tambahtiket', ['kinerja' => $kinerja]);
        }


    }
    public function getdataoptionkinerja($id)
    {
        $cekdata = DB::table('tbl_kinerja')->where('kd_kinerja', $id)->get();
        if (auth::user()->kd_akses == 2) {
            if ($cekdata[0]->jenis_kinerja == 0) {
                # code...
            } elseif ($cekdata[0]->jenis_kinerja == 2) {
                $cabang = DB::table('tbl_cabang')->get();
                return view('admin.modal.option.optiontiketbaruindividu', ['cabang' => $cabang, 'id' => $id]);
            } elseif ($cekdata[0]->jenis_kinerja == 1) {
                $group = DB::table('tbl_group')->get();
                return view('admin.modal.option.optiontiketbarugroup', ['group' => $group]);
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
        $cekdata = DB::table('tbl_kinerja')->where('kd_kinerja', $id)->get();

        return view('admin.modal.option.datakinerja', ['cekdata' => $cekdata, 'id' => $id]);

    }

    public function datatugasjadwal()
    {
        if (auth::user()->kd_akses == 2) {
            $data_schedule = DB::table('tbl_schedule')
                ->join('tbl_kinerja', 'tbl_kinerja.kd_kinerja', '=', 'tbl_schedule.kd_kinerja')
                ->get();
            return view('admin.modal.daftartugasschedule', ['data' => $data_schedule]);
        }
    }
    public function tugasuserlainnya()
    {
        if (auth::user()->kd_akses == 2) {
            $data_tiket = DB::table('tbl_tiket_task')
                ->join('tbl_kinerja', 'tbl_tiket_task.kd_kinerja', '=', 'tbl_tiket_task.kd_kinerja')
                // ->join('tbl_worklist','tbl_worklist.kd_worklist','group_worklist.kd_worklist')
                ->get();

            return view('admin.modal.daftartugaslainnya', ['data' => $data_tiket]);
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
            $data = DB::table('tbl_periode')->where('status_periode', 1)->get();
            return view('admin.modal.daftarperiode', ['dataperiode' => $data]);
        }
    }
    public function datagroup()
    {
        if (auth::user()->kd_akses == 2) {
            $data = DB::table('tbl_group')->get();
            return view('admin.modal.daftargorup', ['data' => $data]);
        }
    }
    public function showtiketadmin($id)
    {
        $data = DB::table('tbl_tiket_person_worklist')->where('no_tiket', '=', $id)->get();
        if ($data->isEmpty()) {
            $data = DB::table('tbl_tiket_group_worklist')->where('no_tiket', '=', $id)->get();
            if ($data->isEmpty()) {

            }
        }
        return view('admin.modal.action.showdatatiket', ['id' => $id, 'data' => $data]);
    }
    public function edittiketadmin($id)
    {
        if (auth::user()->kd_akses == 2) {
            return view('admin.modal.action.editdatatiket', ['id' => $id]);
        }
    }
    public function datamapscabang($id)
    {
        if (auth::user()->kd_akses == 2) {
            $datacabang = DB::table('tbl_cabang')
                ->where('kd_cabang', $id)->get();
            $tiket_personal = DB::table('tbl_tiket_person_worklist')
                ->join('worklist_person', 'worklist_person.kd_worklist_person', '=', 'tbl_tiket_person_worklist.kd_worklist_person')
                ->join('tbl_worklist', 'tbl_worklist.kd_worklist', '=', 'worklist_person.kd_worklist')
                ->join('users', 'users.id_user', '=', 'tbl_tiket_person_worklist.id_user')
                ->join('group_user', 'group_user.id_user', '=', 'tbl_tiket_person_worklist.id_user')
                ->join('handler_cabang', 'handler_cabang.kd_group', '=', 'group_user.kd_group')
                ->where('kd_cabang', $id)->get();
            $tiket_group = DB::table('tbl_tiket_group_worklist')
                ->join('users', 'users.id_user', '=', 'tbl_tiket_group_worklist.id_user')
                ->join('group_worklist', 'group_worklist.kd_worklist_group', '=', 'tbl_tiket_group_worklist.kd_worklist_group')
                ->join('tbl_worklist', 'tbl_worklist.kd_worklist', '=', 'group_worklist.kd_worklist')
                ->join('handler_cabang', 'handler_cabang.kd_group', '=', 'group_worklist.kd_group')
                ->where('kd_cabang', $id)
                ->get();
            return view('admin.modal.cabang', [
                'datacabang' => $datacabang,
                'tiket_personal' => $tiket_personal,
                'tiket_group' => $tiket_group
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
                                'no_tiket' => "tiket_personal_" . date('Y-m-d') . '_' . date('H:i:s') . '_' . Str::random(10),
                                'kd_worklist_person' => $item->kd_worklist_person,
                                'id_user' => $item->id_user,
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses', 'Berhasil Membuat Tiket Tugas All User');
                    return redirect()->back();
                } else {
                    $tiket = DB::table('worklist_person')
                        ->where('id_user', $request->input('id_user'))
                        ->get();
                    foreach ($tiket as $item) {
                        DB::table('tbl_tiket_person_worklist')->insert(
                            [
                                'no_tiket' => "tiket_personal_" . date('Y-m-d') . '_' . date('H:i:s') . '_' . Str::random(10),
                                'kd_worklist_person' => $item->kd_worklist_person,
                                'id_user' => $request->input('id_user'),
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses', 'Berhasil Membuat Tiket Tugas User' . $request->input('id_user'));
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
                                'no_tiket' => "tiket_personal_" . date('Y-m-d') . '_' . date('H:i:s') . '_' . Str::random(10),
                                'kd_worklist_person' => $item->kd_worklist_person,
                                'id_user' => $item->id_user,
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses', 'Berhasil Membuat Tiket Tugas User Dengan Kode : ' . $request->input('kd_tugas'));
                    return redirect()->back();

                } else {
                    $tiket = DB::table('worklist_person')
                        ->where('kd_worklist', $request->input('kd_tugas'))
                        ->where('id_user', $request->input('id_user'))
                        ->get();
                    foreach ($tiket as $item) {
                        DB::table('tbl_tiket_person_worklist')->insert(
                            [
                                'no_tiket' => "tiket_personal_" . date('Y-m-d') . '_' . date('H:i:s') . '_' . Str::random(10),
                                'kd_worklist_person' => $item->kd_worklist_person,
                                'id_user' => $item->id_user,
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses', 'Berhasil Membuat Tiket Dengan ID User : ' . $request->input('id_user'));
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
                                'no_tiket' => "tiket/group/" . date('Y-m-d') . '/' . date('H:i:s') . '/' . Str::random(10),
                                'kd_worklist_group' => $item->kd_worklist_group,
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses', 'Berhasil Membuat Tiket Dengan ID Group : ' . $request->input('kd_group'));
                    return redirect()->back();
                } else {
                    $tiket = DB::table('group_worklist')
                        ->where('kd_group', $request->input('kd_group'))
                        ->get();
                    foreach ($tiket as $item) {
                        DB::table('tbl_tiket_group_worklist')->insert(
                            [
                                'no_tiket' => "tiket/group/" . date('Y-m-d') . '/' . date('H:i:s') . '/' . Str::random(10),
                                'kd_worklist_group' => $item->kd_worklist_group,
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses', 'Berhasil Membuat Tiket Dengan ID Group : ' . $request->input('kd_group'));
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
                                'no_tiket' => "tiket/group/" . date('Y-m-d') . '/' . date('H:i:s') . '/' . Str::random(10),
                                'kd_worklist_group' => $item->kd_worklist_group,
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses', 'Berhasil Membuat Tiket Dengan ID Group : ' . $request->input('kd_group'));
                    return redirect()->back();
                } else {
                    $tiket = DB::table('group_worklist')
                        ->where('kd_worklist', $request->input('kd_tugas'))
                        ->where('kd_group', $request->input('kd_group'))
                        ->get();
                    foreach ($tiket as $item) {
                        DB::table('tbl_tiket_group_worklist')->insert(
                            [
                                'no_tiket' => "tiket/group/" . date('Y-m-d') . '/' . date('H:i:s') . '/' . Str::random(10),
                                'kd_worklist_group' => $item->kd_worklist_group,
                                'status_tiket' => 0,
                                'tgl_buat' => date('Y-m-d H:i:s'),
                                'created_at' => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                    Session::flash('sukses', 'Berhasil Membuat Tiket Dengan ID Group : ' . $request->input('kd_group'));
                    return redirect()->back();
                }

            }


        }
    }
    public function buattiketlaporan(Request $request)
    {
        $kd_laporan = "laporan-" . Str::random(10);
        $no_tiket = "tiket/laporan/" . date('Y-m-d') . "/" . date('H:i:s') . "/" . Str::random(5);
        DB::table('tbl_laporan')->insert(
            [
                'kd_laporan' => $kd_laporan,
                'nama_laporan' => $request->input('judul_laporan'),
                'type_laporan' => $request->input('type_laporan'),
                'status_laporan' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
        DB::table('tbl_tiket_laporan')->insert(
            [
                'no_tiket' => $no_tiket,
                'kd_laporan' => $kd_laporan,
                'id_user' => $request->input('type_laporan'),
                'deskripsi_laporan' => $request->input('deskripsi_laporan'),
                'status_tiket' => 0,
                'tgl_buat' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
        Session::flash('sukses', 'Berhasil Membuat Laporan Dengan Kode Tiket : ' . $no_tiket);
        return redirect()->back();
    }
    public function tambahuserbaru(Request $request)
    {
        $cekuser = DB::table('users')->where('email', $request->input('username'))->count();
        if ($cekuser == 0) {
            DB::table('users')->insert(
                [
                    'id_user' => "user-" . Str::random(5),
                    'name' => $request->input('nama_lengkap'),
                    'email' => $request->input('username'),
                    'password' => Hash::make($request->input('password')),
                    'kd_akses' => $request->input('akses'),
                    'status_user' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
            Session::flash('sukses', 'Berhasil Membuat User ' . $request->input('nama_lengkap'));
            return redirect()->back();
        } else {
            Session::flash('gagal', 'User ' . $request->input('nama_lengkap') . ' Sudah Ada');
            return redirect()->back();
        }


    }
    public function tambahperiodebaru(Request $request)
    {
        DB::table('tbl_periode')->insert(
            [
                'bulan' => $request->input('bulan'),
                'tahun' => $request->input('tahun'),
                'awal_tgl' => $request->input('start'),
                'akhir_tgl' => $request->input('end'),
                'status_periode' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
        Session::flash('sukses', 'Berhasil Membuat User ' . $request->input('nama_lengkap'));
        return redirect()->back();

    }

    public function schedule()
    {
        if (auth::user()->kd_akses == 2) {
            $data = DB::table('tbl_schedule')
                ->join('tbl_kinerja', 'tbl_kinerja.kd_kinerja', '=', 'tbl_schedule.kd_kinerja')
                ->get();
            return view('admin.schedule', ['data' => $data]);
        }

    }
    public function datacalender($id)
    {
        $date = substr($id, 4, 11);
        $datex = strtotime($date);
        $tgl = date('m/d/Y', $datex);
        if (auth::user()->kd_akses == 2) {
            $data = DB::table('tbl_kinerja')->get();
            return view('admin.modal.calender', ['data' => $data, 'id' => $tgl]);
        }

    }
    public function ajaxRequestPost(Request $request)
    {
        $date = substr($request->date, 4, 11);
        $datejamend = substr($request->end, 10, 20);

        $datex = strtotime($date);
        $dateend = strtotime(substr($request->end, 0, 10));

        DB::table('tbl_schedule')->insert(
            [
                'kd_schedule' => Str::random(50),
                'kd_kinerja' => $request->judul,
                'tgl_start' => date('Y-m-d', $datex),
                'tgl_akhir' => date('Y-m-d', $dateend) . ' ' . $datejamend,
                'ket_schedule' => $request->ket,
                'status_schedule' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );

        return response()->json(['success' => 'Data Tugas telah di jadwalkan']);

    }

    public function tambahusergroup($id)
    {
        $group = DB::table('tbl_group')->where('kd_group', $id)->first();
        $user = DB::table('users')
            ->where('kd_akses', '>', '2')->get();
        return view('admin.modal.group.usergroup', ['group' => $group, 'user' => $user]);
    }
    public function tambahusergroupbaru(Request $request)
    {
        DB::table('group_user')->insert(
            [
                'kd_group' => $request->input('kd_group'),
                'id_user' => $request->input('id_user'),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
        Session::flash('sukses', 'Berhasil Membuat User ' . $request->input('nama_lengkap'));
        return redirect()->back();
    }
    public function tambahcabanggroup($id)
    {
        $group = DB::table('tbl_group')->where('kd_group', $id)->first();
        $cabang = DB::table('tbl_cabang')->get();
        return view('admin.modal.group.cabanggroup', ['group' => $group, 'cabang' => $cabang]);
    }
    public function tambahcabanggroupbaru(Request $request)
    {
        DB::table('handler_cabang')->insert(
            [
                'kd_group' => $request->input('kd_group'),
                'kd_cabang' => $request->input('kd_cabang'),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
        Session::flash('sukses', 'Berhasil Membuat User ' . $request->input('nama_lengkap'));
        return redirect()->back();
    }
    public function tambahgroupbaru()
    {
        return view('admin.modal.formgroupbaru');
    }
    public function posttambahgroupbaru(Request $request)
    {
        DB::table('tbl_group')->insert(
            [
                'kd_group' => 'GR-' . Str::random(4),
                'nama_group' => $request->nama_group,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        );
        Session::flash('sukses', 'Berhasil Input Group Baru :' . $request->nama_group);
        return redirect()->back();
    }
    public function datataskpengerjaanuser($id)
    {
        if (auth::user()->kd_akses == 2) {
            $data = DB::table('tbl_schedule')
                ->join('tbl_kinerja', 'tbl_kinerja.kd_kinerja', '=', 'tbl_schedule.kd_kinerja')
                ->where('kd_schedule', $id)->first();
            $user = DB::table('users')->where('kd_akses', '>', '2')->get();
            return view('admin.modal.worklist.usertask', ['user' => $user, 'data' => $data]);
        }

    }
    public function showdataschedule($id)
    {
        $datauser = DB::table('users')->join('tbl_biodata', 'tbl_biodata.id_user', '=', 'users.id_user')->get();
        $data = DB::table('tbl_schedule')
            ->join('tbl_kinerja', 'tbl_kinerja.kd_kinerja', '=', 'tbl_schedule.kd_kinerja')
            ->where('kd_schedule', $id)->first();
        return view('admin.dataschedule', [
            'datauser' => $datauser,
            'data' => $data,
            'id' => $id,
        ]);
    }
    public function datataskshowdatauser($id, $kd)
    {

        $data = DB::table('tbl_schedule')
            ->join('tbl_kinerja', 'tbl_kinerja.kd_kinerja', '=', 'tbl_schedule.kd_kinerja')
            ->where('tbl_schedule.kd_schedule', $kd)->first();
        $datataskuser = DB::table('tbl_schadule_log')
            ->where('id_user', $id)
            ->where('kd_schedule', $kd)->first();
        return view('admin.schedule.datauser', [
            'data' => $data,
            'datataskuser' => $datataskuser,
        ]);
    }
    public function datacabang()
    {
        $datacabang = DB::table('tbl_cabang')->get();
        return view('admin.modal.datacabang', ['datacabang' => $datacabang]);
    }
    public function tambahdatacabang()
    {
        return view('admin.modal.cabang.tambah');
    }
    public function tambahdataverifikatorcabang($id)
    {
        $cabang = DB::table('tbl_cabang')->where('kd_cabang', $id)->first();
        return view('admin.modal.cabang.tambahverifikator', ['id' => $id, 'cabang' => $cabang]);
    }
    public function tambahdatahendlecabang($id)
    {
        $cabang = DB::table('tbl_cabang')->where('kd_cabang', $id)->first();
        $user = DB::table('users')
        ->join('tbl_biodata','tbl_biodata.id_user','=','users.id_user')
        ->get();
        return view('admin.modal.cabang.tambahhendlecabang', ['id' => $id, 'cabang' => $cabang, 'user'=> $user]);
    }
    public function tambahuserverifikator(Request $request)
    {
        $cekuser = DB::table('users')->where('email', $request->input('username'))->count();
        if ($cekuser == 0) {
            DB::table('users')->insert(
                [
                    'id_user' => "verif-" . Str::random(5),
                    'name' => $request->input('nama_lengkap'),
                    'email' => $request->input('username'),
                    'password' => Hash::make($request->input('password')),
                    'kd_akses' => $request->input('akses'),
                    'status_user' => 1,
                    'cabang' => $request->input('kd_cabang'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
            Session::flash('sukses', 'Berhasil Membuat User ' . $request->input('nama_lengkap'));
            return redirect()->back();
        } else {
            Session::flash('gagal', 'User ' . $request->input('nama_lengkap') . ' Sudah Ada');
            return redirect()->back();
        }
    }
    public function tambahhendlecabang(Request $request)
    {
        $cekuser = DB::table('users')->where('id_user', $request->input('user'))->count();
        if ($cekuser == 1) {
            DB::table('users_handler')->insert(
                [
                    'id_user' => $request->input('user'),
                    'kd_cabang' => $request->input('kd_cabang'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
            Session::flash('sukses', 'Berhasil Update');
            return redirect()->back();
        } else {
            Session::flash('gagal', 'Gagal Update');
            return redirect()->back();
        }
    }









    public function data_peserta()
    {
        $data = DB::table('pre_test')->join('event_peserta', 'event_peserta.email', '=', 'pre_test.email')->get();
        $peserta = DB::table('event_peserta')->get();
        $post_test = DB::table('post_test')
            ->orderBy('id_post_test', 'ASC')
            ->get();
        $pre_test = DB::table('pre_test')
            ->orderBy('id_pre_test', 'ASC')
            ->get();
        return view('data_peserta', [
            'peserta' => $peserta,
            'post_test' => $post_test,
            'pre_test' => $pre_test,
        ]);
    }
    // PIKET USER

    public function piket()
    {
        return view('admin.piket.index');
    }
    public function tablepiket(Request $request,$id)
    {

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Piket::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Piket::select('count(*) as allcount')->where('tgl_piket', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Piket::orderBy($columnName, $columnSortOrder)
            ->where('tbl_piket_user.tgl_piket', 'like', '%' . $searchValue . '%')
            ->select('tbl_piket_user.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $no = 1;
        foreach ($records as $record) {
            $id = $no++;
            $id_piket = $record->id_piket;
            $id_user = $record->id_user;
            $kd_cabang = $record->kd_cabang;
            $tgl_piket = $record->tgl_piket;
            $status_piket = $record->status_piket;

            $data_arr[] = array(
                "id" => $id,
                "id_piket" => $id_piket,
                "id_user" => $id_user,
                "kd_cabang" => $kd_cabang,
                "tgl_piket" => $tgl_piket,
                "status_piket" => $status_piket,
                "btn" => "
                <button class='btn-warning' data-id='" . $id . "' id='button-edit-paket-pelanggan'><i class='fa fa-pencil'></i></button>
                <button class='btn-danger' data-id='" . $id . "' id='button-edit-paket-pelanggan'><i class='fa fa-trash'></i></button>
                "
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }
}
