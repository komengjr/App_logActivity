<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogPuController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Auth;

Route::get('masteradmin/tiket', ['as' => 'masteradmin/tiket', 'uses' => 'MasterAdminController@datatiketmasteradmin']);
Route::get('masteradmin/tiket/getdataoption/{id}', ['as' => 'masteradmin/tiket/getdataoption', 'uses' => 'MasterAdminController@getdataoptiontiket']);

// VERSI BARU

Route::prefix('app')->group(function () {
    Route::get('dashboard_home', [AppController::class, 'dashboard_home'])->name('dashboard_home');
    Route::post('dashboard_home/update-profile', [AppController::class, 'dashboard_home_update_profile'])->name('dashboard_home_update_profile');
    Route::post('dashboard_home/update-profile/save', [AppController::class, 'dashboard_home_update_profile_save'])->name('dashboard_home_update_profile_save');
    Route::post('dashboard_home/reset-password', [AppController::class, 'dashboard_home_reset_password'])->name('dashboard_home_reset_password');
    Route::post('dashboard_home/reset-password/send-otp', [AppController::class, 'dashboard_home_reset_password_send_otp'])->name('dashboard_home_reset_password_send_otp');
    Route::post('dashboard_home/reset-password/update', [AppController::class, 'dashboard_home_reset_password_update'])->name('dashboard_home_reset_password_update');
    Route::get('dashboard_home/users', [AppController::class, 'dashboard_home_data_users'])->name('dashboard_home_data_users');
    Route::get('dashboard_home/tugas', [AppController::class, 'dashboard_home_data_tugas'])->name('dashboard_home_data_tugas');
    Route::put('dashboard_home/tugas/{id}/status', [AppController::class, 'dashboard_home_data_tugas_status'])->name('dashboard_home_data_tugas_status');
    Route::put('dashboard_home/tugas/{id}/terima', [AppController::class, 'dashboard_home_data_tugas_terima'])->name('dashboard_home_data_tugas_terima');
    Route::put('dashboard_home/tugas/{id}/alihkan', [AppController::class, 'dashboard_home_data_tugas_alihkan'])->name('dashboard_home_data_tugas_alihkan');

    Route::post('get_message', [AppController::class, 'dashboard_get_message'])->name('dashboard_get_message');
    Route::post('get_message/proses', [AppController::class, 'dashboard_get_message_proses'])->name('dashboard_get_message_proses');
    Route::post('get_message/proses_terima', [AppController::class, 'dashboard_get_message_proses_terima'])->name('dashboard_get_message_proses_terima');
    Route::post('get_message/proses_tindakan', [AppController::class, 'dashboard_get_message_proses_tindakan'])->name('dashboard_get_message_proses_tindakan');
    Route::post('get_message/proses_finish', [AppController::class, 'dashboard_get_message_proses_finish'])->name('dashboard_get_message_proses_finish');

    Route::post('check-in/proses-user', [AppController::class, 'dashboard_check_in_proses'])->name('dashboard_check_in_proses');
    Route::post('check-in/proses-user/data-kritis', [AppController::class, 'dashboard_check_in_proses_data_kritis'])->name('dashboard_check_in_proses_data_kritis');
    Route::post('check-in/proses-user/data-harian-import', [AppController::class, 'dashboard_check_in_proses_data_harian_import'])->name('dashboard_check_in_proses_data_harian_import');
    Route::post('check-in/proses-user/data-harian-save', [AppController::class, 'dashboard_check_in_proses_data_harian_save'])->name('dashboard_check_in_proses_data_harian_save');

    Route::post('dashboard/monitoring-harian-kritis', [AppController::class, 'dashboard_monitoring_harian_kritis'])->name('dashboard_monitoring_harian_kritis');
    Route::post('dashboard/monitoring-harian-kritis/backup', [AppController::class, 'dashboard_monitoring_harian_backup_kritis'])->name('dashboard_monitoring_harian_backup_kritis');
    Route::post('dashboard/monitoring-harian/report', [AppController::class, 'dashboard_monitoring_harian_backup_report'])->name('dashboard_monitoring_harian_backup_report');
});
Route::prefix('master-data')->group(function () {
    Route::get('user', [MasterController::class, 'master_user'])->name('master_user');
    Route::post('user-add', [MasterController::class, 'master_user_add'])->name('master_user_add');
    Route::post('user-save', [MasterController::class, 'master_user_save'])->name('master_user_save');

    Route::get('log-login', [MasterController::class, 'master_log_login'])->name('master_log_login');

    Route::get('menu', [MasterController::class, 'master_menu'])->name('master_menu');
    Route::post('menu/add', [MasterController::class, 'master_menu_add'])->name('master_menu_add');
    Route::post('menu/save', [MasterController::class, 'master_menu_save'])->name('master_menu_save');
    Route::post('menu/update', [MasterController::class, 'master_menu_update'])->name('master_menu_update');
    Route::post('menu/update-save', [MasterController::class, 'master_menu_update_save'])->name('master_menu_update_save');
    Route::post('menu/sub-menu-save', [MasterController::class, 'master_sub_menu_save'])->name('master_sub_menu_save');
    Route::get('menu-access', [MasterController::class, 'master_menu_akses'])->name('master_menu_akses');
    Route::post('menu-access/update', [MasterController::class, 'master_menu_akses_update'])->name('master_menu_akses_update');
    Route::post('menu-access/update_save', [MasterController::class, 'master_menu_akses_update_save'])->name('master_menu_akses_update_save');
    Route::post('menu-access/update_sub_save', [MasterController::class, 'master_menu_akses_update_sub_save'])->name('master_menu_akses_update_sub_save');
});
Route::prefix('{akses}')->group(function () {
    Route::get('app/menu/rencana-maintenance', [MenuController::class, 'menu_rencana_maintenance'])->name('menu_rencana_maintenance');
    Route::get('app/menu/proses-maintenance', [MenuController::class, 'menu_proses_maintenance'])->name('menu_proses_maintenance');
    Route::get('app/menu/verifikasi-maintenance', [MenuController::class, 'menu_verifikasi_maintenance'])->name('menu_verifikasi_maintenance');
    Route::get('app/menu/create-task', [MenuController::class, 'menu_create_task'])->name('menu_create_task');

    Route::get('app/laporan/laporan-case', [MenuController::class, 'laporan_kendala_user'])->name('laporan_kendala_user');
    Route::get('app/laporan/laporan-rencana-maintenance', [MenuController::class, 'laporan_rencana_maintenance'])->name('laporan_rencana_maintenance');
    Route::get('app/laporan/laporan-log-bisone', [MenuController::class, 'laporan_log_bisone'])->name('laporan_log_bisone');

    Route::get('app/master/master-piket-setup', [MenuController::class, 'master_piket_setup'])->name('master_piket_setup');
    Route::get('app/master/master-piket-data', [MenuController::class, 'master_piket_data'])->name('master_piket_data');
    Route::get('app/master/master-staff', [MenuController::class, 'master_data_staff'])->name('master_data_staff');
    Route::get('app/master/master-kinerja', [MenuController::class, 'master_data_kinerja'])->name('master_data_kinerja');
    Route::get('app/master/master-cabang', [MenuController::class, 'master_data_cabang'])->name('master_data_cabang');
});
// MENU
Route::prefix('menu')->group(function () {
    Route::post('app/menu/rencana-maintenance/get-data', [MenuController::class, 'menu_rencana_maintenance_get_data'])->name('menu_rencana_maintenance_get_data');
    Route::post('app/menu/rencana-maintenance/save', [MenuController::class, 'menu_rencana_maintenance_save'])->name('menu_rencana_maintenance_save');

    Route::get('app/menu/proses-maintenance/bulan', [MenuController::class, 'menu_proses_maintenance_get_bulan'])->name('menu_proses_maintenance_get_bulan');
    Route::get('app/menu/proses-maintenance/barang', [MenuController::class, 'menu_proses_maintenance_get_barang'])->name('menu_proses_maintenance_get_barang');
    Route::post('app/menu/proses-maintenance/simpan', [MenuController::class, 'menu_proses_maintenance_save'])->name('menu_proses_maintenance_save');

    Route::get('app/menu/create-task/users', [MenuController::class, 'menu_create_task_get_user'])->name('menu_create_task_get_user');
    Route::get('app/menu/create-task/tugas', [MenuController::class, 'menu_create_task_get_tugas'])->name('menu_create_task_get_tugas');
    Route::put('app/menu/create-task/tugas/{id}/status', [MenuController::class, 'menu_create_task_get_tugas_status'])->name('menu_create_task_get_tugas_status');


    Route::post('app/master/master-piket-setup/save', [MenuController::class, 'master_piket_setup_save'])->name('master_piket_setup_save');

    Route::get('app/master/master-piket-data/{bulan}', [MenuController::class, 'master_piket_data_bulan'])->name('master_piket_data_bulan');
    Route::post('app/master/master-piket-data-update/save', [MenuController::class, 'master_piket_data_bulan_update'])->name('master_piket_data_bulan_update');

    Route::post('app/master/master-cabang/update', [MenuController::class, 'master_data_cabang_update'])->name('master_data_cabang_update');
    Route::post('app/master/master-cabang/update-save', [MenuController::class, 'master_data_cabang_update_save'])->name('master_data_cabang_update_save');
    Route::post('app/master/master-cabang/add-petugas', [MenuController::class, 'master_data_cabang_add_petugas'])->name('master_data_cabang_add_petugas');
    Route::post('app/master/master-cabang/save-petugas', [MenuController::class, 'master_data_cabang_save_petugas'])->name('master_data_cabang_save_petugas');

    Route::post('app/laporan/laporan-case/detail', [MenuController::class, 'laporan_kendala_user_detail'])->name('laporan_kendala_user_detail');

    Route::post('app/laporan/laporan-rencana-maintenance/detail', [MenuController::class, 'laporan_rencana_maintenance_detail'])->name('laporan_rencana_maintenance_detail');
    Route::post('app/laporan/laporan-rencana-maintenance/cetak-rencana', [MenuController::class, 'laporan_rencana_maintenance_cetak_rencana'])->name('laporan_rencana_maintenance_cetak_rencana');
    Route::post('app/laporan/laporan-rencana-maintenance/cetak-rencana-report', [MenuController::class, 'laporan_rencana_maintenance_cetak_rencana_report'])->name('laporan_rencana_maintenance_cetak_rencana_report');
    Route::post('app/laporan/laporan-rencana-maintenance/cetak', [MenuController::class, 'laporan_rencana_maintenance_cetak'])->name('laporan_rencana_maintenance_cetak');
    Route::post('app/laporan/laporan-rencana-maintenance/cetak-report', [MenuController::class, 'laporan_rencana_maintenance_cetak_report'])->name('laporan_rencana_maintenance_cetak_report');

    Route::post('app/laporan/laporan-log-bisone/print', [MenuController::class, 'laporan_log_bisone_print'])->name('laporan_log_bisone_print');
    Route::post('app/laporan/laporan-log-bisone/print-report', [MenuController::class, 'laporan_log_bisone_print_report'])->name('laporan_log_bisone_print_report');
});


