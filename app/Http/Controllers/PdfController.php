<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleSoftwareIO\QrCode\Generator;
class PdfController extends Controller
{
    public function printkpi(Request $request)
    {
        $datakinerja = DB::table('tbl_kinerja')
        ->where('status_kinerja','1')
        ->get();
        $datadiri = DB::table('tbl_biodata')->where('id_user',auth::user()->id_user)->first();
        $periode = DB::table('tbl_periode')->where('id_periode',$request->input('periode'))->first();
        $pdf = PDF::loadview('pdf.kpi',['datakinerja'=>$datakinerja,'datadiri'=>$datadiri,'periode'=>$periode])->setPaper('A4','potrait');

        $pdf->output();
        $canvas = $pdf->getDomPDF()->getCanvas();

        $height = $canvas->get_height();
        $width = $canvas->get_width();

        $canvas->set_opacity(.2,"Multiply");

        $canvas->set_opacity(.1);


        $canvas->page_text($width/5, $height/2, 'Dokumen Resmi', null, 40, array(22,0,0),1,2,0);
        // $canvas->page_text($width/8, $height/3, 'www.pramita.co.id', null, 55, array(22,0,0),1,2,0);


        return $pdf->stream();
    }
    public function detaildatatask($id)
    {
        $tbl_periode = DB::table('tbl_periode')->get();
        $pdf = PDF::loadview('userleader.modal.detailtask',['id'=>$id ])->setPaper('A4','potrait');
        return $pdf->stream();
    }
    public function printdataverif(Request $request)
    {
        $tbl_tiket_task = DB::table('tbl_tiket_task')
        ->join('tbl_kinerja','tbl_kinerja.kd_kinerja','=','tbl_tiket_task.kd_kinerja')
        ->join('users','users.id_user','=','tbl_tiket_task.user_v')
        ->join('tbl_biodata','tbl_biodata.kd_cabang','=','tbl_tiket_task.kd_cabang')
        ->where('tbl_tiket_task.kd_tiket_task',$request->id)
        ->first();
        $pdf = PDF::loadview('verifikator.printpdf',['data'=>$tbl_tiket_task])->setPaper('A4','potrait');
        return $pdf->stream();
    }
}
