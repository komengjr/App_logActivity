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
        return $pdf->stream();
    }
}