// Master Admin GET
Route::get('masteradmin/datauser', ['as' => 'master/datauser', 'uses' => 'MasterAdminController@datauser']);
Route::get('masteradmin/datauser/tambah', ['as' => 'masteradmin/datauser/tambah', 'uses' => 'MasterAdminController@datausertambah']);
Route::get('masteradmin/datauser/edit/{id}', ['as' => 'masteradmin/datauser/edit', 'uses' => 'MasterAdminController@datauseredit']);

Route::get('masteradmin/datacabang', ['as' => 'master/datacabang', 'uses' => 'MasterAdminController@datacabang']);
Route::get('masteradmin/datacabang/detail/{id}', ['as' => 'master/datacabang/detail', 'uses' => 'MasterAdminController@datacabangdetail']);
Route::get('masteradmin/datacabang/tambah', ['as' => 'masteradmin/datacabang/tambah', 'uses' => 'MasterAdminController@datacabangtambah']);

Route::get('masteradmin/datagroup', ['as' => 'master/datagroup', 'uses' => 'MasterAdminController@datagroup']);
Route::get('masteradmin/datagroup/tambah', ['as' => 'masteradmin/datagroup/tambah', 'uses' => 'MasterAdminController@datagrouptambah']);
Route::get('masteradmin/datagroup/show/{id}', ['as' => 'masteradmin/datagroup/show', 'uses' => 'MasterAdminController@datagroupshow']);
Route::get('masteradmin/datagroup/tambah/cabang/{id}', ['as' => 'masteradmin/datagroup/tambah/cabang', 'uses' => 'MasterAdminController@datagrouptambahcabang']);
Route::get('masteradmin/datagroup/tambah/user/{id}', ['as' => 'masteradmin/datagroup/tambah/user', 'uses' => 'MasterAdminController@datagrouptambahuser']);

