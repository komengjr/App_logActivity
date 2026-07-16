<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

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
                        'm_rencana_detail_minggu' => $item['minggu'],
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
            DB::table('m_rencana_detail')
                ->join('m_rencana_data', 'm_rencana_data.m_rencana_data_code', '=', 'm_rencana_detail.m_rencana_data_code')
                ->where('m_rencana_detail_id_brg', $request->id_aset)
                ->where('m_rencana_data_cabang', $request->cabang)
                ->where('m_rencana_data_tahun', $request->tahun)
                ->where('m_rencana_detail_bulan', $request->bulan)
                ->update([
                    'm_rencana_detail_status' => '1',
                    'm_rencana_detail.updated_at'      => now() // jika menggunakan timestamp
                ]);
            $data = DB::table('m_rencana_detail')
                ->join('m_rencana_data', 'm_rencana_data.m_rencana_data_code', '=', 'm_rencana_detail.m_rencana_data_code')
                ->where('m_rencana_detail_id_brg', $request->id_aset)
                ->where('m_rencana_data_cabang', $request->cabang)
                ->where('m_rencana_data_tahun', $request->tahun)
                ->where('m_rencana_detail_bulan', $request->bulan)->first();
            // B. (Opsional) Insert ke tabel log riwayat penanganan riil jika Anda memilikinya
            // Misal Anda punya tabel 'log_realisasi_maintenance':
            $code = str::uuid();
            $logId = DB::table('m_rencana_log')->insertGetId([
                'm_rencana_log_code' => $code,
                'm_rencana_detail_code' => $data->m_rencana_detail_code,
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
    // PROSES MAINTENANCE
    public function menu_verifikasi_maintenance($akses)
    {
        if ($this->url_akses($akses) == true) {
            $cabang = DB::table('users_handler')
                ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
                ->where('users_handler.id_user', Auth::user()->id_user)->get();
            return view('application.menu.menu-verif-maintenance', compact('cabang'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function menu_verifikasi_maintenance_list_cabang()
    {
        $cabang = DB::table('users_handler')
            ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
            ->where('users_handler.id_user', Auth::user()->id_user)
            ->select('tbl_cabang.kd_cabang as cabang')
            ->distinct()
            ->get();

        return response()->json($cabang);
    }
    public function menu_verifikasi_maintenance_list_tahun(Request $request)
    {
        $tahun = DB::table('m_rencana_data')
            ->where('m_rencana_data_cabang', $request->cabang)
            ->select('m_rencana_data_tahun as tahun')
            ->distinct()
            ->get();

        return response()->json($tahun);
    }
    public function menu_verifikasi_maintenance_list_bulan(Request $request)
    {
        $bulan = DB::table('m_rencana_detail')
            ->join('m_rencana_data', 'm_rencana_detail.m_rencana_data_code', '=', 'm_rencana_data.m_rencana_data_code')
            ->where('m_rencana_data.m_rencana_data_cabang', $request->cabang)
            ->where('m_rencana_data.m_rencana_data_tahun', $request->tahun)
            ->select('m_rencana_detail.m_rencana_detail_bulan as bulan_nama')
            ->distinct()
            ->get();

        return response()->json($bulan);
    }
    public function menu_verifikasi_maintenance_data_perangkat(Request $request)
    {
        $userId = auth()->id() ?? 'USER-DUMMY-01';

        // Cari tahu dulu cabang apa saja yang boleh diakses user ini
        $cabangUser = DB::table('users_handler')
            ->where('id_user', '=', Auth::user()->id_user)
            ->pluck('kd_cabang');

        $query = DB::table('m_rencana_detail')
            ->join('m_rencana_data', 'm_rencana_detail.m_rencana_data_code', '=', 'm_rencana_data.m_rencana_data_code')
            ->join('m_rencana_log', 'm_rencana_log.m_rencana_detail_code', '=', 'm_rencana_detail.m_rencana_detail_code')
            ->select(
                'm_rencana_detail.id_m_rencana_detail as id',
                'm_rencana_detail.m_rencana_detail_code as detail_code',
                'm_rencana_data.m_rencana_data_cabang as cabang',
                'm_rencana_data.m_rencana_data_user as petugas_it',
                'm_rencana_detail.m_rencana_detail_nama_brg as nama_komputer',
                'm_rencana_detail.m_rencana_detail_date as tanggal_selesai',
                'm_rencana_detail.m_rencana_detail_verif as nama_atasan',
                'm_rencana_detail.m_rencana_detail_sign as signature_base64'
            )
            // Proteksi awal: Hanya mengambil data dari cabang yang di-handel user tersebut
            ->whereIn('m_rencana_data.m_rencana_data_cabang', $cabangUser);

        // Jika user memilih filter cabang spesifik di dropdown frontend
        // if ($request->filled('cabang')) {
        //     $query->where('m_rencana_data.m_rencana_data_cabang', $request->cabang);
        // }
        if ($request->filled('tahun')) {
            $query->where('m_rencana_data.m_rencana_data_tahun', $request->tahun);
        }
        if ($request->filled('bulan')) {
            $query->where('m_rencana_detail.m_rencana_detail_bulan', $request->bulan);
        }

        // Cek Status Verifikasi Atasan
        if ($request->status == 'sudah') {
            $query->whereNotNull('m_rencana_detail.m_rencana_detail_sign');
        } elseif ($request->status == 'belum') {
            $query->whereNull('m_rencana_detail.m_rencana_detail_sign');
        }

        $data = $query->get();

        return response()->json([
            'status' => 'SUCCESS',
            'data'   => $data
        ]);
    }
    public function menu_verifikasi_maintenance_simpan_verifikasi(Request $request)
    {
        $request->validate([
            'id_detail'        => 'required',
            'nama_atasan'      => 'required|string',
            'signature_base64' => 'required|string',
        ]);

        // Update record pada tabel m_rencana_detail
        DB::table('m_rencana_detail')
            ->where('id_m_rencana_detail', $request->id_detail)
            ->update([
                'm_rencana_detail_verif'  => $request->nama_atasan,
                'm_rencana_detail_sign'   => $request->signature_base64,
                'm_rencana_detail_status' => 1, // Anggap 1 artinya "Sudah Diverifikasi"
                'updated_at'              => now()
            ]);

        return response()->json([
            'status'  => 'SUCCESS',
            'message' => 'Validasi tanda tangan berhasil disimpan ke dalam Master-Detail System!'
        ]);
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
    public function menu_create_task_get_user(Request $request)
    {
        $users = DB::table('tbl_biodata')->get();
        return response()->json($users, 200);
    }
    public function menu_create_task_get_tugas(Request $request)
    {
        // Mengambil semua data tugas diurutkan dari yang terbaru
        $tugas = DB::table('m_tugas')
            ->join('tbl_biodata', 'tbl_biodata.id_user', '=', 'm_tugas.target_user')
            ->orderBy('status', 'asc') // Opsi tambahan: urutkan agar yang selesai ada di bawah
            ->orderBy('id', 'desc')
            ->take(100)->get();
        return response()->json($tugas, 200);
    }
    public function menu_create_task_get_tugas_status(Request $request, $id)
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

    public function menu_create_task_save(Request $request)
    {
        // 1. Validasi Input Data
        $request->validate([
            'nama'         => 'required|string|max:255',
            'tipe'         => 'required|string',
            'target_user'  => 'required|array|min:1', // Wajib berupa array dan minimal pilih 1
            'target_user.*' => 'string',
            'tgl_mulai'    => 'required|date',
            'tgl_selesai'  => 'required|date|after_or_equal:tgl_mulai',
            'surat_tugas'  => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
            'deskripsi'    => 'nullable|string',
        ]);

        $namaSurat = null;
        $urlSurat = null;

        // 2. Upload file hanya dilakukan sekali (Berbagi file URL yang sama untuk semua user terpilih)
        if ($request->hasFile('surat_tugas')) {
            $file = $request->file('surat_tugas');
            $namaSurat = $file->getClientOriginalName();
            $path = $file->store('surat_tugas', 'public');
            $urlSurat = asset('storage/' . $path);
        }

        // 3. PERUBAHAN UTAMA: Lakukan perulangan untuk setiap user yang di-checklist
        $dataInsert = [];
        foreach ($request->target_user as $user) {
            $dataInsert[] = [
                'nama'         => $request->nama,
                'tipe'         => $request->tipe,
                'target_user'  => $user, // Menyimpan 1 nama user per baris database (Bukan JSON lagi)
                'tgl_mulai'    => $request->tgl_mulai,
                'tgl_selesaimen'  => $request->tgl_selesai,
                'nama_surat'   => $namaSurat,
                'url_surat'    => $urlSurat,
                'deskripsi'    => $request->deskripsi ?? 'Tidak ada deskripsi.',
                'create_user'  => Auth::user()->id_user,
                'status'       => 'Belum Dimulai',
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        // 4. Gunakan insert bulk (sekaligus) agar performa database lebih cepat
        DB::table('m_tugas')->insert($dataInsert);

        return response()->json([
            'message' => count($dataInsert) . ' Tugas berhasil didelegasikan!'
        ], 201);
    }
    // BACKUP BULANAN
    public function menu_backup_bulanan($akses)
    {
        if ($this->url_akses($akses) == true) {
            $cabang = DB::table('users_handler')
                ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
                ->where('users_handler.id_user', Auth::user()->id_user)->get();
            $backups = DB::table('users_backup_bulanan')->orderBy('id_backup_bulanan', 'desc')->get();
            return view('application.menu.menu-backup-bulanan', compact('backups', 'cabang'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function menu_backup_bulanan_save(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'cabang'      => 'required|string',
            'bulan'       => 'required|string',
            'tahun'       => 'required|string',
            'deskripsi'   => 'required|string',
            'screenshot'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);
        $filename = null;

        // Proses upload file screenshot ke folder public/storage/screenshots
        if ($request->hasFile('screenshot')) {
            $file = $request->file('screenshot');
            $filename = time() . '_' . $file->getClientOriginalName();

            // MENGGUNAKAN METHOD DISK PUBLIC (Lebih direkomendasikan)
            // Ini otomatis menyimpan ke folder: storage/app/public/screenshots/
            Storage::disk('public')->putFileAs('screenshots', $file, $filename);
        }

        // Simpan data ke database
        DB::table('users_backup_bulanan')->insert([
            'kd_backup_bulanan' => str::uuid(),
            'kd_cabang'      => $request->cabang,
            'nama_backup_bulanan'       => $request->bulan,
            'tahun_backup_bulanan'       => $request->tahun,
            'deskripsi'   => $request->deskripsi,
            'tgl_input'   => now(),
            'screenshot'  => $filename, // Simpan nama filenya saja
            'created_at' => now()
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data backup berhasil diunggah!');
    }
    // VALIDASI SYSTEM BISONE
    public function menu_validasi_sistem($akses)
    {
        if ($this->url_akses($akses) == true) {
            $cabang = DB::table('users_handler')
                ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
                ->where('users_handler.id_user', Auth::user()->id_user)->get();
            $backups = DB::table('users_backup_bulanan')->orderBy('id_backup_bulanan', 'desc')->get();
            return view('application.menu.menu-validasi-bisone', compact('backups', 'cabang'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function menu_validasi_sistem_get(Request $request)
    {
        $data = DB::table('b_validasi_data')->where('b_validasi_data_cabang', $request->cabang)->where('b_validasi_data_user', Auth::user()->id_user)->get();
        return view('application.menu.validasi-bisone.data-validasi-bisone', compact('data'));
    }
    public function menu_validasi_sistem_save(Request $request)
    {
        try {
            DB::table('b_validasi_data')->insert([
                'b_validasi_data_code' => str::uuid(),
                'b_validasi_data_cabang' => $request->cabang,
                'b_validasi_data_tahun' => $request->tahun,
                'b_validasi_data_bulan' => $request->bulan,
                'b_validasi_data_user' => Auth::user()->id_user,
                'b_validasi_data_status' => 0,
                'created_at' => now(),
            ]);
            $data = DB::table('b_validasi_data')->where('b_validasi_data_user', Auth::user()->id_user)->get();
            return view('application.menu.validasi-bisone.data-validasi-bisone', compact('data'));
        } catch (\Throwable $e) {
            return 0;
        }
    }
    public function menu_validasi_sistem_proses(Request $request)
    {
        $data = DB::table('b_menus')->get();
        return view('application.menu.validasi-bisone.form-proses-data-validasi-bisone', compact('data'), ['code' => $request->code]);
    }
    public function menu_validasi_sistem_create_data_form(Request $request)
    {
        try {
            $cek = DB::table('b_validasi_data_req')->where('b_validasi_data_code', $request->id)->first();
            if ($cek) {
                return 0;
            } else {
                DB::table('b_validasi_data_req')->insert([
                    'b_validasi_data_req_code' => str::uuid(),
                    'b_validasi_data_code' => $request->id,
                    'b_menus_code' => $request->code,
                    'b_validasi_data_req_date' => now(),
                    'b_validasi_data_req_status' => 0,
                    'created_at' => now()
                ]);
                return 1;
            }
        } catch (\Throwable $e) {
            return 0;
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
        return view('application.laporan.rencana-maintenance.detail-rencana', compact('bulan'), ['tahun' => $request->tahun, 'petugas' => $request->petugas]);
    }
    public function laporan_rencana_maintenance_cetak_rencana(Request $request)
    {
        return view('application.laporan.rencana-maintenance.form-report-rencana-maintenance', ['code' => $request->code]);
    }
    public function laporan_rencana_maintenance_cetak_rencana_report(Request $request)
    {
        $bulan = DB::table('m_rencana_detail')
            ->join('m_rencana_data', 'm_rencana_data.m_rencana_data_code', '=', 'm_rencana_detail.m_rencana_data_code')
            ->select('m_rencana_detail.m_rencana_detail_bulan', 'm_rencana_detail.m_rencana_data_code')
            ->where('m_rencana_data.m_rencana_data_user', '=', $request->petugas)
            ->where('m_rencana_data.m_rencana_data_tahun', '=', $request->code)
            ->distinct()
            ->get();
        $bio = DB::table('tbl_biodata')->where('id_user', $request->petugas)->first();
        $image = base64_encode(file_get_contents(public_path('icon1.png')));
        $pdf = PDF::loadview('application.laporan.rencana-maintenance.report.report-rencana-maintenance', compact('image', 'bulan', 'bio'), ['tahun' => $request->code])->setPaper('A3', 'landscape')->setOptions(['defaultFont' => 'Courier']);
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
    public function laporan_rencana_maintenance_cetak(Request $request)
    {
        return view('application.laporan.rencana-maintenance.form-report-hasil-maintenance', ['code' => $request->code, 'petugas' => $request->petugas]);
    }
    public function laporan_rencana_maintenance_cetak_report(Request $request)
    {
        $cabang = DB::table('tbl_cabang')
            ->join('m_rencana_data', 'm_rencana_data.m_rencana_data_cabang', '=', 'tbl_cabang.kd_cabang')
            ->join('m_rencana_detail', 'm_rencana_detail.m_rencana_data_code', '=', 'm_rencana_data.m_rencana_data_code')
            ->join('m_rencana_log', 'm_rencana_log.m_rencana_detail_code', '=', 'm_rencana_detail.m_rencana_detail_code')
            ->join('users', 'users.id_user', '=', 'm_rencana_data.m_rencana_data_user')
            ->where('m_rencana_detail.m_rencana_detail_code', $request->code)->first();
        $log = DB::table('m_rencana_log_detail')
            ->join('m_rencana_log', 'm_rencana_log.m_rencana_log_code', '=', 'm_rencana_log_detail.m_rencana_log_code')
            ->where('m_rencana_detail_code', $request->code)->get();
        $image = base64_encode(file_get_contents(public_path('icon1.png')));
        $pdf = PDF::loadview('application.laporan.rencana-maintenance.report.report-hasil-maintenance', compact('image', 'log', 'cabang'))->setPaper('A4', 'potrait')->setOptions(['defaultFont' => 'Courier']);
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
    // LAPORAN LOG BISONE
    public function laporan_log_bisone($akses)
    {
        if ($this->url_akses($akses) == true) {
            try {
                $data = DB::connection('second_db')->table('log')->orderBy('logID', 'DESC')->take(500)->get();
                return view('application.laporan.laporan-log-bisone', compact('data'));
            } catch (\Throwable $e) {
                return Redirect::to('dashboard/home');
            }
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function laporan_log_bisone_print(Request $request)
    {
        $cabang = DB::table('tbl_cabang')->get();
        return view('application.laporan.log-bisone.form-report-log', compact('cabang'));
    }
    // LAPORAN IT SUPPORT
    public function laporan_it_support($akses)
    {
        if ($this->url_akses($akses) == true) {
            try {
                $data = DB::table('users_handler')
                    ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
                    ->where('users_handler.id_user', Auth::user()->id_user)->get();
                $cabang = DB::table('tbl_cabang')->get();
                return view('application.laporan.laporan-it-support', compact('data', 'cabang'));
            } catch (\Throwable $e) {
                return Redirect::to('dashboard/home');
            }
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function laporan_it_support_get_data(Request $request)
    {
        $date1 = substr($request->start, 0, 10);
        $date2 = substr($request->end, 0, 10);
        $startdate = $request->start;
        $startdate = strtotime($date1);
        $enddate = $request->end;
        $enddate = strtotime($date2);
        if ($request->laporan == 'kritis') {
            $harimasuk = array();
            for ($i = $startdate; $i <= $enddate; $i += (60 * 60 * 24)) {
                if (date('w', $i) !== '0') {
                    $harimasuk[] = $i;
                } else {
                }
            }
            $datacabang = DB::table('tbl_cabang')->where('kd_cabang', $request->cabang)->first();
            $dataharian = DB::table('tbl_kinerja_sub')->where('jenis_kinerja_sub', 1)->get();
            return view('application.laporan.laporan-it-support.data-kritis', compact('harimasuk', 'datacabang', 'dataharian'));
        } elseif ($request->laporan == 'b_harian') {
            $backupharian = DB::table('users_backup_harian')->where('kd_cabang', $request->cabang)->whereBetween('tgl_backup_harian', [$date1, $date2])->get();
            return view('application.laporan.laporan-it-support.data-backup-harian', compact('backupharian'));
        } elseif ($request->laporan == 'b_bulanan') {
            $backupbulanan = DB::table('users_backup_bulanan')->where('kd_cabang', $request->cabang)
                ->whereBetween('tgl_input', [$date1, $date2])->get();
            return view('application.laporan.laporan-it-support.data-backup-bulanan', compact('backupbulanan'));
        } elseif ($request->laporan == 'kendala') {
            $kendala = DB::table('tbl_laporan_user')
                ->where('kd_cabang', $request->cabang)
                ->whereBetween('tgl_laporan', [$date1, $date2])
                ->get();
            return view('application.laporan.laporan-it-support.data-kendala-user', compact('kendala'));
        } else {
            # code...
            return 'comingsoon';
        }
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

    // MASTER STAFF
    public function master_data_staff($akses)
    {
        if ($this->url_akses($akses) == true) {
            $data = DB::table('tbl_biodata')->get();
            return view('application.master.master-staff', compact('data'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function master_data_staff_add(Request $request)
    {
        $cabang = DB::table('tbl_cabang')->get();
        return view('application.master.master-staff.form-add-staff', compact('cabang'));
    }
    public function master_data_staff_save(Request $request)
    {
        try {
            $namaGambar = "";
            $id =  'UUID' . date('Ymdhis');
            // 3. Simpan ke Database memakai Query Builder / DB Facade sesuai skema penamaan tabel Anda
            DB::table('tbl_biodata')->insert([
                'id_user'    => $id,
                'kd_cabang'    => $request->kd_cabang,
                'nip'          => $request->nip,
                'nama_lengkap' => $request->nama_lengkap,
                'tgl_lahir'    => $request->tgl_lahir,
                'tempat_lahir' => $request->tempat_lahir,
                'no_hp'        => $request->no_hp,
                'alamat'       => $request->alamat,
                'gambar'       => $namaGambar,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
            DB::table('users')->insert([
                'id_user' => $id,
                'name' => $request->nama_lengkap,
                'email' => $request->nip,
                'password' => Hash::make($request->nip),
                'kd_akses' => $request->akses,
                'cabang' => $request->kd_cabang,
                'status_user' => 1,
                'phone_number' => $request->no_hp,
                'remember_token' => str::uuid(),
                'created_at' => now()
            ]);
            // Kembalikan JSON sukses
            return 1;
        } catch (\Exception $e) {
            // Jika terjadi error pada database atau sistem, kembalikan pesan error
            return 0;
        }
    }
    // MASTER KINERJA
    public function master_data_kinerja($akses)
    {
        if ($this->url_akses($akses) == true) {
            $data = DB::table('tbl_biodata')->get();
            return view('application.master.master-kinerja', compact('data'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    // MASTER CABANG
    public function master_data_cabang($akses)
    {
        if ($this->url_akses($akses) == true) {
            $data = DB::table('tbl_cabang')->get();
            return view('application.master.master-cabang', compact('data'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function master_data_cabang_update(Request $request)
    {
        $data = DB::table('tbl_cabang')->where('kd_cabang', $request->code)->first();
        return view('application.master.master-cabang.form-update-cabang', compact('data'));
    }
    public function master_data_cabang_update_save(Request $request)
    {
        try {
            DB::table('tbl_cabang')->where('kd_cabang', $request->kode_cabang)->update([
                'nama_cabang' => $request->nama_cabang,
                'latitude' => $request->lat,
                'longtitude' => $request->long,
                'city' => $request->kota_cabang,
                'alamat' => $request->alamat,
                'phone' => $request->no_telp,
                'updated_at' => now()
            ]);
            return 1;
        } catch (\Throwable $e) {
            return 0;
        }
    }
    public function master_data_cabang_add_petugas(Request $request)
    {
        $user = DB::table('tbl_biodata')->get();
        return view('application.master.master-cabang.form-add-petugas', compact('user'), ['code' => $request->code]);
    }
    public function master_data_cabang_save_petugas(Request $request)
    {
        try {
            DB::table('users_handler')->insert([
                'id_user' => $request->petugas,
                'kd_cabang' => $request->code_cabang,
                'created_at' => now(),
            ]);
            return 1;
        } catch (\Throwable $e) {
            return 0;
        }
    }
    public function master_data_cabang_update_conn(Request $request)
    {
        return view('application.master.master-cabang.form-update-conn', ['code' => $request->code]);
    }
    public function master_data_cabang_update_conn_save(Request $request)
    {
        $passwordEnkripsi = Crypt::encryptString($request->password);
        try {
            DB::table('tbl_cabang_address')->insert([
                'tbl_cabang_address_code' => str::uuid(),
                'kd_cabang' => $request->code,
                'tbl_cabang_address_ip' => $request->ip,
                'tbl_cabang_address_user' => $request->username,
                'tbl_cabang_address_pass' => $passwordEnkripsi,
                'created_at' => now()
            ]);
            return 1;
        } catch (\Throwable $e) {
            return 0;
        }
    }
    // MASTER CABANG
    public function master_data_menu_validasi($akses)
    {
        if ($this->url_akses($akses) == true) {
            $data = DB::table('b_menus')->get();
            return view('application.master.master-menu-validasi-bisone', compact('data'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function master_data_menu_validasi_add(Request $request)
    {
        return view('application.master.master-menu.form-add-kategori-menu');
    }
    public function master_data_menu_validasi_save(Request $request)
    {
        try {
            DB::table('b_menus')->insert([
                'b_menus_code' => str::uuid(),
                'b_menus_kategori' => $request->name,
                'b_menus_status' => 1,
                'created_at' => now()
            ]);
            return 1;
        } catch (\Throwable $e) {
            return 0;
        }
    }
    public function master_data_menu_validasi_add_sub_menu(Request $request)
    {
        return view('application.master.master-menu.form-add-sub-menu', ['code' => $request->code]);
    }
    public function master_data_menu_validasi_save_sub_menu(Request $request)
    {
        try {
            DB::table('b_menus_sub')->insert([
                'b_menus_sub_code' => str::uuid(),
                'b_menus_code' => $request->code,
                'b_menus_sub_name' => $request->name,
                'b_menus_sub_status' => 1,
                'created_at' => now()
            ]);
            return 1;
        } catch (\Throwable $e) {
            return 0;
        }
    }
    // MASTER TOOLS
    public function master_data_tools(Request $request, $akses)
    {
        if ($this->url_akses($akses) == true) {
            $dataLogs = [];
            // Jika terdapat request filter lengkap, tampilkan datanya
            if ($request->has('tgl_mulai') && $request->has('tgl_selesai') && $request->has('kd_cabang')) {
                $dataLogs = DB::table('users_handler_record_log')
                    ->where('kd_cabang', $request->kd_cabang)
                    ->whereBetween('tgl_record', [$request->tgl_mulai, $request->tgl_selesai])
                    ->get();
            }
            $cabang = DB::table('users_handler')
                ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
                ->where('users_handler.id_user', Auth::user()->id_user)->get();
            return view('application.master.master-tools', compact('dataLogs', 'cabang'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function master_data_tools_show(Request $request)
    {
        $dataLogs = DB::table('users_handler_record_log')
            ->join('tbl_kinerja_sub', 'tbl_kinerja_sub.kd_kinerja_sub', '=', 'users_handler_record_log.kd_kinerja_sub')
            ->where('kd_cabang', $request->kd_cabang)
            ->whereBetween('tgl_record', [$request->tgl_mulai, $request->tgl_selesai])
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $dataLogs
        ]);
    }
    public function master_data_tools_proses(Request $request)
    {
        $tglMulai   = Carbon::parse($request->tgl_mulai);
        $tglSelesai = Carbon::parse($request->tgl_selesai);
        $kdCabang   = $request->kd_cabang;
        $idUser     = auth()->id() ?? '1';

        $kinerja = DB::table('tbl_kinerja_sub')->get();

        if ($kinerja->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Master tbl_kinerja_sub kosong.'], 400);
        }

        DB::beginTransaction();
        try {
            $counterInsert = 0;

            for ($date = $tglMulai; $date->lte($tglSelesai); $date->addDay()) {
                $tglFormat = $date->format('Y-m-d');

                foreach ($kinerja as $value) {
                    $cek = DB::table('users_handler_record_log')
                        ->where('kd_cabang', $kdCabang)
                        ->where('tgl_record', $tglFormat)
                        ->where('kd_kinerja_sub', $value->kd_kinerja_sub)
                        ->first();

                    if (!$cek) {
                        DB::table('users_handler_record_log')->insert([
                            'kd_kinerja_sub'     => $value->kd_kinerja_sub,
                            'id_user'            => Auth::user()->id_user,
                            'kd_cabang'          => $kdCabang,
                            'tgl_record'         => $tglFormat,
                            'ket_kinerja_sub'    => 'N',
                            'status_kinerja_sub' => 0,
                            'created_at'         => now(),
                            'updated_at'         => now()
                        ]);
                        $counterInsert++;
                    }
                }
            }
            DB::commit();

            // Tarik data terbaru setelah import untuk dilempar ke AJAX
            $dataLogs = DB::table('users_handler_record_log')
                ->join('tbl_kinerja_sub', 'tbl_kinerja_sub.kd_kinerja_sub', '=', 'users_handler_record_log.kd_kinerja_sub')
                ->where('kd_cabang', $kdCabang)
                ->whereBetween('tgl_record', [$request->tgl_mulai, $request->tgl_selesai])
                ->get();

            return response()->json([
                'success' => true,
                'message' => "Proses Berhasil! Berhasil menambah {$counterInsert} data baru.",
                'data'    => $dataLogs
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function master_data_tools_update(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->has('logs')) {
                foreach ($request->input('logs') as $logItem) {
                    DB::table('users_handler_record_log')
                        ->where('id', $logItem['id'])
                        ->update([
                            'ket_kinerja_sub' => $logItem['text_ket'] ?? '',
                            'updated_at'      => now()
                        ]);
                }
            }
            DB::commit();

            // Ambil ulang data fresh setelah update berhasil dilakukan
            $dataLogs = DB::table('users_handler_record_log')
                ->where('kd_cabang', $request->kd_cabang)
                ->whereBetween('tgl_record', [$request->tgl_mulai, $request->tgl_selesai])
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Perubahan seluruh keterangan berhasil disimpan!',
                'data'    => $dataLogs
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function master_data_tools_proses_backup(Request $request)
    {
        $request->validate([
            'tgl_mulai'   => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'kd_cabang'   => 'required|string',
        ]);

        $tglMulai   = Carbon::parse($request->tgl_mulai);
        $tglSelesai = Carbon::parse($request->tgl_selesai);
        $kdCabang   = $request->kd_cabang;

        DB::beginTransaction();
        try {
            $counterInsert = 0;

            // Loop harian langsung tanpa tbl_kinerja_sub
            for ($date = $tglMulai; $date->lte($tglSelesai); $date->addDay()) {
                $tglFormat = $date->format('Y-m-d');

                // Cek apakah data backup harian untuk cabang pada tanggal ini sudah ada
                $cek = DB::table('users_backup_harian')
                    ->where('kd_cabang', $kdCabang)
                    ->where('tgl_backup_harian', $tglFormat)
                    ->first();

                // Jika belum ada data backup untuk tanggal tersebut, lakukan insert
                if (!$cek) {
                    // Membuat Kode Unik otomatis (Contoh: BKP-C01-20260624-ABCD)
                    $kdUnique = 'BKP-' . $kdCabang . '-' . $date->format('Ymd') . '-' . Str::upper(Str::random(4));

                    DB::table('users_backup_harian')->insert([
                        'kd_users_backup_harian'   => $kdUnique,
                        'sistem_backup_harian'     => 'OK', // Bisa diisi nilai default/statis
                        'proses_backup_harian'     => 'OK',
                        'deskripsi_backup_harian'  => 'Sistem running',
                        'file_backup_harian'       => '-',
                        'status_backup_harian'     => '0',
                        'tgl_backup_harian'        => $tglFormat,
                        'kd_cabang'                => $kdCabang,
                        'created_at'               => now(),
                        'updated_at'               => now()
                    ]);
                    $counterInsert++;
                }
            }
            DB::commit();

            // Ambil data fresh dari range tanggal untuk langsung ditampilkan di DataTables bawah
            $dataLogs = DB::table('users_backup_harian')
                ->where('kd_cabang', $kdCabang)
                ->whereBetween('tgl_backup_harian', [$request->tgl_mulai, $request->tgl_selesai])
                ->get();

            return response()->json([
                'success' => true,
                'message' => "Sukses! Berhasil generate {$counterInsert} data backup harian baru.",
                'data'    => $dataLogs
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
    public function master_data_tools_proses_backup_update(Request $request)
    {
        // Validasi parameter filter yang dikirim balik oleh DataTables
        $request->validate([
            'tgl_mulai'   => 'required|date',
            'tgl_selesai' => 'required|date',
            'kd_cabang'   => 'required|string',
            'logs'        => 'required|array',
            'logs.*.id'   => 'required',
            'logs.*.text_ket' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            // Melakukan looping untuk mengupdate baris per baris data yang diubah
            foreach ($request->input('logs') as $logItem) {
                DB::table('users_backup_harian')
                    ->where('id_users_backup_harian', $logItem['id']) // Menggunakan Primary Key tabel backup harian
                    ->update([
                        'deskripsi_backup_harian' => $logItem['text_ket'] ?? '', // Mengupdate kolom deskripsi
                        'updated_at'              => now()
                    ]);
            }
            DB::commit();

            // Mengambil kembali data yang fresh setelah di-update berdasarkan range tanggal filter
            $dataLogs = DB::table('users_backup_harian')
                ->where('kd_cabang', $request->kd_cabang)
                ->whereBetween('tgl_backup_harian', [$request->tgl_mulai, $request->tgl_selesai])
                ->get();

            // Mengembalikan response JSON sukses beserta data terbaru agar DataTables merender ulang otomatis
            return response()->json([
                'success' => true,
                'message' => 'Perubahan seluruh deskripsi backup harian berhasil disimpan!',
                'data'    => $dataLogs
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui deskripsi: ' . $e->getMessage()
            ], 500);
        }
    }
    public function master_data_tools_proses_backup_update_file(Request $request)
    {
        $request->validate([
            'id_backup'   => 'required',
            'file_backup' => 'required|file|max:20480', // Maksimal file 20MB, sesuaikan kebutuhan
            'tgl_mulai'   => 'required',
            'tgl_selesai' => 'required',
            'kd_cabang'   => 'required',
        ]);

        try {
            if ($request->hasFile('file_backup')) {
                $file = $request->file('file_backup');

                // 1. Simpan file otomatis ke folder: storage/app/public/backup_harian
                // Gunakan nama asli file atau buat nama unik baru
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('monitoring_harian/' . Auth::user()->id_user . '', $filename, 'public');

                // 2. Update database (Ubah nama file dan ubah status_backup_harian menjadi '1' karena file sudah ada)
                DB::table('users_backup_harian')
                    ->where('id_users_backup_harian', $request->id_backup)
                    ->update([
                        'file_backup_harian'   => $path,
                        'status_backup_harian' => '1', // Otomatis status berubah jadi Aktif/Selesai
                        'updated_at'           => now()
                    ]);

                // 3. Ambil data fresh untuk merender ulang tabel di UI tanpa reload page
                $dataLogs = DB::table('users_backup_harian')
                    ->where('kd_cabang', $request->kd_cabang)
                    ->whereBetween('tgl_backup_harian', [$request->tgl_mulai, $request->tgl_selesai])
                    ->get();

                return response()->json([
                    'success' => true,
                    'message' => 'File backup berhasil diunggah dan sistem diperbarui!',
                    'data'    => $dataLogs
                ]);
            }

            return response()->json(['success' => false, 'message' => 'File tidak ditemukan.'], 400);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal upload: ' . $e->getMessage()], 500);
        }
    }

    // MASTER LOG
    public function master_data_log(Request $request, $akses)
    {
        if ($this->url_akses($akses) == true) {
            if (Auth::user()->kd_akses <= 2) {
                $cabang = DB::table('tbl_cabang')->get();
            } else {
                $cabang = DB::table('users_handler')
                    ->join('tbl_cabang', 'tbl_cabang.kd_cabang', '=', 'users_handler.kd_cabang')
                    ->where('users_handler.id_user', Auth::user()->id_user)->get();
            }
            return view('application.master.master-log', compact('cabang'));
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function master_data_log_get_data(Request $request)
    {
        try {
            $conn = DB::table('tbl_cabang_address')->where('kd_cabang', $request->cabang)->first();
            if ($conn) {
                // 1. Set konfigurasi database secara dinamis
                config([
                    'database.connections.dynamic_conn' => [
                        'driver'    => 'mysql', // ganti dengan 'sqlsrv', 'pgsql', dll. jika bukan MySQL
                        'host'      => $conn->tbl_cabang_address_ip,
                        'database'  => 'one_log',
                        'username'  => $conn->tbl_cabang_address_user,
                        'password'  => Crypt::decryptString($conn->tbl_cabang_address_pass),
                        'charset'   => 'utf8mb4',
                        'collation' => 'utf8mb4_unicode_ci',
                        'prefix'    => '',
                    ]
                ]);
                // 1. Set konfigurasi database secara dinamis
                config([
                    'database.connections.dynamic_conn2' => [
                        'driver'    => 'mysql', // ganti dengan 'sqlsrv', 'pgsql', dll. jika bukan MySQL
                        'host'      => $conn->tbl_cabang_address_ip,
                        'database'  => 'one',
                        'username'  => $conn->tbl_cabang_address_user,
                        'password'  => Crypt::decryptString($conn->tbl_cabang_address_pass),
                        'charset'   => 'utf8mb4',
                        'collation' => 'utf8mb4_unicode_ci',
                        'prefix'    => '',
                    ]
                ]);
                if ($request->table == 'log_login') {
                    $log = DB::connection('dynamic_conn')
                        ->table('log_login')
                        ->whereBetween('Log_LoginDateTime', [$request->start, $request->end]) // Membatasi maksimal 200 data
                        ->orderBy('Log_LoginID', 'desc')
                        ->get();
                    return view('application.master.master-log.data-log-login', compact('log'));
                } elseif ($request->table == 'log_patient') {
                    $log = DB::connection('dynamic_conn')
                        ->table('log_patient')
                        ->whereBetween('Log_PatientDate', [$request->start, $request->end]) // Membatasi maksimal 200 data
                        ->orderBy('Log_PatientID', 'desc')
                        ->get();
                    return view('application.master.master-log.data-log-patient', compact('log'));
                } elseif ($request->table == 'result_handoveremail_log') {
                    $log = DB::connection('dynamic_conn')
                        ->table('result_handoveremail_log')
                        ->whereBetween('Result_HandOverEmailLogDateTime', [$request->start, $request->end]) // Membatasi maksimal 200 data
                        ->orderBy('Result_HandOverEmailLogID', 'desc')
                        ->get();
                    return view('application.master.master-log.data-log-email', compact('log'));
                } elseif ($request->table == 'FO_log') {
                    $dataLog = DB::connection('dynamic_conn')
                        ->table('log_fo')
                        ->whereBetween('Log_FoDate', [$request->start, $request->end]) // Membatasi maksimal 200 data
                        ->orderBy('Log_FoID', 'desc')
                        ->get();

                    // 4. Ambil semua User ID dari data log untuk filter ke DB Pusat
                    $userIds = $dataLog->pluck('Log_FoUserID')->unique()->toArray();

                    // 5. Ambil data dari DB Pusat (Tabel m_user) berdasarkan ID yang ada di log
                    $dataUser = DB::connection('dynamic_conn2')
                        ->table('m_user')
                        ->whereIn('M_UserID', $userIds)
                        ->get();

                    // 6. Proses JOIN Manual (Pencocokan Data) menggunakan helper 'where' agar lebih aman dari beda tipe data
                    $finalResult = $dataLog->map(function ($log) use ($dataUser) {
                        // Cari user yang M_UserID nya sama dengan Log_FoUserID di log
                        $user = $dataUser->where('M_UserID', $log->Log_FoUserID)->first();

                        // Masukkan nama lengkap user ke dalam objek log
                        $log->nama_user = $user ? $user->M_UserFullName : 'User Tidak Ditemukan';
                        $log->username  = $user ? $user->M_UserUsername : '-';

                        return $log;
                    });
                    return view('application.master.master-log.data-log-fo', ['logs' => $finalResult]);
                } elseif ($request->table == 'log_user') {
                    $log = DB::connection('dynamic_conn2')
                        ->table('log_user')
                        ->join('m_user','m_user.M_UserID','=','log_user.Log_UserM_UserID')
                        ->whereBetween('Log_UserDatetime', [$request->start, $request->end]) // Membatasi maksimal 200 data
                        ->orderBy('Log_UserID', 'desc')
                        ->get();
                    return view('application.master.master-log.data-log-user', compact('log'));
                } else {
                    return 'Coming Soon';
                }
            } else {
                return '<div class="alert alert-warning border-2 d-flex align-items-center" role="alert">
                        <div class="bg-warning me-3 icon-item"><span class="fas fa-exclamation-circle text-white fs-3"></span></div>
                        <p class="mb-0 flex-1">Data Koneksi Belum dibuat!</p>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }
}
