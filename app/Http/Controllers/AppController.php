<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PDF;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use App\User;

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
            return view('application.dashboard', compact('bio', 'handle'));
        } else {
            return view('application.dashboard_admin', compact('handle'));
        }
    }
    public function dashboard_home_update_profile(Request $request)
    {
        return view('application.dashboard.update-profile');
    }
    public function dashboard_home_update_profile_save(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi Input Data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'gender' => 'nullable|string|in:L,P',
            'job' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048', // Maksimal 2MB
        ]);

        // 2. Ambil instansiasi data user target
        $userData = User::find($user->id);

        // 3. Logika Proses Upload Gambar (Jika ada gambar baru yang dimasukkan)
        if ($request->hasFile('avatar')) {

            // Hapus file foto profil lama di storage jika sebelumnya ada
            if ($userData->avatar && Storage::disk('public')->exists($userData->avatar)) {
                Storage::disk('public')->delete($userData->avatar);
            }

            // Simpan gambar baru ke folder: storage/app/public/avatars
            $path = $request->file('avatar')->store('avatars', 'public');
            DB::table('tbl_biodata')->where('id_user', Auth::user()->id_user)->update([
                'gambar' => $path
            ]);
            // $userData->avatar = $path;
        }

        // 4. Update kolom teks lainnya
        $userData->name = $request->name;
        $userData->email_verified_at = $request->email;
        $userData->phone_number = $request->phone_number;


        $userData->save();

        // 5. Kembalikan response JSON ke Fetch javascript
        return response()->json([
            'success' => true,
            'message' => 'Profil Anda berhasil diperbarui!',
            'avatar_url' => $userData->avatar ? asset('storage/' . $userData->avatar) : null
        ]);
    }
    public function dashboard_home_reset_password(Request $request)
    {
        return view('application.dashboard.reset-password');
    }
    public function dashboard_home_reset_password_send_otp(Request $request)
    {
        // 1. Ambil data user yang sedang login (Menggunakan Auth session)
        // $user = DB::table('tbl_biodata')->where('id_user', Auth::user()->id_user)->first();
        $phoneNumber = Auth::user()->phone_number;

        // 2. PROTEKSI BARU: Cek apakah sudah ada OTP yang aktif (belum expired & belum terpakai)
        $activeOtp = DB::table('password_otp_tokens')
            ->where('phone_number', $phoneNumber)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->first();

        // Jika OTP aktif ditemukan, hitung sisa waktunya untuk diinfokan ke user
        if ($activeOtp) {
            $sisaDetik = Carbon::now()->diffInSeconds(Carbon::parse($activeOtp->expires_at));

            return response()->json([
                'success' => false,
                'message' => "Kode OTP Anda masih aktif. Silakan gunakan kode tersebut atau tunggu sekitar " . ceil($sisaDetik / 60) . " menit lagi untuk meminta kode baru."
            ], 429); // 429 Too Many Requests
        }

        // 3. Jika tidak ada OTP aktif, barulah Generate 6 Digit Angka Baru
        $otpCode = rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(5); // Berlaku 5 menit

        // 4. Simpan ke Database
        DB::table('password_otp_tokens')->insert([
            'phone_number' => $phoneNumber,
            'otp_code' => $otpCode,
            'expires_at' => $expiresAt,
            'is_used' => false,
            'created_at' => Carbon::now()
        ]);

        // 5. Kirim OTP melalui vendor SMS/WhatsApp Gateway Anda
        $nomorhp = $phoneNumber;
        //Terlebih dahulu kita trim dl
        $nomorhp = trim($nomorhp);
        //bersihkan dari karakter yang tidak perlu
        $nomorhp = strip_tags($nomorhp);
        // Berishkan dari spasi
        $nomorhp = str_replace(" ", "", $nomorhp);
        // Berishkan dari -
        $nomorhp = str_replace("-", "", $nomorhp);
        // bersihkan dari bentuk seperti  (022) 66677788
        $nomorhp = str_replace("(", "", $nomorhp);
        // bersihkan dari format yang ada titik seperti 0811.222.333.4
        $nomorhp = str_replace(".", "", $nomorhp);

        if (!preg_match('/[^+0-9]/', trim($nomorhp))) {
            // cek apakah no hp karakter 1-3 adalah +62
            if (substr(trim($nomorhp), 0, 3) == '+62') {
                $nomorhp = trim($nomorhp);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif (substr($nomorhp, 0, 1) == '0') {
                $nomorhp = '+62' . substr($nomorhp, 1);
            }
        }
        $text = "🔐 *[LOGIT SYSTEM NOTIFICATION]*\n\n" .
            "Halo, *" . Auth::user()->name . "*\n" .
            "Berikut adalah kode verifikasi OTP Anda:\n\n" .
            "```" . $otpCode . "```\n\n" .
            "⏰ _Kode ini berlaku sampai:_ " . Carbon::parse($expiresAt)->format('H:i') . " WIB\n\n" .
            "⚠️ *Demi keamanan:* Jangan membagikan kode ini kepada siapa pun.";
        DB::table('v_log_whatsapp')->insert([
            'v_log_whatsapp_code' => str::uuid(),
            'v_log_whatsapp_type' => 'Reset Password',
            'v_log_whatsapp_token' => $otpCode,
            'v_log_whatsapp_number' => $nomorhp,
            'v_log_whatsapp_name' => Auth::user()->name,
            'v_log_whatsapp_filename' => 'nofile',
            'v_log_whatsapp_text' => $text,
            'v_log_whatsapp_file' => 'N',
            'v_log_whatsapp_picture' => 0,
            'v_log_whatsapp_status' => 0,
            'v_log_whatsapp_date' => now(),
            'v_log_whatsapp_pass' => 'admin',
            'created_at' => now()
        ]);
        // $this->whatsAppService->send($phoneNumber, "Kode OTP Anda adalah: " . $otpCode);

        return response()->json([
            'success' => true,
            'message' => 'Kode OTP baru berhasil dikirim ke nomor HP Anda.'
        ]);
    }
    public function dashboard_home_reset_password_update(Request $request)
    {
        // 1. Validasi Input Request dari Form Bootstrap
        $request->validate([
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|same:new_password',
            'otp_code' => 'required|string|size:6',
        ]);

        $user = DB::table('tbl_biodata')->where('id_user', Auth::user()->id_user)->first();
        $phoneNumber =  Auth::user()->phone_number;

        // 2. Cari data OTP terakhir yang cocok, belum kedaluwarsa, dan belum digunakan
        $otpCheck = DB::table('password_otp_tokens')
            ->where('phone_number', $phoneNumber)
            ->where('otp_code', $request->otp_code)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->first();

        // 3. Jika OTP tidak ditemukan atau sudah tidak valid
        if (!$otpCheck) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP salah, sudah kedaluwarsa, atau telah digunakan.'
            ], 400);
        }

        // 4. Jalankan Query Update secara aman menggunakan Database Transaction
        DB::transaction(function () use ($request, $otpCheck) {

            // A. Update password baru milik user (di-hash menggunakan bcrypt)
            DB::table('users')->where('id_user', Auth::user()->id_user)->update([
                'password' => Hash::make($request->new_password)
            ]);

            // B. Tandai kode OTP tersebut sudah hangus/terpakai
            DB::table('password_otp_tokens')
                ->where('id', $otpCheck->id)
                ->update(['is_used' => true, 'updated_at' => Carbon::now()]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Selamat! Password Anda berhasil diperbarui.'
        ]);
    }
    public function dashboard_home_data_users()
    {
        $users = DB::table('tbl_biodata')->get();
        return response()->json($users, 200);
    }
    public function dashboard_home_data_tugas()
    {
        $tugas = DB::table('m_tugas')
            ->join('tbl_biodata', 'tbl_biodata.id_user', '=', 'm_tugas.target_user')
            ->where('target_user', Auth::user()->id_user)
            ->orderBy('status', 'asc') // Opsi tambahan: urutkan agar yang selesai ada di bawah
            ->orderBy('id', 'desc')
            ->take(100)->get();
        return response()->json($tugas, 200);
    }
    public function dashboard_home_data_tugas_status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Belum Dimulai,Dalam Pengerjaan,Dalam Peninjauan,Selesai'
        ]);

        // Update status di database
        $update = DB::table('m_tugas')->where('id', $id)->update([
            'status'     => $request->status,
            'updated_at' => now()
        ]);

        if ($update) {
            return response()->json(['message' => 'Status tugas berhasil diperbarui!'], 200);
        }

        return response()->json(['message' => 'Tugas tidak ditemukan atau tidak ada perubahan.'], 404);
    }
    public function dashboard_home_data_tugas_terima(Request $request, $id)
    {
        DB::table('m_tugas')->where('id', $id)->update([
            'status'     => 'Dalam Pengerjaan',
            'updated_at' => now()
        ]);
        return response()->json(['message' => 'Tugas berhasil diterima.'], 200);
    }
    public function dashboard_home_data_tugas_alihkan(Request $request, $id)
    {
        // 1. Validasi Input data dari Frontend
        $request->validate([
            'petugas_baru' => 'required|string|max:255',
            'alasan'       => 'required|string'
        ]);

        // 2. Paksa ID menjadi bentuk Integer (Mengantisipasi string data dari JS)
        $tugasId = (int) $id;

        // 3. Cari tugas target
        $tugas = DB::table('m_tugas')->where('id', $tugasId)->first();

        if (!$tugas) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tugas dengan ID ' . $tugasId . ' tidak ditemukan di database.'
            ], 404);
        }

        // 4. Buat riwayat catatan log mutasi
        $deskripsiLama = $tugas->deskripsi ?? 'Tidak ada deskripsi.';
        $logPengalihan = "\n\n[Riwayat: Dialihkan dari " . ($tugas->target_user ?? 'Tanpa PJ') . " ke " . $request->petugas_baru . ". Alasan: " . $request->alasan . "]";
        $deskripsiBaru = $deskripsiLama . $logPengalihan;

        // 5. Eksekusi Update ke Database secara paksa
        $prosesUpdate = DB::table('m_tugas')->where('id', $tugasId)->update([
            'target_user' => $request->petugas_baru,
            'status'      => 'Belum Dimulai',
            'deskripsi'   => $deskripsiBaru,
            'updated_at'  => now()
        ]);

        // 6. Kembalikan respon sukses terstruktur
        return response()->json([
            'status' => 'success',
            'message' => 'Tugas berhasil dialihkan kepada ' . $request->petugas_baru
        ], 200);
    }
    // PESAN
    public function dashboard_get_message(Request $request)
    {
        $cabangUser = DB::table('users_handler')
            ->where('id_user', '=', Auth::user()->id_user)
            ->pluck('kd_cabang');
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
    public function dashboard_log_daily(Request $request)
    {
        $data = DB::table('users_handler_record_log')
            ->join('tbl_kinerja_sub', 'tbl_kinerja_sub.kd_kinerja_sub', '=', 'users_handler_record_log.kd_kinerja_sub')
            ->select('users_handler_record_log.*', 'tbl_kinerja_sub.kinerja_sub')
            ->where('id_user', Auth::user()->id_user)
            ->where('kd_cabang', $request->code)
            ->where('tgl_record', date('Y-m-d'))->get();
        return view('application.dashboard.form-log-daily', compact('data'));
    }
    public function dashboard_log_daily_remove(Request $request)
    {
        try {
            DB::table('users_handler_record_log')->where('id', $request->code)->where('tgl_record', date('Y-m-d'))->delete();
            return 1;
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
    public function dashboard_monitoring_bulanan_user(Request $request)
    {
        return view('application.monitoring-bulanan.form-report-bulanan');
    }
    public function dashboard_monitoring_bulanan_user_report(Request $request)
    {
        $date1 = substr($request->date, 0, 10);
        $date2 = substr($request->date, 14, 10);
        $datahandle = DB::table('users_handler')
            ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
            ->where('id_user', Auth::user()->id_user)->get();
        $image = base64_encode(file_get_contents(public_path('icon1.png')));
        $start = $date1;
        $end = $date2;
        $pdf = PDF::loadview('application.monitoring-bulanan.report.report-laporan-bulanan', compact('image'), ['datahandle' => $datahandle, 'start' => $start, 'end' => $end])->setPaper('A4', 'potrait')->setOptions(['defaultFont' => 'Courier']);
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
    public function dashboard_monitoring_laporan_user(Request $request)
    {
        return view('application.laporan-user.form-report-laporan-user');
    }
    public function dashboard_monitoring_laporan_user_report(Request $request)
    {
        $date1 = substr($request->date, 0, 10);
        $date2 = substr($request->date, 14, 10);
        $datahandle = DB::table('users_handler')
            ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
            ->where('id_user', Auth::user()->id_user)->get();
        $image = base64_encode(file_get_contents(public_path('icon1.png')));
        $start = $date1;
        $end = $date2;
        $pdf = PDF::loadview('application.laporan-user.report.report-kendala-user', compact('image'), ['datahandle' => $datahandle, 'start' => $start, 'end' => $end])->setPaper('A4', 'landscape')->setOptions(['defaultFont' => 'Courier']);
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