Route::get('masteradmin/datatask', ['as' => 'masteradmin/datatask', 'uses' => 'MasterAdminController@datatask']);
Route::get('masteradmin/datatask/showdata/{id}', ['as' => 'masteradmin/datatask/showdata', 'uses' => 'MasterAdminController@showdattask']);

Route::get('masteradmin/dataworklist', ['as' => 'masteradmin/dataworklist', 'uses' => 'MasterAdminController@dataworklist']);
Route::get('masteradmin/dataworklist/tambah', ['as' => 'masteradmin/dataworklist/tambah', 'uses' => 'MasterAdminController@dataworklisttambah']);
Route::get('masteradmin/dataworklist/edit/{id}', ['as' => 'masteradmin/dataworklist/edit', 'uses' => 'MasterAdminController@dataworklistedit']);

Route::get('masteradmin/datagroupworklist', ['as' => 'masteradmin/datagroupworklist', 'uses' => 'MasterAdminController@dataworklistgroup']);
Route::get('masteradmin/datagroupworklist/tambah', ['as' => 'masteradmin/datagroupworklist/tambah', 'uses' => 'MasterAdminController@dataworklistgrouptambah']);
Route::get('masteradmin/datagroupworklist/edit/{id}', ['as' => 'masteradmin/datagroupworklist/edit', 'uses' => 'MasterAdminController@dataworklistgroupedit']);

Route::get('masteradmin/datapersonworklist', ['as' => 'masteradmin/datapersonworklist', 'uses' => 'MasterAdminController@datapersonworklist']);
Route::get('masteradmin/datapersonworklist/tambah', ['as' => 'masteradmin/datapersonworklist/tambah', 'uses' => 'MasterAdminController@datapersonworklisttambah']);
Route::get('masteradmin/datapersonworklist/edit/{id}', ['as' => 'masteradmin/datapersonworklist/edit', 'uses' => 'MasterAdminController@datapersonworklistedit']);

Route::get('masteradmin/datatypeworklist', ['as' => 'masteradmin/datatypeworklist', 'uses' => 'MasterAdminController@datatypeworklist']);
Route::get('masteradmin/datatypeworklist/tambah', ['as' => 'masteradmin/datatypeworklist/tambah', 'uses' => 'MasterAdminController@datatypeworklisttambah']);

Route::get('masteradmin/datatiketgroupworklist', ['as' => 'masteradmin/datatiketgroupworklist', 'uses' => 'MasterAdminController@datatiketgroupworklist']);
Route::get('masteradmin/datatiketpersonalworklist', ['as' => 'masteradmin/datatiketpersonalworklist', 'uses' => 'MasterAdminController@datatiketpersonalworklist']);
Route::get('masteradmin/datatiketlaporan', ['as' => 'masteradmin/datatiketlaporan', 'uses' => 'MasterAdminController@datatiketlaporan']);
// Route::get('masteradmin/datamaps',['as'=>'masteradmin/datamaps','uses'=> 'MasterAdminController@datamaps']);

// Master Admin POST
Route::post('masteradmin/buattiket/personal', ['as' => 'masteradmin/buattiket/personal', 'uses' => 'MasterAdminController@buattiketpersonal']);
Route::post('masteradmin/buattiket/group', ['as' => 'masteradmin/buattiket/group', 'uses' => 'MasterAdminController@buattiketgroupl']);
Route::post('masteradmin/datauser/post/tambah', ['as' => 'masteradmin/datauser/post/tambah', 'uses' => 'MasterAdminController@datausertambahpost']);
Route::post('masteradmin/datauser/post/edit', ['as' => 'masteradmin/datauser/post/edit', 'uses' => 'MasterAdminController@datausereditpost']);

Route::post('masteradmin/datacabang/postdata/tambah', ['as' => 'masteradmin/datacabang/postdata/tambah', 'uses' => 'MasterAdminController@datacabangtambahpost']);

Route::post('masteradmin/datagroup/postdata/tambah', ['as' => 'masteradmin/datagroup/postdata/tambah', 'uses' => 'MasterAdminController@datagrouptambahpost']);
Route::post('masteradmin/datagroup/post/tambah/cabangbaru', ['as' => 'masteradmin/datagroup/post/tambah/cabangbaru', 'uses' => 'MasterAdminController@datagrouptambahpostcabangbaru']);
Route::post('masteradmin/datagroup/post/tambah/userbaru', ['as' => 'masteradmin/datagroup/post/tambah/userbaru', 'uses' => 'MasterAdminController@datagrouptambahpostuserbaru']);

Route::post('masteradmin/dataworklist/postdata/tambah', ['as' => 'masteradmin/dataworklist/postdata/tambah', 'uses' => 'MasterAdminController@dataworklisttambahpost']);
Route::post('masteradmin/dataworklist/postdata/edit', ['as' => 'masteradmin/dataworklist/postdata/edit', 'uses' => 'MasterAdminController@dataworklisteditpost']);
Route::post('masteradmin/dataworklist/postdata/hapus', ['as' => 'masteradmin/dataworklist/postdata/hapus', 'uses' => 'MasterAdminController@dataworklisthapuspost']);

Route::post('masteradmin/datagroupworklist/postdata/tambah', ['as' => 'masteradmin/datagroupworklist/postdata/tambah', 'uses' => 'MasterAdminController@datagroupworklisttambahpost']);
Route::post('masteradmin/datagroupworklist/postdata/edit', ['as' => 'masteradmin/datagroupworklist/postdata/edit', 'uses' => 'MasterAdminController@datagroupworklisteditpost']);
Route::post('masteradmin/datagroupworklist/postdata/hapus', ['as' => 'masteradmin/datagroupworklist/postdata/hapus', 'uses' => 'MasterAdminController@datagroupworklisthapuspost']);

