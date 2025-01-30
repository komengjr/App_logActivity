<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PDF;
class VerifikatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function datatask($id)
    {
        $data = DB::table('tbl_tiket_task')
        ->join('tbl_kinerja','tbl_kinerja.kd_kinerja','=','tbl_tiket_task.kd_kinerja')
        ->where('kd_tiket_task',$id)
        ->first();
        return view('verifikator.modal.datatask',['data'=>$data]);
    }
    public function verifdatauser(Request $request)
    {
        DB::table('tbl_tiket_task')
        ->where('kd_tiket_task',$request->input('kd_task'))
        ->update([
                    'status_task' => 2,
                    'user_v' => auth::user()->id_user,
                ]);
        Session::flash('sukses','Berhasil Verifikasi Data Order User');
        return redirect()->back();
    }
    public function unverifdatauser(Request $request)
    {
        Session::flash('gagal','Berhasil Unverifikasi Data Order User');
        return redirect()->back();
    }
    public function posttambahorder(Request $request)
    {
        DB::table('tbl_tiket_task')->insert(
            [
                'kd_tiket_task' => "task-".Str::random(50),
                'id_leader' => auth::user()->id_user,
                'kd_cabang' => auth::user()->cabang,
                'kd_kinerja' => $request->input('kd_kinerja'),
                'tgl_start' => $request->input('start'),
                'tgl_end' => $request->input('end'),
                'deskripsi_task' => $request->input('keterangan'),
                'status_task' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        Session::flash('sukses','Berhasil Menambah Data Order User');
        return redirect()->back();
    }
    public function tambahordertask()
    {
        $kinerja = DB::table('tbl_kinerja')->get();
        return view('verifikator.modal.tambahorder',['kinerja'=>$kinerja]);
    }
    public function datagraphic()
    {
        $kinerja = DB::table('tbl_kinerja')->get();
        return view('verifikator.modal.modalviewgrapic',['kinerja'=>$kinerja]);
    }
    public function datapostgraphic(Request $request)
    {
        // $image = base64_encode(file_get_contents(public_path('logo.png')));
        // $pdf = PDF::loadview('verifikator.report.datalaporankerusakan')->setPaper('A4','landscape')->setOptions(['defaultFont' => 'Calibri']);
        // return $pdf->stream();
        // $datahandle = DB::table('users_handler')
        // ->join('tbl_cabang','tbl_cabang.kd_cabang','=','users_handler.kd_cabang')
        // ->where('id_user',Auth::user()->id_user)->get();
        $start = $request->start;
        $end = $request->end;
        $cabang = DB::table('tbl_cabang')->where('kd_cabang',Auth::user()->cabang)->first();
        $datalaporan = DB::table('tbl_laporan_user')->where('kd_cabang',Auth::user()->cabang)->whereBetween('tgl_laporan', [$start, $end])->get();

        $pdf = PDF::loadview('verifikator.report.datalaporankerusakan',['datalaporan'=>$datalaporan,'start'=>$start, 'end'=>$end,'cabang'=>$cabang])->setPaper('A4', 'potrait')->setOptions(['defaultFont' => 'Courier']);
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
    public function postdataviewtaskgraphic(Request $request)
    {
        $startdate = $request->start;
        $startdate = strtotime($startdate);

        $enddate = $request->end;
        $enddate = strtotime($enddate);
        $harimasuk = array();


        for ($i=$startdate; $i <= $enddate; $i += (60 * 60 * 24)) {
            if (date('w', $i) !== '0') {
                $harimasuk[] = $i;
            } else {
                // $harilibur[] = $i;
            }

        }
        return view('verifikator.report.dataview',['harimasuk'=>$harimasuk]);
    }
}
