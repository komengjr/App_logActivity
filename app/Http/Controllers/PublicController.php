<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            $text = "Halo " . $request->nama_pelapor . "\n\nDengan Nomor Tiket : " . $tiket . "\n\nLogIT System Notifikasi";
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
        return view('v3.form-check-schedule');
    }
}