Route::post('masteradmin/datapersonworklist/postdata/tambah', ['as' => 'masteradmin/datapersonworklist/postdata/tambah', 'uses' => 'MasterAdminController@datapersonworklisttambahpost']);
Route::post('masteradmin/datapersonworklist/postdata/edit', ['as' => 'masteradmin/datapersonworklist/postdata/edit', 'uses' => 'MasterAdminController@datapersonworklisteditpost']);
Route::post('masteradmin/datapersonworklist/postdata/hapus', ['as' => 'masteradmin/datapersonworklist/postdata/hapus', 'uses' => 'MasterAdminController@datapersonworklisthapuspost']);

Route::post('masteradmin/datatypeworklist/postdata/tambah', ['as' => 'masteradmin/datatypeworklist/postdata/tambah', 'uses' => 'MasterAdminController@datatypeworklisttambahpost']);

// ADMIN ROUTE

Route::get('schedule', ['as' => 'schedule', 'uses' => 'AdminController@schedule']);
Route::get('cabang', ['as' => 'piket', 'uses' => 'AdminController@piket']);

Route::get('admin/dashboard/viewdata', ['as' => 'admin/dashboard/viewdata', 'uses' => 'AdminController@dashboardviewdata']);
Route::post('postadmin/dashboard/monitoringdata', ['as' => 'postadmin/dashboard/monitoringdata', 'uses' => 'AdminController@monitoringdatauser']);

Route::get('admin/data/cabang/menuhandle/{id}', ['as' => 'admin/data/cabang/menuhandle/', 'uses' => 'AdminController@datahandlecabang']);
Route::get('admin/data/cabang/menuhandle/tambahdata/{id}', ['as' => 'admin/data/cabang/menuhandle/tambahdata/', 'uses' => 'AdminController@tambahdatauserhandlecabang']);
Route::get('admin/tablepiket/{id}', 'AdminController@tablepiket')->name('admin.jadwalpiket');
Route::get('schedule/datacalender/{id}', ['as' => 'schedule/datacalender', 'uses' => 'AdminController@datacalender']);
Route::get('admin/datauser/tambah', ['as' => 'admin/dataworklist/tambah', 'uses' => 'AdminController@tambahdatauseradmin']);
Route::get('admin/dataperiode/tambah', ['as' => 'admin/dataperiode/tambah', 'uses' => 'AdminController@tambahdataperiodeadmin']);
Route::get('admin/data/datauseradmin', ['as' => 'admin/data/datauseradmin', 'uses' => 'AdminController@datauseradmin']);
Route::get('admin/data/user/nonaktif/{id}', ['as' => 'admin/data/user/nonaktif', 'uses' => 'AdminController@nonaktifdatauseradmin']);
Route::get('admin/data/user/aktif/{id}', ['as' => 'admin/data/user/aktif', 'uses' => 'AdminController@aktifdatauseradmin']);
Route::get('admin/user/data/detail/{id}', ['as' => 'admin/user/data/detail', 'uses' => 'AdminController@datadetailuseradmin']);
Route::get('admin/dataworklist/tiketbaru', ['as' => 'admin/dataworklist/tiketbaru', 'uses' => 'AdminController@buattiketbaru']);
Route::get('admin/tiket/getdataoptionkinerja/{id}', ['as' => 'admin/tiket/getdataoptionkinerja', 'uses' => 'AdminController@getdataoptionkinerja']);
Route::get('admin/tiket/getdataoptionkinerjax/{id}', ['as' => 'admin/tiket/getdataoptionkinerjax', 'uses' => 'AdminController@getdataoptionkinerjax']);

Route::get('admin/data/tugasschedule', ['as' => 'admin/data/tugasharian', 'uses' => 'AdminController@datatugasjadwal']);
Route::get('admin/data/tugasuserlainnya', ['as' => 'admin/data/tugasuserlainnya', 'uses' => 'AdminController@tugasuserlainnya']);
Route::get('admin/data/tugasuserbelum', ['as' => 'admin/data/tugasuserbelum', 'uses' => 'AdminController@tugasuserbelum']);
Route::get('admin/data/dataperiode', ['as' => 'admin/data/dataperiode', 'uses' => 'AdminController@dataperiode']);
Route::get('admin/data/datacabang', ['as' => 'admin/data/datacabang', 'uses' => 'AdminController@datacabang']);
Route::get('admin/data/datacabang/tambah', ['as' => 'admin/data/datacabang/tambah', 'uses' => 'AdminController@tambahdatacabang']);
Route::get('admin/data/datacabang/tambah/{id}', ['as' => 'admin/data/datacabang/tambahid', 'uses' => 'AdminController@tambahdataverifikatorcabang']);
Route::get('admin/data/datahendlecabang/tambah/{id}', ['as' => 'admin/data/datahendlecabang/tambah/', 'uses' => 'AdminController@tambahdatahendlecabang']);
Route::get('admin/data/datagroup', ['as' => 'admin/data/datagroup', 'uses' => 'AdminController@datagroup']);
Route::get('admin/data/showtiketadmin/{id}', ['as' => 'admin/data/showtiketadmin', 'uses' => 'AdminController@showtiketadmin']);
Route::get('admin/data/edittiketadmin/{id}', ['as' => 'admin/data/edittiketadmin', 'uses' => 'AdminController@edittiketadmin']);
Route::get('admin/maps/data/cabang/{id}', ['as' => 'admin/maps/data/cabang', 'uses' => 'AdminController@datamapscabang']);
Route::get('admin/tiket/data/tambah', ['as' => 'admin/tiket/data/tambah', 'uses' => 'AdminController@inputtiketbaru']);
Route::get('admin/tiket/getdataoption/{id}', ['as' => 'admin/tiket/getdataoption', 'uses' => 'AdminController@getdataoptiontiket']);
Route::get('admin/datagroup/tambahuser/{id}', ['as' => 'admin/datagroup/tambahuser', 'uses' => 'AdminController@tambahusergroup']);
Route::get('admin/datagroup/tambahcabang/{id}', ['as' => 'admin/datagroup/tambahcabang', 'uses' => 'AdminController@tambahcabanggroup']);
Route::get('admin/schedule/show/on/{id}', 'AdminController@showdataschedule');
Route::get('admin/datagroup/tambah', ['as' => 'admin/datagroup/tambah', 'uses' => 'AdminController@tambahgroupbaru']);
Route::get('admin/datatask/user/pengerjaan/{id}', ['as' => 'admin/datatask/user/pengerjaan', 'uses' => 'AdminController@datataskpengerjaanuser']);
Route::get('admin/datatask/user/pengerjaan/showdata/{id}/{kd}', ['as' => 'admin/datatask/user/pengerjaan/showdata', 'uses' => 'AdminController@datataskshowdatauser']);


