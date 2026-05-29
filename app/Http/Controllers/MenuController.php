<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function url_akses($akses)
    {
        $data = DB::table('z_menu_user')->where('menu_sub_code', $akses)->where('access_code', Auth::user()->kd_akses)->first();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
    public function url_akses_sub($akses)
    {
        $data = DB::table('z_menu_user_sub')->where('menu_main_sub_code', $akses)->where('access_code', Auth::user()->kd_akses)->first();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
    // RENCANA MAINTENANCE
    public function menu_rencana_maintenance($akses)
    {
        if ($this->url_akses($akses) == true) {
            $cabang = DB::table('users_handler')
                ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
                ->where('users_handler.id_user', Auth::user()->id_user)->get();
            return view('application.menu.menu-rencana-maintenance', compact('cabang'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function menu_rencana_maintenance_get_data(Request $request)
    {
        $url = "http://192.168.50.247/api/v2/datainventaris/" . $request->code;
        // $get_result_arr = json_decode($response->getContent($url), true);
        // echo $result;
        $response = file_get_contents($url, true);
        $data = json_decode($response);
        return view('application.menu.rencana-maintenance.data-barang-maintenance', compact('data'));
    }
    public function menu_rencana_maintenance_save(Request $request)
    {
        try {
            $code = str::uuid();
            DB::table('m_rencana_data')->insert([
                'm_rencana_data_code' => $code,
                'm_rencana_data_cabang' => $request->cabang,
                'm_rencana_data_user' => Auth::user()->id_user,
                'm_rencana_data_tahun' => $request->tahun_periode,
                'm_rencana_data_status' => 0,
                'created_at' => now()
            ]);
            foreach ($request->matriks_jadwal as $key => $value) {
                foreach ($value['items'] as $item) {
                    DB::table('m_rencana_detail')->insert([
                        'm_rencana_detail_code' => str::uuid(),
                        'm_rencana_data_code' => $code,
                        'm_rencana_detail_id_brg' => $item['id'],
                        'm_rencana_detail_nama_brg' => $item['nama'],
                        'm_rencana_detail_bulan' => $value['bulan'],
                        'm_rencana_detail_date' => now(),
                        'm_rencana_detail_status' => 0,
                        'created_at' => now(),
                    ]);
                }
            }
            return 1;
        } catch (\Throwable $e) {
            return 0;
        }
    }
    // PROSES MAINTENANCE
    public function menu_proses_maintenance($akses)
    {
        if ($this->url_akses($akses) == true) {
            $cabang = DB::table('users_handler')
                ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
                ->where('users_handler.id_user', Auth::user()->id_user)->get();
            return view('application.menu.menu-proses-maintenance', compact('cabang'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function menu_proses_maintenance_get_bulan(Request $request)
    {
        $data = DB::table('m_rencana_detail')
            ->join('m_rencana_data', 'm_rencana_data.m_rencana_data_code', '=', 'm_rencana_detail.m_rencana_data_code')
            ->select('m_rencana_detail.m_rencana_detail_bulan', 'm_rencana_data.id_m_rencana_data') // Added here
            ->distinct()
            ->where('m_rencana_data_cabang', '=', $request->cabang)
            ->where('m_rencana_data_tahun', '=', $request->tahun)
            ->orderBy('m_rencana_data.id_m_rencana_data', 'asc')
            ->pluck('m_rencana_detail_bulan');
        return response()->json($data);
    }
    public function menu_proses_maintenance_get_barang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cabang' => 'required|string',
            'tahun'  => 'required|string',
            'bulan'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Parameter cabang, tahun, dan bulan wajib diisi.'], 400);
        }

        // Mengambil data barang yang statusnya masih 'Belum' dieksekusi
        $dataBarang = DB::table('m_rencana_detail')
            ->select('m_rencana_detail_id_brg', 'm_rencana_detail_nama_brg')
            ->join('m_rencana_data', 'm_rencana_data.m_rencana_data_code', '=', 'm_rencana_detail.m_rencana_data_code')
            ->where('m_rencana_data_cabang', $request->cabang)
            ->where('m_rencana_data_tahun', $request->tahun)
            ->where('m_rencana_detail_bulan', $request->bulan)
            ->where('m_rencana_detail_status', 0)
            ->get(); // Mengembalikan array of objects, contoh: [{"id_aset":"MNT-01","nama_aset":"Genset"}]

        return response()->json($dataBarang);
    }
    public function menu_proses_maintenance_save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_aset'       => 'required|string',
            'cabang'        => 'required|string',
            'tahun'         => 'required|string',
            'bulan'         => 'required|string',
            'tgl_selesai'   => 'required|date',
            'tipe_tindakan' => 'required|string',
            'kondisi'       => 'required|string',
            'rincian'       => 'required|array|min:1', // Harus mengirimkan rincian penilaian minimal 1 item
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validasi gagal, pastikan semua data form terisi dengan benar.',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Menggunakan Database Transaction agar proses atomik (jika salah satu insert/update gagal, dibatalkan semua)
        try {
            DB::beginTransaction();

            // A. Update status barang di tabel target rencana_maintenance menjadi 'Selesai'
            $updated = DB::table('m_rencana_detail')
                ->join('m_rencana_data', 'm_rencana_data.m_rencana_data_code', '=', 'm_rencana_detail.m_rencana_data_code')
                ->where('m_rencana_detail_id_brg', $request->id_aset)
                ->where('m_rencana_data_cabang', $request->cabang)
                ->where('m_rencana_data_tahun', $request->tahun)
                ->where('m_rencana_detail_bulan', $request->bulan)
                ->update([
                    'm_rencana_detail_status' => '1',
                    'm_rencana_detail.updated_at'      => now() // jika menggunakan timestamp
                ]);

            // B. (Opsional) Insert ke tabel log riwayat penanganan riil jika Anda memilikinya
            // Misal Anda punya tabel 'log_realisasi_maintenance':
            $code = str::uuid();
            $logId = DB::table('m_rencana_log')->insertGetId([
                'm_rencana_log_code' => $code,
                'm_rencana_log_id_brg' => $request->id_aset,
                'm_rencana_log_cabang' => $request->cabang,
                'm_rencana_log_tahun' => $request->tahun,
                'm_rencana_log_bulan' => $request->bulan,
                'm_rencana_log_tgl_selesai' => $request->tgl_selesai,
                'm_rencana_log_tipe' => $request->tipe_tindakan,
                'm_rencana_log_kondisi' => $request->kondisi,
                'm_rencana_log_loc' => $request->lokasi,
                'created_at'    => now()
            ]);

            // Masukkan data array rincian komponen ke tabel detail_komponen jika ada
            foreach ($request->rincian as $item) {
                DB::table('m_rencana_log_detail')->insert([
                    'm_rencana_log_code'    => $code,
                    'm_rencana_log_detail_cat'  => $item['kategori'],
                    'm_rencana_log_detail_sub'  => $item['sub_nama'],
                    'm_rencana_log_detail_desc' => $item['deskripsi'],
                    'created_at' => now()
                ]);
            }


            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Berhasil memperbarui data maintenance aset ' . $request->id_aset,
                'data'    => $request->all()
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan internal pada server database.',
                'debug'   => $e->getMessage() // Matikan/hapus baris debug ini di lingkungan production
            ], 500);
        }
    }
    // PEMBUATAN TASK / TUGAS
    public function menu_create_task($akses)
    {
        if ($this->url_akses($akses) == true) {
            return view('application.menu.menu-create-task');
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    // LAPORAN KENDALA
    public function laporan_kendala_user($akses)
    {
        if ($this->url_akses($akses) == true) {
            $data = DB::table('tbl_laporan_user')->orderBy('id_laporan', 'DESC')->get();
            return view('application.laporan.laporan-kendala-user', compact('data'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function laporan_kendala_user_detail(Request $request)
    {
        $data = DB::table('tbl_laporan_user')->where('tiket_laporan', $request->code)->first();
        return view('application.laporan.kendala.detail-kendala', compact('data'));
    }
    // LAPORAN RENCANA MAINTENANCE
    public function laporan_rencana_maintenance($akses)
    {
        if ($this->url_akses($akses) == true) {
            $user = DB::table('tbl_biodata')->get();
            $data = DB::table('tbl_laporan_user')->orderBy('id_laporan', 'DESC')->get();
            return view('application.laporan.laporan-rencana-maintenance', compact('data', 'user'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function laporan_rencana_maintenance_detail(Request $request)
    {
        $bulan = DB::table('m_rencana_detail')
            ->join('m_rencana_data', 'm_rencana_data.m_rencana_data_code', '=', 'm_rencana_detail.m_rencana_data_code')
            ->select('m_rencana_detail.m_rencana_detail_bulan')
            ->where('m_rencana_data.m_rencana_data_user', '=', $request->petugas)
            ->where('m_rencana_data.m_rencana_data_tahun', '=', $request->tahun)
            ->distinct()
            ->get();
        return view('application.laporan.rencana-maintenance.detail-rencana', compact('bulan'), ['tahun' => $request->tahun]);
    }


    // MASTER PIKET SETUP
    public function master_piket_setup($akses)
    {
        if ($this->url_akses_sub($akses) == true) {
            $user = DB::table('users')->join('tbl_biodata', 'tbl_biodata.id_user', '=', 'users.id_user')->get();
            return view('application.master.master-piket-setup', compact('user'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function master_piket_setup_save(Request $request)
    {
        try {
            foreach ($request->jadwal as $value) {
                DB::table('piket_nasional')->insert([
                    'tiket_piket_nasional' => $value['tanggal'],
                    'tgl_piket_nasional' => $value['tanggal'],
                    'status_piket_nasional' => 0,
                    'created_at' => now()
                ]);
                foreach ($value['petugas'] as $data) {
                    DB::table('piket_nasional_user')->insert([
                        'tiket_piket_user' => str::uuid(),
                        'tiket_piket_nasional' => $value['tanggal'],
                        'user_piket' => $data['id'],
                        'created_at' => now()
                    ]);
                }
            }
        } catch (\Throwable $e) {
            # code...
        }
        return 1;
    }
    // MASTER PIKET DATA
    public function master_piket_data($akses)
    {
        if ($this->url_akses_sub($akses) == true) {
            $users = DB::table('piket_nasional_user')->join('tbl_biodata', 'tbl_biodata.id_user', '=', 'piket_nasional_user.user_piket')->get();
            $listMasterUser = DB::table('users')->select('users.id_user', 'name', 'nama_lengkap')->join('tbl_biodata', 'tbl_biodata.id_user', '=', 'users.id_user')->get();
            return view('application.master.master-piket-data', compact('users', 'listMasterUser'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function master_piket_data_bulan($bulan)
    {
        // 1. Cari jadwal berdasarkan bulan_tahun (misal: '2026-05') beserta relasinya
        $schedule = DB::table('piket_nasional_user')->join('tbl_biodata', 'tbl_biodata.id_user', '=', 'piket_nasional_user.user_piket')
            ->where('tiket_piket_nasional', 'LIKE', $bulan . '%')
            ->orderBy('tiket_piket_nasional', 'asc')
            ->get();

        // 2. Jika data kosong, langsung kembalikan array kosong
        if ($schedule->isEmpty()) {
            return response()->json([]);
        }

        // 3. Kelompokkan data berdasarkan tanggal menggunakan Collection Laravel
        $groupedDetails = $schedule->groupBy('tiket_piket_nasional');

        $databaseJadwalPiket = [];

        // 4. Looping data yang sudah dikelompokkan
        foreach ($groupedDetails as $tanggal => $items) {
            $petugasList = [];

            foreach ($items as $item) {
                if ($item->user_piket) {
                    $petugasList[] = [
                        'id'   => $item->user_piket, // "USR-01"
                        'nama' => $item->nama_lengkap       // "Andi"
                    ];
                }
            }
            $namaHariOtomatis = Carbon::parse($tanggal)->translatedFormat('l');
            // Susun format sesuai kebutuhan javascript array object kamu
            $databaseJadwalPiket[] = [
                'tanggal'        => $tanggal,
                'hari'           => $namaHariOtomatis, // Ambil nama hari dari baris pertama kelompok ini
                'jumlah_petugas' => count($petugasList),
                'petugas'        => $petugasList
            ];
        }

        // 5. Kembalikan response JSON yang siap pakai oleh Javascript
        return response()->json($databaseJadwalPiket);
    }
    public function master_piket_data_bulan_update(Request $request)
    {
        try {
            DB::table('piket_nasional_user')->where('tiket_piket_nasional', $request->tanggal)->delete();
            foreach ($request->petugas as $value) {
                DB::table('piket_nasional_user')->insert([
                    'tiket_piket_user' => str::uuid(),
                    'tiket_piket_nasional' => $request->tanggal,
                    'user_piket' => $value['id'],
                    'created_at' => now()
                ]);
            }
        } catch (\Throwable $e) {
            # code...
        }
        return 123;
    }

    // MASTER PIKET DATA
    public function master_data_staff($akses)
    {
        if ($this->url_akses($akses) == true) {
            $data = DB::table('tbl_biodata')->get();
            return view('application.master.master-staff', compact('data'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
}
