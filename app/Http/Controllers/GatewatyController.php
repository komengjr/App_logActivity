<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
use Telegram\Bot\Laravel\Facades\Telegram;
use PDF;
class GatewatyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function telegram()
    {
        if (Auth::user()->kd_akses == 2) {
            $data = DB::table('tbl_laporan_user')
                ->select('tbl_laporan_user.*', 'tbl_cabang.nama_cabang')
                ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'tbl_laporan_user.kd_cabang')
                ->where('tbl_laporan_user.status_telegram', '=!', 1)->get();
            // dd($data);
            return view('admin.gateway.telegram', ['data' => $data]);
        }
    }
    public function no_telegram()
    {
        if (Auth::user()->kd_akses == 2) {
            $data = DB::table('telegram_chat_no')->get();
            return view('admin.gateway.no-telegram', ['data' => $data]);
        }
    }
    public function log_telegram()
    {
        if (Auth::user()->kd_akses == 2) {
            $data = DB::table('telegram_log')->orderBy('id_telegram', 'DESC')->get();
            return view('admin.gateway.log-telegram', ['data' => $data]);
        }
    }
    public function all_laporan_telegram()
    {
        if (Auth::user()->kd_akses == 2) {
            $data = DB::table('tbl_laporan_user')
                ->select('tbl_laporan_user.*', 'tbl_cabang.nama_cabang')
                ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'tbl_laporan_user.kd_cabang')->get();
            // dd($data);
            return view('admin.gateway.all-laporan-user', ['data' => $data]);
        }
    }
    public function edit_log_telegram($id)
    {
        if (Auth::user()->kd_akses == 2) {
            $data = DB::table('tbl_laporan_user')->where('id_laporan', $id)->first();
            return view('admin.gateway.edit-log-telegram', ['data' => $data]);
        }
    }
    public function post_edit_log_telegram(Request $requsest)
    {
        if (Auth::user()->kd_akses == 2) {
            DB::table('tbl_laporan_user')->where('id_laporan', $requsest->id_laporan)->update([
                'no_hp' => $requsest->no_hp,
                'email' => $requsest->email
            ]);
            Session::flash('sukses', 'Berhasil Update Data');
            return redirect()->back();
        }
    }
    public function detail_log_telegram($id)
    {
        if (Auth::user()->kd_akses == 2) {
            $data = DB::table('tbl_laporan_user')->where('id_laporan', $id)->first();
            return view('admin.gateway.detail-log-telegram', ['data' => $data]);
        }
    }
    public function kirim_log_telegram(Request $request)
    {
        if (Auth::user()->kd_akses == 2) {
            $ceklaporan = DB::table('tbl_laporan_user')->where('id_laporan', $request->id)->first();
            if ($ceklaporan) {
                $cekno = DB::table('telegram_chat_no')->where('no_hp', $ceklaporan->no_hp)->first();
                if ($cekno) {
                    Telegram::sendMessage([
                        'chat_id' => $cekno->chat_id,
                        'text' => "Halo \nHanya Mengingatkan Untuk Tiket Laporan Anda Adalah :\n" . $ceklaporan->tiket_laporan,
                    ]);
                    DB::table('tbl_laporan_user')->where('id_laporan', $request->id)->update([
                        'status_telegram' => 1
                    ]);
                    return 1;
                } else {
                    return 0;
                }

            }

        }
    }


    // LOG BisOne
    public function monitoring_log()
    {
        $pdo = DB::connection('second_db')->table('log')->orderBy('logID', 'DESC')->take(500)->get();
        return view('admin.monitoring.log_bisone', ['data' => $pdo]);

    }
    public function cetak_monitoring_log(Request $request)
    {
        $cabang = DB::table('tbl_cabang')->get();
        return view('admin.monitoring.cetak_laporan', ['cabang' => $cabang]);

    }
    public function post_cetak_monitoring_log(Request $request)
    {
        $data = DB::connection('second_db')->table('log')->where('logBranchCode',$request->cabang)
        ->whereBetween('logDate', [$request->start." 00:00:00",$request->end." 23:59:59"])
        ->get();
        $pdf = PDF::loadview('admin.monitoring.report.laporan-log-bisone',['data'=>$data])->setPaper('A5', 'potrait')->setOptions(['defaultFont' => 'Courier']);
        return base64_encode($pdf->stream());

    }
}