Route::post('admin/buattiket/personal', ['as' => 'radmin/buattiket/personal', 'uses' => 'AdminController@buattiketpersonal']);
Route::post('admin/buattiket/group', ['as' => 'admin/buattiket/group', 'uses' => 'AdminController@buattiketgroupl']);

Route::post('admin/buattiket/laporan', ['as' => 'admin/buattiket/laporan', 'uses' => 'AdminController@buattiketlaporan']);

Route::post('admin/buatjadwal/user', ['as' => 'admin/buatjadwal/user', 'uses' => 'AdminController@ajaxRequestPost']);
Route::post('admin/user/tambahuser', 'AdminController@tambahuserbaru');
Route::post('admin/periode/tambahperiode', 'AdminController@tambahperiodebaru');
Route::post('admin/datagroup/tambahusergroup', 'AdminController@tambahusergroupbaru');
Route::post('admin/datagroup/tambahcabanggroup', 'AdminController@tambahcabanggroupbaru');
Route::post('admin/group/tambahgroup', 'AdminController@posttambahgroupbaru');
Route::post('admin/data/datacabang/tambahverifikator', 'AdminController@tambahuserverifikator');
Route::post('admin/data/datacabang/tambahhendlecabang', 'AdminController@tambahhendlecabang');
Route::post('admin/data/cabang/menuhandle/posttambahdata', 'AdminController@posttambahuserbackuphandle');


Route::get('taskorder', ['as' => 'taskorder', 'uses' => 'AdminController@taskorder']);
Route::post('taskorder/postmonitoringharian', 'AdminController@postmonitoringharian');

Auth::routes();
Route::post('verifikasi-Login', 'Auth\LoginController@verifikasi_Login')->name('verifikasi_Login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout_fix');
// Route::controller(LoginController::class)->group(function () {
//     Route::post('verifikasi-Login', 'verifikasi_Login')->name('verifikasi_Login');
//     Route::get('logout', 'logout')->name('logout');
// });
// Route::get('datamaps', function () {
//     return view('maps');
// });
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/inputdatatiket', 'HomeController@inputdatatiketpersonal');
Route::post('/user/inputdatatiketgroup', 'HomeController@inputdatatiketgroup');
Route::get('/', 'HomeController@index');
Route::get('/newcase', 'PublicController@newcase')->name('newcase_create');
Route::get('/cek-status-laporan', 'PublicController@cek_status_laporan')->name('cek-status-laporan');
Route::get('/caricabang/{id}', 'PublicController@caricabang');
Route::get('/caridatatiket/{id}', 'PublicController@caridatatiket');
Route::get('/pilihcabang/{id}', 'PublicController@pilihcabang');
Route::post('/simpan-newcase', 'PublicController@postnewcase');


Route::post('/ubahpassword', ['as' => 'all', 'uses' => 'HomeController@ubahpassword']);
Route::post('/update-biodata', ['as' => 'update-biodata', 'uses' => 'HomeController@update_biodata']);
Route::post('/user/laporan/posttambah', ['as' => 'posttambahlaporan', 'uses' => 'UserController@posttambahlaporan']);
Route::post('user/datalaporan/penyelesaian', ['as' => 'user/datalaporan/penyelesaian', 'uses' => 'UserController@postpenyelesaianlaporan']);
Route::get('user/lihattiket/{id}', ['as' => 'user1', 'uses' => 'UserController@lihattiketpersonal']);
Route::get('user/group/lihattiket/{id}', ['as' => 'user12', 'uses' => 'UserController@lihattiketgroup']);
Route::get('user/lihattugas', ['as' => 'user2', 'uses' => 'UserController@lihattugaspersonal']);
Route::get('user/laporan/tambah', ['as' => 'user3', 'uses' => 'UserController@laporantambah']);
Route::get('user/laporan/lihatdatalaporan/{id}', ['as' => 'user/laporan/lihatdatalaporan', 'uses' => 'UserController@lihatdatalaporan']);
Route::get('user/laporan/lihatlaporan/{id}', ['as' => 'user/laporan/lihatlaporan', 'uses' => 'UserController@lihatlaporan']);
Route::get('user/notifikasi/lihatnotif/{id}', ['as' => 'user/notifikasi/lihatnotif', 'uses' => 'UserController@lihatnotifikasi']);
Route::get('user/task/kinerja/{id}', ['as' => 'user/task/kinerja', 'uses' => 'UserController@lihattaskkinerja']);
Route::get('user/task/kinerja-admin/{id}', ['as' => 'user/task/kinerja-admin', 'uses' => 'UserController@lihattaskkinerjaadmin']);
Route::get('user/notifikasi/lihatnotifwaktu/', ['as' => 'user/notifikasi/lihatnotifwaktu', 'uses' => 'UserController@lihatnotifikasiwaktu']);
Route::get('user/userleader/modal/beritugas', ['as' => 'user/userleader/modal/beritugas', 'uses' => 'UserController@beritugasuser']);
Route::get('user/userleader/modal/lihattugas', ['as' => 'user/userleader/modal/lihattugas', 'uses' => 'UserController@lihattugasuser']);
Route::get('user/userleader/modal/periodekpi', ['as' => 'user/userleader/modal/periodekpi', 'uses' => 'UserController@periodekpi']);
Route::get('user/userleader/modal/printlaporan', ['as' => 'user/userleader/modal/printlaporan', 'uses' => 'UserController@printlaporanuser']);
Route::get('user/userleader/table/laporandatakinerja/{id}', ['as' => 'user/userleader/table/laporandatakinerja/', 'uses' => 'UserController@laporandatakinerja']);
Route::get('user/userleader/table/detailtask/{id}', ['as' => 'user/userleader/table/detailtask', 'uses' => 'UserController@detaildatatask']);
Route::post('user/userleader/table/detailtask/penilaian', 'UserController@penilaiantask');

