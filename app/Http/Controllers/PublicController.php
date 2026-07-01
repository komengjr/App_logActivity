<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Commands\Command;
use Telegram;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function newcase()
    {
        // $data = DB::table('tbl_kinerja')->
        return view('formcase');
    }
    public function postnewcase(Request $request)
    {
        DB::table('tbl_laporan_user')->insert([
            'tiket_laporan' => $request->tiket,
            'kd_cabang' => $request->kd_cabang,
            'nama_user' => $request->nama,
            'nip_user' => $request->nip,
            'divisi' => $request->divisi,
            'kategori_laporan' => $request->kategori_laporan,
            'deskripsi_laporan' => $request->deskripsi,
            'email' => $request->email,
            'no_hp' => $request->telegram,
            'status_laporan' => 0,
            'status_telegram' => 0,
            'tingkat_laporan' => $request->tingkat_laporan,
            'tgl_laporan' => date('Y-m-d H:i:s'),
        ]);
        $datacabang = DB::table('tbl_cabang')->where('kd_cabang', $request->kd_cabang)->first();
        $text = "Ada Tiket Baru Dengan Nomor : $request->tiket \nDari cabang $datacabang->nama_cabang \n Nomor Kontak : $request->telegram";


        Telegram::sendMessage([
            'chat_id' => '-1002095197699',
            'text' => $text,
        ]);
        $ceknotelegram = DB::table('telegram_chat_no')->where('no_hp', $request->telegram)->first();
        if ($ceknotelegram) {
            DB::table('tbl_laporan_user')->where('tiket_laporan', $request->tiket)->update([
                'status_telegram' => 1
            ]);
            Telegram::sendMessage([
                'chat_id' => $ceknotelegram->chat_id,
                'text' => "Tiket Berhasil di Buat dengan no : " . $request->tiket,
            ]);
        }
        return ($request->tiket);
    }
    public function caricabang($id)
    {
        $data = DB::table('tbl_cabang')->select('nama_cabang', 'kd_cabang')->where('nama_cabang', 'like', '%' . $id . '%')->limit(6)->get();
        return view('datacabang', ['data' => $data]);
    }
    public function pilihcabang($id)
    {
        $tiket = $id . "_" . date('Y_m_d') . '_' . date('H_i_s') . '_' . mt_rand(100, 999);
        $data = DB::table('tbl_cabang')->select('nama_cabang', 'kd_cabang', 'alamat')->where('kd_cabang', $id)->first();
        return view('pilihcabang', ['data' => $data, 'tiket' => $tiket]);
    }
    public function cek_status_laporan()
    {
        return view('cek-status-laporan');
    }
    public function caridatatiket($id)
    {
        $data = DB::table('tbl_laporan_user')->where('tiket_laporan', $id)->first();
        $penyelesaian = DB::table('tbl_laporan_user_log')->where('tiket_laporan', $id)->first();
        return view('data-tiket', [
            'data' => $data,
            'penyelesaian' => $penyelesaian,
        ]);
    }

    // PIKET
    public function piket_user()
    {
        $data = DB::table('piket_nasional_user')
            ->join('piket_nasional', 'piket_nasional.tiket_piket_nasional', '=', 'piket_nasional_user.tiket_piket_nasional')
            ->join('users', 'users.id_user', '=', 'piket_nasional_user.user_piket')
            ->join('tbl_biodata', 'tbl_biodata.id_user', '=', 'users.id_user')
            ->orWhere('piket_nasional.tgl_piket_nasional', 'like', '%' . date('Y-m-d') . '%')->get();
        return view('public.piket-user', ['data' => $data]);
    }
    public function piket_user_detail(Request $request)
    {
        $data = DB::table('tbl_laporan_user_log')
            ->join('tbl_laporan_user', 'tbl_laporan_user.tiket_laporan', '=', 'tbl_laporan_user_log.tiket_laporan')
            ->where('tbl_laporan_user_log.id_user', $request->code)->get();
        return view('public.piket-user-detail', ['data' => $data]);
    }
    public function v3_case()
    {
        $data = DB::table('tbl_cabang')->get();
        return view('v3.form-case', compact('data'));
    }
    public function v3_case_get_data(Request $request)
    {
        $url = "http://192.168.50.247/api/v2/datainventaris/" . $request->cabang;
        // $get_result_arr = json_decode($response->getContent($url), true);
        // echo $result;
        $response = file_get_contents($url, true);
        $newsData = json_decode($response);
        return view('v3.data-barang', compact('newsData'));
    }
    public function v3_case_save_data(Request $request)
    {
        try {
            $tiket = date('dmYHis') . mt_rand(100, 999);
            if ($request->kategori_laporan == 'ER-002') {
                $url = "http://192.168.50.247/api/v2/datainventaris_id/" . $request->data_barang;
                $response = file_get_contents($url, true);
                $newsData = json_decode($response);
                DB::table('tbl_laporan_hardware')->insert([
                    'tbl_laporan_hardware_code' => str::uuid(),
                    'tiket_laporan' => $tiket,
                    'inventaris_data_code' => $request->data_barang,
                    'inventaris_data_name' => $newsData->inventaris_data_name,
                    'tbl_laporan_hardware_status' => 0,
                    'created_at' => now(),
                ]);
            }
            if ($request->hasFile('bukti_laporan')) {
                $file = $request->file('bukti_laporan');
                // Membuat nama file unik, contoh: bukti_1719310000_pelapor.png
                $filename = 'bukti_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                // Menyimpan file ke folder: storage/app/public/bukti_kasus
                // Jangan lupa jalankan perintah "php artisan storage:link" di terminal
                $path = $file->storeAs('bukti_kasus', $filename, 'public');
                $namaFileSimpan = $filename;
            } else {
                $namaFileSimpan = "";
            }
            DB::table('tbl_laporan_user')->insert([
                'tiket_laporan' => $tiket,
                'kd_cabang' => $request->cabang,
                'nama_user' => $request->nama_pelapor,
                'nip_user' => $request->nip,
                'divisi' => $request->divisi,
                'kategori_laporan' => $request->kategori_laporan,
                'deskripsi_laporan' => $request->catatan_laporan,
                'status_laporan' => 0,
                'tingkat_laporan' => $request->tingkat_laporan,
                'tgl_laporan' => date('Y-m-d H:i:s'),
                'no_hp' => $request->no_whatsapp,
                'email' => $request->email,
                'file' => $namaFileSimpan,
                'status_telegram' => 0,
                'created_at' => now(),
            ]);
            $nomorhp = $request->no_whatsapp;
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
                "Halo, *" . $request->nama_pelapor . "*\n" .
                "Berikut adalah Tiket Laporan Anda:\n\n" .
                "```" . $tiket . "```\n\n" . "Deskripsi Laporan : " . $request->catatan_laporan .
                "\n\n⏰ _Tiket ini dibuat pada :_ " . now() . " WIB\n\n" .
                "⚠️ *Demi Kenyamanan Pelapor :* Pastikan Pengecekan Berkala Pada Sistem dengan Memasukan tiket Laporan anda.";
            DB::table('v_log_whatsapp')->insert([
                'v_log_whatsapp_code' => str::uuid(),
                'v_log_whatsapp_type' => 'laporan_user',
                'v_log_whatsapp_token' => $tiket,
                'v_log_whatsapp_number' => $nomorhp,
                'v_log_whatsapp_name' => $request->nama_pelapor,
                'v_log_whatsapp_filename' => 'nofile',
                'v_log_whatsapp_text' => $text,
                'v_log_whatsapp_file' => 'N',
                'v_log_whatsapp_picture' => 0,
                'v_log_whatsapp_status' => 0,
                'v_log_whatsapp_date' => now(),
                'v_log_whatsapp_pass' => 'admin',
                'created_at' => now()
            ]);
            $find = DB::table('users_handler')->join('users', 'users.id_user', '=', 'users_handler.id_user')->where('kd_cabang', $request->cabang)->get();
            foreach ($find as $value) {
                if ($value->phone_number == "") {
                    # code...
                } else {
                    # code...
                    $nomorhp = $value->phone_number;
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
                    $text1 = "🔐 *[LOGIT SYSTEM NOTIFICATION]*\n\n" .
                        "Halo, *" . $value->name . "*\n" .
                        "Berikut adalah Tiket Laporan Anda:\n\n" .
                        "```" . $tiket . "```\n\n" . "Deskripsi Laporan : " . $request->catatan_laporan .
                        "\n\n⏰ _Tiket ini dibuat pada :_ " . now() . " WIB\n\n" .
                        "⚠️ *Demi Kenyamanan Pelapor :* Pastikan Pengecekan Berkala Pada Sistem dengan Memasukan tiket Laporan anda.";
                    DB::table('v_log_whatsapp')->insert([
                        'v_log_whatsapp_code' => str::uuid(),
                        'v_log_whatsapp_type' => 'laporan_user',
                        'v_log_whatsapp_token' => $tiket,
                        'v_log_whatsapp_number' => $nomorhp,
                        'v_log_whatsapp_name' => $request->nama_pelapor,
                        'v_log_whatsapp_filename' => 'nofile',
                        'v_log_whatsapp_text' => $text1,
                        'v_log_whatsapp_file' => 'N',
                        'v_log_whatsapp_picture' => 0,
                        'v_log_whatsapp_status' => 0,
                        'v_log_whatsapp_date' => now(),
                        'v_log_whatsapp_pass' => 'admin',
                        'created_at' => now()
                    ]);
                }
            }

            // Telegram::sendMessage([
            //     'chat_id' => '-1002095197699',
            //     'text' => $text,
            // ]);
            return $tiket;
        } catch (\Throwable $e) {
            return 0;
        }
    }
    public function v3_case_get_tiket(Request $request)
    {
        $data = DB::table('tbl_laporan_user')->where('tiket_laporan', $request->code)->first();
        // $data = DB::table('tbl_laporan_user')->where('tiket_laporan'$request->code)->first();
        if ($data) {
            return view('v3.form-detail-laporan', ['data' => $data]);
        } else {
            return 0;
        }
    }
    public function v3_chek_laporan()
    {
        return view('v3.form-check-laporan');
    }
    public function v3_check_schedule()
    {
        $data = DB::table('piket_nasional_user')
            ->join('piket_nasional', 'piket_nasional.tiket_piket_nasional', '=', 'piket_nasional_user.tiket_piket_nasional')
            ->join('users', 'users.id_user', '=', 'piket_nasional_user.user_piket')
            ->join('tbl_biodata', 'tbl_biodata.id_user', '=', 'users.id_user')
            ->orWhere('piket_nasional.tgl_piket_nasional', 'like', '%' . date('Y-m-d') . '%')->get();
        return view('v3.form-check-schedule', ['data' => $data]);
    }
    public function v3_check_schedule_detail(Request $request)
    {
        return view('v3.schedule.form-schedule-detail');
    }
    public function v3_insert_kritis_cabang($code, $id, $tgl)
    {
        $kinerja = DB::table('tbl_kinerja_sub')->get();
        foreach ($kinerja as $value) {
            $cek = DB::table('users_handler_record_log')
                ->where('kd_cabang', $code)
                ->where('tgl_record', $tgl)
                ->where('kd_kinerja_sub', $value->kd_kinerja_sub)
                ->first();
            if (!$cek) {
                DB::table('users_handler_record_log')->insert([
                    'kd_kinerja_sub' => $value->kd_kinerja_sub,
                    'id_user' => $id,
                    'kd_cabang' => $code,
                    'tgl_record' => $tgl,
                    'ket_kinerja_sub' => 'N',
                    'status_kinerja_sub' => 0,
                    'created_at' => now()
                ]);
            }
        }
        return 'sukses';
    }
    public function v3_get_notif()
    {
        // $jumlahnotif = 0;
        // $notif = DB::table('tbl_schedule')
        //     ->where('status_schedule', 1)
        //     ->get();
        // foreach ($notif as $value) {
        //     if (substr($value->tgl_akhir, 0, 10) >= date('Y-m-d')){
        //         if (substr($value->tgl_start, 0, 10) <= date('Y-m-d')) {
        //         $cekdata = DB::table('tbl_schadule_log')->where('kd_schedule',$value->kd_schedule)->where('id_user',auth::user()->id_user)->count();

        //         if ($cekdata == 0){
        //             $jumlahnotif = $jumlahnotif + 1;
        //         }else{
        //         }
        //     }
        //     }
        // }
        if (Auth::check()) {
            $dataschedule = DB::table('tbl_schedule')->join('users_handler', 'users_handler.kd_cabang', '=', 'tbl_schedule.kd_cabang')
                ->where('tbl_schedule.status_schedule', 0)->where('users_handler.id_user', Auth::user()->id_user)->count();
            $datalaporan = DB::table('tbl_laporan_user')
                ->join('users_handler', 'users_handler.kd_cabang', '=', 'tbl_laporan_user.kd_cabang')
                ->where('users_handler.id_user', Auth::user()->id_user)
                ->where('tbl_laporan_user.status_laporan', '<', 2)->count();
            $jumlahnotif = $datalaporan + $dataschedule;
            return view('waktu', ['id' => $jumlahnotif]);
        } else {
            return view('waktu', ['id' => '-1']);
        }
    }
    public function v3_get_token_validasi($token)
    {
        $data = DB::table('b_validasi_data_req')
            ->join('b_validasi_data', 'b_validasi_data.b_validasi_data_code', '=', 'b_validasi_data_req.b_validasi_data_code')
            ->join('b_menus', 'b_menus.b_menus_code', '=', 'b_validasi_data_req.b_menus_code')
            ->where('b_validasi_data_req_code', $token)->first();
        if ($data) {
            // 1. Ambil semua 'b_menus_sub_code' yang SUDAH PERNAH divalidasi/disimpan di tabel b_validasi_bisone
            $alreadySavedCodes = DB::table('b_validasi_bisone')
                ->where('b_validasi_data_req_code', $token)
                ->pluck('b_menus_sub_code')
                ->toArray();
            $menu = DB::table('b_menus_sub')
                ->whereNotIn('b_menus_sub_code', $alreadySavedCodes) // Menyaring data
                ->pluck('b_menus_sub_name', 'b_menus_sub_code')
                ->toArray();
            // $menu = DB::table('b_menus_sub')->where('b_menus_code', $data->b_menus_code)->pluck('b_menus_sub_name', 'b_menus_sub_code')->toArray();
            return view('v3.form-validasi-menu-bisone', compact('menu', 'data'), ['token' => $token]);
            # code...
        } else {
            # code...
        }
    }
    public function v3_get_token_validasi_save(Request $request)
    {
        $validated = $request->validate([
            'b_menus_sub_code' => 'required|string',
            'code_token' => 'required|string',
            'tahun'            => 'required|integer',
            'bulan'            => 'required|string',
            'skala'            => 'required|integer|between:0,4',
            'catatan_manual'   => 'nullable|string',
            'nama_verifikator' => 'required|string',
            'ttd_verifikator'  => 'required|string',
            'nama_validator'   => 'required|string',
            'ttd_validator'    => 'required|string',
        ]);

        // Membuat kode acak/unik untuk kolom code (Contoh hasil: VLD-2026071422)
        $uniqueCode = 'VLD-' . date('YmdHis') . rand(10, 99);

        // Insert ke tabel b_validasi_bisone
        DB::table('b_validasi_bisone')->insert([
            'b_validasi_bisone_code'   => $uniqueCode,
            'b_validasi_data_req_code' => $validated['code_token'], // Sesuaikan aturan kode req Anda
            'tahun'                    => $validated['tahun'],
            'bulan'                    => $validated['bulan'],
            'b_menus_sub_code'         => $validated['b_menus_sub_code'],
            'skala'                    => $validated['skala'],
            'catatan_manual'           => $validated['catatan_manual'],
            'nama_verifikator'         => $validated['nama_verifikator'],
            'ttd_verifikator'          => $validated['ttd_verifikator'],
            'nama_validator'           => $validated['nama_validator'],
            'ttd_validator'            => $validated['ttd_validator'],
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan langsung ke database!'
        ], 200);
    }
}
