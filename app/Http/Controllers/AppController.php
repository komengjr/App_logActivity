<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class AppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard_home()
    {
        $bio = DB::table('tbl_biodata')->join('users', 'users.id_user', '=', 'tbl_biodata.id_user')
            ->where('users.id_user', Auth::user()->id_user)->first();
        $handle = DB::table('users_handler')->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
            ->where('id_user', Auth::user()->id_user)->get();
        if ($bio) {
            # code...
            return view('application.dashboard', compact('bio', 'handle'));
        } else {
            return view('application.dashboard_admin', compact('handle'));
        }
    }
    public function dashboard_get_message(Request $request)
    {
        $datapesan = DB::table('tbl_laporan_user')
            ->join('users_handler', 'users_handler.kd_cabang', '=', 'tbl_laporan_user.kd_cabang')
            ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'tbl_laporan_user.kd_cabang')
            ->where('users_handler.id_user', Auth::user()->id_user)
            ->where('tbl_laporan_user.status_laporan', '<', 2)->get();
        $dataschadule = DB::table('tbl_schedule')
            ->join('users_handler', 'users_handler.kd_cabang', '=', 'tbl_schedule.kd_cabang')->where('users_handler.id_user', Auth::user()->id_user)->where('tbl_schedule.status_schedule', 0)->get();
        // dd($dataschadule);
        $piket = DB::table('piket_nasional_user')
            ->join('piket_nasional', 'piket_nasional.tiket_piket_nasional', '=', 'piket_nasional_user.tiket_piket_nasional')
            ->Where('piket_nasional.tgl_piket_nasional', 'like', '%' . date('Y-m-d') . '%')
            ->where('piket_nasional_user.user_piket', Auth::user()->id_user)->first();
        $datanasional = DB::table('tbl_laporan_user')
            ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'tbl_laporan_user.kd_cabang')
            ->where('tbl_laporan_user.status_laporan', '<', 1)->get();
        return view('application.message.list-message', ['datapesan' => $datapesan, 'dataschedule' => $dataschadule, 'piket' => $piket, 'datanasional' => $datanasional]);
    }
    public function dashboard_get_message_proses(Request $request)
    {
        $data = DB::table('tbl_laporan_user')->where('tiket_laporan', $request->code)->first();

        return view('application.message.data-message', compact('data'));
    }
    public function dashboard_get_message_proses_terima(Request $request)
    {
        try {
            DB::table('tbl_laporan_user')->where('tiket_laporan', $request->code)->update([
                'tgl_respon_laporan' => now(),
                'id_user' => Auth::user()->id_user,
                'updated_at' => now()
            ]);
            return 1;
        } catch (\Throwable $e) {
            return 0;
        }
    }
    public function dashboard_get_message_proses_tindakan(Request $request)
    {
        try {
            DB::table('tbl_laporan_user_proses')->insert([
                'tbl_laporan_user_proses_code' => str::uuid(),
                'tiket_laporan' => $request->code,
                'tbl_laporan_user_proses_type' => $request->petugas,
                'estimasi_laporan_date' => $request->estimasi_tgl,
                'estimasi_laporan_time' => $request->estimasi_time,
                'id_user' => Auth::user()->id_user,
                'created_at' => now()
            ]);
            DB::table('tbl_laporan_user')->where('tiket_laporan', $request->code)->update([
                'tgl_proses_laporan' => now(),
                'status_laporan' => 1,
                'updated_at' => now()
            ]);
            return 1;
        } catch (\Throwable $e) {
            return 0;
        }
    }
    public function dashboard_get_message_proses_finish(Request $request)
    {
        try {
            DB::table('tbl_laporan_user_log')->insert([
                'tiket_laporan' => $request->code,
                'deskripsi_penyelesaian' => $request->solusi,
                'id_user' => Auth::user()->id_user,
                'created_at' => now()
            ]);
            DB::table('tbl_laporan_user')->where('tiket_laporan', $request->code)->update([
                'tgl_selesai_laporan' => now(),
                'status_laporan' => 2,
                'updated_at' => now()
            ]);
            return 1;
        } catch (\Throwable $e) {
            return 0;
        }
    }

    public function dashboard_check_in_proses(Request $request)
    {
        $kritis = DB::table('tbl_kinerja_sub')->get();
        return view('application.check-in.form-check-in-proses', compact('kritis'), ['code' => $request->code]);
    }
    public function dashboard_check_in_proses_data_kritis(Request $request)
    {
        $cek = DB::table('users_handler_record_log')
            ->where('kd_kinerja_sub', $request->kinerja)
            ->where('kd_cabang', $request->code)
            ->where('id_user', Auth::user()->id_user)
            ->where('tgl_record', date('Y-m-d'))->first();
        if ($cek) {
            DB::table('users_handler_record_log')
                ->where('kd_kinerja_sub', $request->kinerja)
                ->where('kd_cabang', $request->code)
                ->where('id_user', Auth::user()->id_user)
                ->update([
                    'ket_kinerja_sub' => $request->status,
                ]);
        } else {
            DB::table('users_handler_record_log')->insert([
                'kd_kinerja_sub' => $request->kinerja,
                'id_user' => Auth::user()->id_user,
                'kd_cabang' => $request->code,
                'tgl_record' => date('Y-m-d'),
                'ket_kinerja_sub' => $request->status,
                'status_kinerja_sub' => 1,
                'created_at' => now(),
            ]);
        }
        return 1;
    }
    public function dashboard_check_in_proses_data_harian_import(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = date('Y-m-d') . '.' . $extension;

            $disk = Storage::disk(config('filesystems.publis'));
            $path = $disk->putFileAs('monitoring_harian/' . auth::user()->id_user, $file, $fileName);
            // $path1 = $disk('videos', $file, $fileName);

            // delete chunked file
            unlink($file->getPathname());

            return [
                'path' => '../../storage/monitoring_harian/' . auth::user()->id_user . '/' . $fileName,
                'filename' => $fileName
            ];
        }

        // otherwise return percentage informatoin
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
    public function dashboard_check_in_proses_data_harian_save(Request $request)
    {
        try {
            $cek = DB::table('users_backup_harian')->where('tgl_backup_harian', date('Y-m-d'))->where('kd_cabang', $request->code)->first();
            if ($cek) {
                return 0;
            } else {
                DB::table('users_backup_harian')->insert([
                    'kd_users_backup_harian' => str::uuid(),
                    'sistem_backup_harian' => $request->sistem,
                    'proses_backup_harian' => $request->proses,
                    'deskripsi_backup_harian' => $request->desc,
                    'file_backup_harian' => 'monitoring_harian/' . auth::user()->id_user . '/' . $request->file,
                    'status_backup_harian' => 1,
                    'tgl_backup_harian' => date('Y-m-d'),
                    'kd_cabang' => $request->code,
                    'created_at' => now()
                ]);
                return 1;
            }
        } catch (\Throwable $e) {
            return 0;
        }
    }

    // REPORT LAPORAN
    public function dashboard_monitoring_harian_kritis(Request $request)
    {
        return view('application.monitoring-harian.form-report-harian');
    }
    public function dashboard_monitoring_harian_backup_kritis(Request $request)
    {
        $date1 = substr($request->date, 0, 10);
        $date2 = substr($request->date, 14, 10);
        $startdate = $request->start;
        $startdate = strtotime($date1);
        $enddate = $request->end;
        $enddate = strtotime($date2);
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
        $image = base64_encode(file_get_contents(public_path('icon1.png')));
        $pdf = PDF::loadview('application.monitoring-harian.report.report-laporan-kritis', ['dataharian' => $dataharian, 'harimasuk' => $harimasuk, 'hendlecabang' => $hendlecabang], compact('image'))->setPaper('A3', 'landscape')->setOptions(['defaultFont' => 'Courier']);
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
    public function dashboard_monitoring_harian_backup_report(Request $request)
    {
        $date1 = substr($request->date, 0, 10);
        $date2 = substr($request->date, 14, 10);
        $datahandle = DB::table('users_handler')
            ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
            ->where('id_user', Auth::user()->id_user)->get();
        $image = base64_encode(file_get_contents(public_path('icon1.png')));
        $start = $date1;
        $end = $date2;
        $pdf = PDF::loadview('application.monitoring-harian.report.report-laporan-backup-harian', compact('image'), ['datahandle' => $datahandle, 'start' => $start, 'end' => $end])->setPaper('A4', 'potrait')->setOptions(['defaultFont' => 'Courier']);
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