Route::get('user/user/task/kerjakan/{id}', ['as' => 'user/user/task/kerjakan', 'uses' => 'UserController@kerjakandatatask']);
Route::get('user/user/handledatacabang', ['as' => 'user/user/handledatacabang/', 'uses' => 'UserController@hendledatacabang']);
Route::get('user/user/handledatacabang/task/{id}', ['as' => 'user/user/handledatacabang/task', 'uses' => 'UserController@taskharianhendledatacabang']);
// Maintenance Bulanan
Route::get('user/user/handledatacabang/taskbulanan/{id}', ['as' => 'user/user/handledatacabang/taskbulanan', 'uses' => 'UserController@taskbulananhendledatacabang']);
Route::get('user/user/handledatacabang/taskbulanan/cetak-rencana/{id}', ['as' => 'user/user/handledatacabang/taskbulanan/cetak-rencana', 'uses' => 'UserController@cetakrencanataskbulananhendledatacabang']);
Route::get('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/{id}', ['as' => 'user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/', 'uses' => 'UserController@tambahmaintenancebulananhendledatacabang']);
Route::post('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan', ['as' => 'user/user/handledatacabang/taskbulanan/post-tambah-maintenance-bulanan/', 'uses' => 'UserController@posttambahmaintenancebulananhendledatacabang']);
Route::get('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/{id}', ['as' => 'user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail', 'uses' => 'UserController@detailmaintenancebulananhendledatacabang']);
Route::get('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/tambah-perangkat/{id}', ['as' => 'user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/tambah-perangkat', 'uses' => 'UserController@tambahdetailmaintenancebulananhendledatacabang']);
Route::post('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail-cari/cari-perangkat', ['as' => 'user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/cari-perangkat', 'uses' => 'UserController@caridetailmaintenancebulananhendledatacabang']);
Route::post('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/pilih-perangkat', ['as' => 'user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/pilih-perangkat', 'uses' => 'UserController@pilihdetailmaintenancebulananhendledatacabang']);
Route::post('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/pilih-perangkat/simpan', ['as' => 'user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/pilih-perangkat/simpan', 'uses' => 'UserController@simpanpilihdetailmaintenancebulananhendledatacabang']);
Route::get('user/user/handledatacabang/taskbulanan/maintenance-bulanan/detail/perangkat/{id}/{kode}', ['as' => 'user/user/handledatacabang/taskbulanan/maintenance-bulanan/detail/perangkat', 'uses' => 'UserController@maintenanceperangkatdetail']);
Route::post('user/user/handledatacabang/taskbulanan/maintenance-bulanan/simpan-detail/perangkat', ['as' => 'user/user/handledatacabang/taskbulanan/maintenance-bulanan/simpan-detail/perangkat', 'uses' => 'UserController@maintenanceperangkatsimpandatadetail']);
Route::post('user/user/handledatacabang/taskbulanan/maintenance-bulanan/simpan-detail/verif-perangkat', ['as' => 'user/user/handledatacabang/taskbulanan/maintenance-bulanan/simpan-detail/verif-perangkat', 'uses' => 'UserController@maintenanceverifperangkatsimpandatadetail']);

Route::get('user/user/handledatacabang/customtask/{id}', ['as' => 'user/user/handledatacabang/customtask/', 'uses' => 'UserController@customtaskhendledatacabang']);
Route::get('user/user/handlecabang/customtask/lengkapidata/{id}', ['as' => 'user/user/handledatacabang/customtask/lengkapidata/', 'uses' => 'UserController@lengkapicustomtaskhendledatacabang']);
Route::post('user/user/handlecabang/customtask/lengkapisubdata/{id}', ['as' => 'user/user/handledatacabang/customtask/lengkapisubdata/', 'uses' => 'UserController@lengkapisubcustomtaskhendledatacabang']);
Route::post('user/user/handlecabang/customtask/new-data', ['as' => 'user/user/handledatacabang/customtask/new-data/', 'uses' => 'UserController@tambahcustomtaskhendledatacabang']);
Route::post('user/user/handlecabang/customtask/new-data/simpan', ['as' => 'user/user/handledatacabang/customtask/new-data/simpan', 'uses' => 'UserController@simpantambahcustomtaskhendledatacabang']);
Route::post('user/user/handlecabang/customtasksub/new-data/simpan', ['as' => 'user/user/handledatacabang/customtasksub/new-data/simpan', 'uses' => 'UserController@simpantambahcustomtasksubhendledatacabang']);
Route::post('user/user/handlecabang/formcustomtasksub/caridatainventaris', ['as' => 'caridatainventaris-formcustomtasksub', 'uses' => 'UserController@caridatainventaris_formcustomtasksub']);
Route::post('user/user/handlecabang/formcustomtasksub/pilihdatainventaris', ['as' => 'pilihdatainventaris-formcustomtasksub', 'uses' => 'UserController@pilihdatainventaris_formcustomtasksub']);
Route::post('user/user/handlecabang/formcustomtasksub/pilihdatainventaris/simpandata', ['as' => 'simpandata-pilihdatainventaris-formcustomtasksub', 'uses' => 'UserController@simpandata_pilihdatainventaris_formcustomtasksub']);
Route::get('user/user/handlecabang/respon-laporan-user/{id}', ['as' => 'user/user/handlecabang/respon-laporan-user/', 'uses' => 'UserController@respondatalaporanuser']);
// Route::get('user/userleader/modal/postprintlaporan/{id}',['as'=>'user/userleader/modal/postprintlaporan/id','uses'=> 'UserController@postprintlaporanid']);
Route::post('user/userleader/modalreport/postprintlaporan', ['as' => 'user/userleader/modalreport/postprintlaporan', 'uses' => 'UserController@postprintlaporan']);
// Route::post('user/userleader/modalreport/postprintlaporan', 'UserController@postprintlaporan');
Route::post('user/user/handledatacabang/postrecorddata', 'UserController@posthendlecabang');
Route::post('user/user/handledatacabang/postrecorddatabackup', 'UserController@posthendlecabangbackupharian');
Route::post('user/user/handledatacabang/postrecorddatabackupbulanan', 'UserController@posthendlecabangbackupbulanan');
Route::post('user/user/tiket/posttask', 'UserController@posttaskuser');

