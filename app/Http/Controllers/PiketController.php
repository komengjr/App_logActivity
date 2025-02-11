<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class PiketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (auth::user()->kd_akses == 2) {
            $data = DB::table('tbl_schedule')
                ->join('tbl_kinerja', 'tbl_kinerja.kd_kinerja', '=', 'tbl_schedule.kd_kinerja')
                ->get();
            $datax = DB::table('piket_nasional')->orderBy('tgl_piket_nasional', 'DESC')->get();
            return view('admin.piket', ['data' => $data, 'datax' => $datax]);
        }
    }
    public function detailpiket($id)
    {
        if (auth::user()->kd_akses == 2) {
            $datauser = DB::table('piket_nasional_user')->where('tiket_piket_nasional', $id)->get();
            return view('admin.piket.detail-user-piket', ['id' => $id]);
        }
    }
    public function formpiket($id)
    {
        if (auth::user()->kd_akses == 2) {
            $date = substr($id, 4, 11);
            $datex = strtotime($date);
            $tgl = date('m/d/Y', $datex);
            if (auth::user()->kd_akses == 2) {
                $data = DB::table('tbl_kinerja')
                    ->join('tbl_kinerja_detail', 'tbl_kinerja_detail.kd_kinerja', '=', 'tbl_kinerja.kd_kinerja')
                    ->get();
                $cabang = DB::table('tbl_cabang')->get();
                $group = DB::table('tbl_group')->get();
                $user = DB::table('tbl_biodata')->get();
                return view('admin.piket.form-piket', ['data' => $data, 'id' => $tgl, 'cabang' => $cabang, 'user' => $user, 'group' => $group]);
            }
        }
    }
    public function optioanwilayah($id)
    {
        $user = DB::table('group_user')->join('tbl_biodata', 'tbl_biodata.id_user', '=', 'group_user.id_user')
            ->where('group_user.kd_group', $id)->get();
        return view('admin.piket.option-wilayah', ['user' => $user]);
    }
    public function simpanjadwalpiket(Request $request)
    {
        if (auth::user()->kd_akses == 2) {
            $start = date_create($request->mulai);
            $end = date_create($request->date);
            $selisih = date_diff($start, $end);
            $jumlah = DB::table('tbl_biodata')->count();
            $datauser = DB::table('tbl_biodata')->orderByRaw("RAND()")->get();
            // dd($jumlah/($selisih->d+1));
            $x = $jumlah / ($selisih->d + 1);
            // $x = round($x);
            // dd($datauser);

            for ($i = 0; $i <= $selisih->d; $i++) {
                $returnDate = date('Y-m-d', strtotime('+' . $i . ' day', strtotime($request->mulai)));
                $tiket = date('Ymd', strtotime($returnDate)) . Str::random(6);
                DB::table('piket_nasional')->insert([
                    'tiket_piket_nasional' => $tiket,
                    'tgl_piket_nasional' => $returnDate,
                    'status_piket_nasional' => 1,
                ]);
                // $user = DB::table('tbl_biodata')->join('users', 'users.id_user', '=', 'tbl_biodata.id_user')
                //     ->skip($i*$o)
                //     ->take($x)
                //     ->get();
                for ($j = 0; $j < $x; $j++) {
                    DB::table('piket_nasional_user')->insert([
                        'tiket_piket_user' => str::uuid(),
                        'tiket_piket_nasional' => $tiket,
                        'user_piket' => $datauser[$i+$j]->id_user,
                        'created_at' => now(),
                    ]);
                }
                // DB::table('piket_nasional_user')->insert([
                //     'tiket_piket_nasional'=>$returnDate,
                //     'user_piket'=>213123,
                // ]);
            }
            // $start = $request->mulai;
            Session::flash('sukses', 'Berhasil Update');
            return redirect()->back();
        }
    }
}
