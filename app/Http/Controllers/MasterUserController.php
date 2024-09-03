<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use PDF;

class MasterUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function masterdatahardware()
    {
        $user = DB::table('tbl_biodata')->where('id_user', Auth::user()->id_user)->first();
        if (Auth::user()->kd_akses == 2) {
            $data = DB::table('tbl_laporan_user')->orderBy('id_laporan', 'DESC')->get();
        } elseif (Auth::user()->kd_akses > 2) {
            $data = DB::table('tbl_laporan_user')
                ->where('kd_cabang', $user->kd_cabang)->orderBy('id_laporan', 'DESC')->get();
        }
        $datacabang = DB::table('tbl_cabang')->get();
        return view('userleader.masterdata.view', ['data' => $data, 'datacabang' => $datacabang]);
    }
    public function masterdatalaporandetail(Request $request)
    {
        $data = DB::table('tbl_laporan_user')
            ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'tbl_laporan_user.kd_cabang')
            ->where('tbl_laporan_user.tiket_laporan', $request->tiket)->first();
        return view('userleader.masterdata.detail-laporan', ['tiket' => $request->tiket, 'data' => $data]);
    }
    public function masterdatalaporanharian(Request $request)
    {
        $datacabang = DB::table('tbl_cabang')->get();
        return view('userleader.masterdata.monitoring-harian', ['cabang' => $datacabang]);
    }
    public function masterdatalaporankerusakan(Request $request)
    {
        return view('userleader.masterdata.monitoring-kerusakan');
    }
    public function masterpreviewdatalaporankerusakan(Request $request)
    {
        $datahandle = DB::table('users_handler')
        ->join('tbl_cabang','tbl_cabang.kd_cabang','=','users_handler.kd_cabang')
        ->where('id_user',Auth::user()->id_user)->get();
        $start = $request->start;
        $end = $request->end;
        $pdf = PDF::loadview('userleader.masterdata.report.report-monitoring-kerusakan',['datahandle'=>$datahandle,'start'=>$start,'end'=>$end])->setPaper('A4', 'potrait')->setOptions(['defaultFont' => 'Courier']);
        $pdf->output();
        $canvas = $pdf->getDomPDF()->getCanvas();

        $height = $canvas->get_height();
        $width = $canvas->get_width();

        $canvas->set_opacity(.2, "Multiply");

        $canvas->set_opacity(.1);

        // $canvas->page_text($width/5, $height/2, 'Lunas', '123', 30, array(22,0,0),1,2,0);
        // $canvas->page_script('
        // $pdf->set_opacity(.1);
        // $pdf->image("bg-report.png",10, 10, 1255, 855);
        // ');
        return base64_encode($pdf->stream());
    }
    public function masterpreviewmonitoringharian(Request $request)
    {
        if (Auth::user()->kd_akses == 2) {
            $startdate = $request->start;
            $startdate = strtotime($startdate);
            $enddate = $request->end;
            $enddate = strtotime($enddate);
            $harimasuk = array();
            for ($i = $startdate; $i <= $enddate; $i += (60 * 60 * 24)) {
                if (date('w', $i) !== '0') {
                    $harimasuk[] = $i;
                } else {
                }
            }

            if ($request->cabang == '*') {
                $datacabang = DB::table('tbl_cabang')->get();
            } else {
                $datacabang = DB::table('tbl_cabang')->where('kd_cabang', $request->cabang)->get();
            }

            // $hendlecabang = DB::table('users_handler')
            //     ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
            //     ->where('users_handler.id_user', Auth::user()->id_user)->get();
            $datakinerja = DB::table('tbl_kinerja_sub')->where('jenis_kinerja_sub', 1)->get();
            $image = base64_encode(file_get_contents(public_path('icon2.jpg')));
            $pdf = PDF::loadview('userleader.masterdata.report.report-monitoring-harian-admin', ['harimasuk' => $harimasuk, 'datacabang' => $datacabang, 'datakinerja' => $datakinerja], compact('image'))->setPaper('A3', 'landscape')->setOptions(['defaultFont' => 'Courier']);
            return base64_encode($pdf->stream());
        } elseif (Auth::user()->kd_akses > 2) {

            $startdate = $request->start;
            $startdate = strtotime($startdate);
            $enddate = $request->end;
            $enddate = strtotime($enddate);
            $harimasuk = array();
            for ($i = $startdate; $i <= $enddate; $i += (60 * 60 * 24)) {
                if (date('w', $i) !== '0') {
                    $harimasuk[] = $i;
                } else {
                }
            }
            $hendlecabang = DB::table('users_handler')
                ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
                ->where('users_handler.id_user', Auth::user()->id_user)->get();
            $dataharian = DB::table('tbl_kinerja_sub')->where('jenis_kinerja_sub', 1)->get();
            $image = base64_encode(file_get_contents(public_path('icon2.jpg')));
            $pdf = PDF::loadview('userleader.masterdata.report.report-monitoring-harian', ['dataharian' => $dataharian, 'harimasuk' => $harimasuk, 'hendlecabang' => $hendlecabang], compact('image'))->setPaper('A3', 'landscape')->setOptions(['defaultFont' => 'Courier']);
            $pdf->output();
            $canvas = $pdf->getDomPDF()->getCanvas();

            $height = $canvas->get_height();
            $width = $canvas->get_width();

            $canvas->set_opacity(.2, "Multiply");

            $canvas->set_opacity(.1);

            // $canvas->page_text($width/5, $height/2, 'Lunas', '123', 30, array(22,0,0),1,2,0);
            // $canvas->page_script('
            // $pdf->set_opacity(.1);
            // $pdf->image("bg-report.png",10, 10, 1255, 855);
            // ');
            return base64_encode($pdf->stream());

        }
    }
    public function masterpreviewbackupharianmonitoringharian(Request $request)
    {

            $datahandle = DB::table('users_handler')
            ->join('tbl_cabang','tbl_cabang.kd_cabang','=','users_handler.kd_cabang')
            ->where('id_user',Auth::user()->id_user)->get();
            $start = $request->start;
            $end = $request->end;
            $pdf = PDF::loadview('userleader.masterdata.report.report-monitoring-backup-harian',['datahandle'=>$datahandle,'start'=>$start,'end'=>$end])->setPaper('A4', 'potrait')->setOptions(['defaultFont' => 'Courier']);
            $pdf->output();
            $canvas = $pdf->getDomPDF()->getCanvas();

            $height = $canvas->get_height();
            $width = $canvas->get_width();

            $canvas->set_opacity(.2, "Multiply");

            $canvas->set_opacity(.1);

            // $canvas->page_text($width/5, $height/2, 'Lunas', '123', 30, array(22,0,0),1,2,0);
            // $canvas->page_script('
            // $pdf->set_opacity(.1);
            // $pdf->image("bg-report.png",10, 10, 1255, 855);
            // ');
            return base64_encode($pdf->stream());


    }
    public function masterdatalaporanbackupbulanan(Request $request)
    {
        $datacabang = DB::table('tbl_cabang')->get();
        return view('userleader.masterdata.monitoring-backup-bulanan', ['cabang' => $datacabang]);
    }
    public function masterpreviewbackupharianmonitoringbulanan(Request $request)
    {

            $datahandle = DB::table('users_handler')
            ->join('tbl_cabang','tbl_cabang.kd_cabang','=','users_handler.kd_cabang')
            ->where('id_user',Auth::user()->id_user)->get();
            $start = $request->start;
            $end = $request->end;
            $pdf = PDF::loadview('userleader.masterdata.report.report-monitoring-backup-bulanan',['datahandle'=>$datahandle,'start'=>$start,'end'=>$end])->setPaper('A4', 'potrait')->setOptions(['defaultFont' => 'Courier']);
            $pdf->output();
            $canvas = $pdf->getDomPDF()->getCanvas();

            $height = $canvas->get_height();
            $width = $canvas->get_width();

            $canvas->set_opacity(.2, "Multiply");

            $canvas->set_opacity(.1);

            // $canvas->page_text($width/5, $height/2, 'Lunas', '123', 30, array(22,0,0),1,2,0);
            // $canvas->page_script('
            // $pdf->set_opacity(.1);
            // $pdf->image("bg-report.png",10, 10, 1255, 855);
            // ');
            return base64_encode($pdf->stream());


    }
    public function masterdatalaporanrencanamaintenance(Request $request)
    {
        $data = DB::table('users_schedule_maintenance')
        ->join('tbl_cabang','tbl_cabang.kd_cabang','=','users_schedule_maintenance.kd_cabang')->get();
        return view('userleader.masterdata.laporan-rencana-maintenance',['data'=>$data]);
    }
}