Route::post('user/lengkapi/data', 'UserController@lengkapidatabiodata');
Route::post('user/userleader/postschedule', 'UserController@postschedule');
Route::post('user/userleader/postscheduleadmin', 'UserController@postscheduleadmin');
Route::post('user/userleader/buattikettask', 'UserController@buattikettask');
Route::post('user/userleader/pdf/kpi', 'PdfController@printkpi');

// MASTER DATA
Route::get('master-data-user', ['as' => 'master-data-hardware', 'uses' => 'MasterUserController@masterdatahardware']);
Route::post('master-data-user/laporan/detail', ['as' => 'master-data-user/laporan/detail', 'uses' => 'MasterUserController@masterdatalaporandetail']);
Route::post('master-data-user/laporan/monitoring/harian', ['as' => 'master-data-user/laporan/monitoring/harian', 'uses' => 'MasterUserController@masterdatalaporanharian']);
Route::post('master-data-user/laporan/monitoring/harian/preview', ['as' => 'master-data-user/laporan/monitoring/harian/preview', 'uses' => 'MasterUserController@masterpreviewmonitoringharian']);
Route::post('master-data-user/laporan/monitoring/harian/previewbackupharian', ['as' => 'master-data-user/laporan/monitoring/harian/previewbackupharian', 'uses' => 'MasterUserController@masterpreviewbackupharianmonitoringharian']);
Route::post('master-data-user/laporan/monitoring/harian/previewbackupbulanan', ['as' => 'master-data-user/laporan/monitoring/harian/previewbackupbulanan', 'uses' => 'MasterUserController@masterpreviewbackupharianmonitoringbulanan']);
Route::post('master-data-user/laporan/monitoring/kerusakan', ['as' => 'master-data-user/laporan/monitoring/kerusakan', 'uses' => 'MasterUserController@masterdatalaporankerusakan']);
Route::post('master-data-user/laporan/monitoring/laporan/kerusakan', ['as' => 'master-data-user/laporan/monitoring/laporan/kerusakan', 'uses' => 'MasterUserController@masterpreviewdatalaporankerusakan']);

Route::post('master-data-user/laporan/monitoring/backup-bulanan', ['as' => 'laporan_monitoring_backup-bulanan', 'uses' => 'MasterUserController@masterdatalaporanbackupbulanan']);

Route::post('master-data-user/laporan/rencana/maintenance', ['as' => 'master-data-user/laporan/rencana/maintenance', 'uses' => 'MasterUserController@masterdatalaporanrencanamaintenance']);

Route::get('master-data-kinerja', ['as' => 'master-data-kinerja', 'uses' => 'AdminController@masterdatakinerja']);
Route::post('master-data-kinerja/detaildata', ['as' => 'master-data-kinerja-detail-data', 'uses' => 'AdminController@masterdatakinerjadetail']);
Route::post('master-data-kinerja/simpandetaildata', ['as' => 'simpan-master-data-kinerja-detail-data', 'uses' => 'AdminController@tambahmasterdatakinerjadetail']);
Route::post('master-data-kinerja/detaildata/form', ['as' => 'master-data-kinerja-detail-data-form', 'uses' => 'AdminController@masterdatakinerjadetailform']);
Route::post('master-data-kinerja/detaildata/fieldform', ['as' => 'master-data-kinerja-detail-data-fieldform', 'uses' => 'AdminController@masterdatakinerjadetailfieldform']);
// VERIFIKATOR
Route::get('verifikator/datatask/user/pengerjaan/{id}', ['as' => 'verifikator/datatask/user/pengerjaan', 'uses' => 'VerifikatorController@datatask']);
Route::get('verifikator/datatask/tambahorder', ['as' => 'verifikator/datatask/tambahorder', 'uses' => 'VerifikatorController@tambahordertask']);
Route::get('verifikator/datagraphic/task', ['as' => 'verifikator/datagraphic/task', 'uses' => 'VerifikatorController@datagraphic']);
Route::get('verifikator/data-laporan/detail/{id}', ['as' => 'verifikator/data-laporan/detail/', 'uses' => 'VerifikatorController@detaillaporankerusakan']);
Route::post('postverifikator/datagraphic/posttask', ['as' => 'postverifikator/datagraphic/posttask', 'uses' => 'VerifikatorController@datapostgraphic']);
Route::post('postverifikator/datagraphic/postviewtask', ['as' => 'postverifikator/datagraphic/postviewtask', 'uses' => 'VerifikatorController@postdataviewtaskgraphic']);
Route::post('verifikator/datatask/user/pdf', 'PdfController@printdataverif');
Route::post('verifikator/datatask/user/verif', 'VerifikatorController@verifdatauser');
Route::post('verifikator/datatask/user/unverif', 'VerifikatorController@unverifdatauser');
Route::post('verifikator/datatask/tambahorder', 'VerifikatorController@posttambahorder');

// Route::post('ajaxRequest', [AdminController::class, 'ajaxRequestPost'])->name('ajaxRequest.post');
// Route::get('data_peserta','AdminController@data_peserta');
Route::get('log-eror-it', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
// Route::get('log-telegram-it', [\app\Http\Controllers\ApiController::class, 'log_telegram']);

Route::get('/log-telegram-it', 'ApiController@log_telegram')->name('log_telegram');
Route::get('/database2', 'Database2Controller@show')->name('showdatabase');


// Monitoring Gateway
Route::get('admin/gateway/telegram', 'GatewatyController@telegram')->name('gateway-telegram');
Route::get('admin/gateway/telegram/no-telegram', 'GatewatyController@no_telegram')->name('no-gateway-telegram');
Route::get('admin/gateway/telegram/log-telegram', 'GatewatyController@log_telegram')->name('log-gateway-telegram');
Route::get('admin/gateway/telegram/all-laporan-telegram', 'GatewatyController@all_laporan_telegram')->name('all-laporan-gateway-telegram');
Route::get('admin/gateway/telegram/edit-log-telegram/{id}', 'GatewatyController@edit_log_telegram')->name('edit-gateway-telegram');
Route::post('admin/gateway/telegram/edit-log-telegram/postdata', 'GatewatyController@post_edit_log_telegram')->name('post-edit-gateway-telegram');
Route::get('admin/gateway/telegram/detail-log-telegram/{id}', 'GatewatyController@detail_log_telegram')->name('detail-gateway-telegram');
Route::post('admin/gateway/telegram/kirim-log-telegram/', 'GatewatyController@kirim_log_telegram')->name('kirim-gateway-telegram');

Route::get('admin/monitoring/log_bisone', 'GatewatyController@monitoring_log')->name('monitoring-log-bisone');
Route::post('admin/monitoring/log_bisone', 'GatewatyController@cetak_monitoring_log')->name('show-menu-cetak-log');
Route::post('admin/monitoring/log_bisone_cetak', 'GatewatyController@post_cetak_monitoring_log')->name('post-menu-cetak-log');


Route::prefix('logpu')->group(function () {
    Route::get('monitoring-mobil',  'LogPuController@logpu');
});
Route::prefix('admin/menu')->group(function () {
    Route::get('piket',  'PiketController@index');
    Route::get('piket/detail/{id}',  'PiketController@detailpiket');
    Route::get('piket/modaldetail/{id}',  'PiketController@modaldetailpiket');
    Route::get('form-piket/{id}',  'PiketController@formpiket');
    Route::get('form-piket/option/{id}',  'PiketController@optioanwilayah');
    Route::post('form-piket/savedata/jadwal',  'PiketController@simpanjadwalpiket')->name('simpanjadwalpiketnasional');
    Route::post('form-piket/savedata/jadwal-individu',  'PiketController@simpanjadwalpiketindividu')->name('simpanjadwalpiketnasionalindividu');
    Route::get('form-piket/removedata/jadwal-individu/{id}',  'PiketController@removejadwalpiketindividu')->name('removejadwalpiketnasionalindividu');
});

Route::prefix('/piket')->group(function () {
    Route::get('user', [PublicController::class, 'piket_user'])->name('piket_user');
    Route::post('user-detail', [PublicController::class, 'piket_user_detail'])->name('piket_user_detail');
    // Route::get('menu-notif', [PublicController::class, 'list_menu_notif'])->name('list_menu_notif');
    // Route::get('menu/cart', [PublicController::class, 'list_menu_cart'])->name('list_menu_cart');
    // Route::post('menu/chosse_category', [PublicController::class, 'menu_chosse_category'])->name('menu_chosse_category');
    // Route::post('menu/detail-product', [PublicController::class, 'menu_detail_product'])->name('menu_detail_product');
    // Route::post('menu/add-cart', [PublicController::class, 'menu_add_cart'])->name('menu_add_cart');
    // Route::post('menu/remove-cart', [PublicController::class, 'menu_remove_cart'])->name('menu_remove_cart');
    // Route::post('menu/choose-table', [PublicController::class, 'menu_choosee_table_cart'])->name('menu_choosee_table_cart');
    // Route::post('menu/order-type-cart', [PublicController::class, 'menu_tipe_order_cart'])->name('menu_tipe_order_cart');
    // Route::post('menu/add-cart-product', [PublicController::class, 'menu_add_cart_product_user'])->name('menu_add_cart_product_user');
    // Route::get('brand', [PublicController::class, 'brand'])->name('brand');
    // Route::get('about', [PublicController::class, 'about'])->name('about');
    // Route::get('contact', [PublicController::class, 'contact'])->name('contact');
});
Route::prefix('/v3')->group(function () {
    Route::get('case', [PublicController::class, 'v3_case'])->name('v3_case');
    Route::post('case/get-data', [PublicController::class, 'v3_case_get_data'])->name('v3_case_get_data');
    Route::post('case/save-data', [PublicController::class, 'v3_case_save_data'])->name('v3_case_save_data');
    Route::post('case/get-tiket', [PublicController::class, 'v3_case_get_tiket'])->name('v3_case_get_tiket');
    Route::get('check_laporan', [PublicController::class, 'v3_chek_laporan'])->name('v3_chek_laporan');
    Route::get('check_schedule', [PublicController::class, 'v3_check_schedule'])->name('v3_check_schedule');
    Route::post('check_schedule/detail', [PublicController::class, 'v3_check_schedule_detail'])->name('v3_check_schedule_detail');
    Route::get('kritis/{code}/{id}/{tgl}', [PublicController::class, 'v3_insert_kritis_cabang'])->name('v3_insert_kritis_cabang');
    // Route::post('user-detail', [PublicController::class, 'piket_user_detail'])->name('piket_user_detail');
    // Route::get('menu-notif', [PublicController::class, 'list_menu_notif'])->name('list_menu_notif');
    // Route::get('menu/cart', [PublicController::class, 'list_menu_cart'])->name('list_menu_cart');
    // Route::post('menu/chosse_category', [PublicController::class, 'menu_chosse_category'])->name('menu_chosse_category');
    // Route::post('menu/detail-product', [PublicController::class, 'menu_detail_product'])->name('menu_detail_product');
    // Route::post('menu/add-cart', [PublicController::class, 'menu_add_cart'])->name('menu_add_cart');
    // Route::post('menu/remove-cart', [PublicController::class, 'menu_remove_cart'])->name('menu_remove_cart');
    // Route::post('menu/choose-table', [PublicController::class, 'menu_choosee_table_cart'])->name('menu_choosee_table_cart');
    // Route::post('menu/order-type-cart', [PublicController::class, 'menu_tipe_order_cart'])->name('menu_tipe_order_cart');
    // Route::post('menu/add-cart-product', [PublicController::class, 'menu_add_cart_product_user'])->name('menu_add_cart_product_user');
    // Route::get('brand', [PublicController::class, 'brand'])->name('brand');
    // Route::get('about', [PublicController::class, 'about'])->name('about');
    // Route::get('contact', [PublicController::class, 'contact'])->name('contact');
});
