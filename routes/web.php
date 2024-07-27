<?php

use Illuminate\Support\Facades\Route;

Route::get('masteradmin/tiket',['as'=>'masteradmin/tiket','uses'=> 'MasterAdminController@datatiketmasteradmin']);
Route::get('masteradmin/tiket/getdataoption/{id}',['as'=>'masteradmin/tiket/getdataoption','uses'=> 'MasterAdminController@getdataoptiontiket']);

// Master Admin GET
Route::get('masteradmin/datauser',['as'=>'master/datauser','uses'=> 'MasterAdminController@datauser']);
Route::get('masteradmin/datauser/tambah',['as'=>'masteradmin/datauser/tambah','uses'=> 'MasterAdminController@datausertambah']);
Route::get('masteradmin/datauser/edit/{id}',['as'=>'masteradmin/datauser/edit','uses'=> 'MasterAdminController@datauseredit']);

Route::get('masteradmin/datacabang',['as'=>'master/datacabang','uses'=> 'MasterAdminController@datacabang']);
Route::get('masteradmin/datacabang/detail/{id}',['as'=>'master/datacabang/detail','uses'=> 'MasterAdminController@datacabangdetail']);
Route::get('masteradmin/datacabang/tambah',['as'=>'masteradmin/datacabang/tambah','uses'=> 'MasterAdminController@datacabangtambah']);

Route::get('masteradmin/datagroup',['as'=>'master/datagroup','uses'=> 'MasterAdminController@datagroup']);
Route::get('masteradmin/datagroup/tambah',['as'=>'masteradmin/datagroup/tambah','uses'=> 'MasterAdminController@datagrouptambah']);
Route::get('masteradmin/datagroup/show/{id}',['as'=>'masteradmin/datagroup/show','uses'=> 'MasterAdminController@datagroupshow']);
Route::get('masteradmin/datagroup/tambah/cabang/{id}',['as'=>'masteradmin/datagroup/tambah/cabang','uses'=> 'MasterAdminController@datagrouptambahcabang']);
Route::get('masteradmin/datagroup/tambah/user/{id}',['as'=>'masteradmin/datagroup/tambah/user','uses'=> 'MasterAdminController@datagrouptambahuser']);

Route::get('masteradmin/datatask',['as'=>'masteradmin/datatask','uses'=> 'MasterAdminController@datatask']);
Route::get('masteradmin/datatask/showdata/{id}',['as'=>'masteradmin/datatask/showdata','uses'=> 'MasterAdminController@showdattask']);

Route::get('masteradmin/dataworklist',['as'=>'masteradmin/dataworklist','uses'=> 'MasterAdminController@dataworklist']);
Route::get('masteradmin/dataworklist/tambah',['as'=>'masteradmin/dataworklist/tambah','uses'=> 'MasterAdminController@dataworklisttambah']);
Route::get('masteradmin/dataworklist/edit/{id}',['as'=>'masteradmin/dataworklist/edit','uses'=> 'MasterAdminController@dataworklistedit']);

Route::get('masteradmin/datagroupworklist',['as'=>'masteradmin/datagroupworklist','uses'=> 'MasterAdminController@dataworklistgroup']);
Route::get('masteradmin/datagroupworklist/tambah',['as'=>'masteradmin/datagroupworklist/tambah','uses'=> 'MasterAdminController@dataworklistgrouptambah']);
Route::get('masteradmin/datagroupworklist/edit/{id}',['as'=>'masteradmin/datagroupworklist/edit','uses'=> 'MasterAdminController@dataworklistgroupedit']);

Route::get('masteradmin/datapersonworklist',['as'=>'masteradmin/datapersonworklist','uses'=> 'MasterAdminController@datapersonworklist']);
Route::get('masteradmin/datapersonworklist/tambah',['as'=>'masteradmin/datapersonworklist/tambah','uses'=> 'MasterAdminController@datapersonworklisttambah']);
Route::get('masteradmin/datapersonworklist/edit/{id}',['as'=>'masteradmin/datapersonworklist/edit','uses'=> 'MasterAdminController@datapersonworklistedit']);

Route::get('masteradmin/datatypeworklist',['as'=>'masteradmin/datatypeworklist','uses'=> 'MasterAdminController@datatypeworklist']);
Route::get('masteradmin/datatypeworklist/tambah',['as'=>'masteradmin/datatypeworklist/tambah','uses'=> 'MasterAdminController@datatypeworklisttambah']);

Route::get('masteradmin/datatiketgroupworklist',['as'=>'masteradmin/datatiketgroupworklist','uses'=> 'MasterAdminController@datatiketgroupworklist']);
Route::get('masteradmin/datatiketpersonalworklist',['as'=>'masteradmin/datatiketpersonalworklist','uses'=> 'MasterAdminController@datatiketpersonalworklist']);
Route::get('masteradmin/datatiketlaporan',['as'=>'masteradmin/datatiketlaporan','uses'=> 'MasterAdminController@datatiketlaporan']);
// Route::get('masteradmin/datamaps',['as'=>'masteradmin/datamaps','uses'=> 'MasterAdminController@datamaps']);

// Master Admin POST
Route::post('masteradmin/buattiket/personal',['as'=>'masteradmin/buattiket/personal','uses'=> 'MasterAdminController@buattiketpersonal']);
Route::post('masteradmin/buattiket/group',['as'=>'masteradmin/buattiket/group','uses'=> 'MasterAdminController@buattiketgroupl']);
Route::post('masteradmin/datauser/post/tambah',['as'=>'masteradmin/datauser/post/tambah','uses'=> 'MasterAdminController@datausertambahpost']);
Route::post('masteradmin/datauser/post/edit',['as'=>'masteradmin/datauser/post/edit','uses'=> 'MasterAdminController@datausereditpost']);

Route::post('masteradmin/datacabang/postdata/tambah',['as'=>'masteradmin/datacabang/postdata/tambah','uses'=> 'MasterAdminController@datacabangtambahpost']);

Route::post('masteradmin/datagroup/postdata/tambah',['as'=>'masteradmin/datagroup/postdata/tambah','uses'=> 'MasterAdminController@datagrouptambahpost']);
Route::post('masteradmin/datagroup/post/tambah/cabangbaru',['as'=>'masteradmin/datagroup/post/tambah/cabangbaru','uses'=> 'MasterAdminController@datagrouptambahpostcabangbaru']);
Route::post('masteradmin/datagroup/post/tambah/userbaru',['as'=>'masteradmin/datagroup/post/tambah/userbaru','uses'=> 'MasterAdminController@datagrouptambahpostuserbaru']);

Route::post('masteradmin/dataworklist/postdata/tambah',['as'=>'masteradmin/dataworklist/postdata/tambah','uses'=> 'MasterAdminController@dataworklisttambahpost']);
Route::post('masteradmin/dataworklist/postdata/edit',['as'=>'masteradmin/dataworklist/postdata/edit','uses'=> 'MasterAdminController@dataworklisteditpost']);
Route::post('masteradmin/dataworklist/postdata/hapus',['as'=>'masteradmin/dataworklist/postdata/hapus','uses'=> 'MasterAdminController@dataworklisthapuspost']);

Route::post('masteradmin/datagroupworklist/postdata/tambah',['as'=>'masteradmin/datagroupworklist/postdata/tambah','uses'=> 'MasterAdminController@datagroupworklisttambahpost']);
Route::post('masteradmin/datagroupworklist/postdata/edit',['as'=>'masteradmin/datagroupworklist/postdata/edit','uses'=> 'MasterAdminController@datagroupworklisteditpost']);
Route::post('masteradmin/datagroupworklist/postdata/hapus',['as'=>'masteradmin/datagroupworklist/postdata/hapus','uses'=> 'MasterAdminController@datagroupworklisthapuspost']);

Route::post('masteradmin/datapersonworklist/postdata/tambah',['as'=>'masteradmin/datapersonworklist/postdata/tambah','uses'=> 'MasterAdminController@datapersonworklisttambahpost']);
Route::post('masteradmin/datapersonworklist/postdata/edit',['as'=>'masteradmin/datapersonworklist/postdata/edit','uses'=> 'MasterAdminController@datapersonworklisteditpost']);
Route::post('masteradmin/datapersonworklist/postdata/hapus',['as'=>'masteradmin/datapersonworklist/postdata/hapus','uses'=> 'MasterAdminController@datapersonworklisthapuspost']);

Route::post('masteradmin/datatypeworklist/postdata/tambah',['as'=>'masteradmin/datatypeworklist/postdata/tambah','uses'=> 'MasterAdminController@datatypeworklisttambahpost']);

// ADMIN ROUTE

Route::get('schedule',['as'=>'schedule','uses'=> 'AdminController@schedule']);
Route::get('cabang',['as'=>'piket','uses'=> 'AdminController@piket']);

Route::get('admin/dashboard/viewdata',['as'=>'admin/dashboard/viewdata','uses'=> 'AdminController@dashboardviewdata']);
Route::post('postadmin/dashboard/monitoringdata',['as'=>'postadmin/dashboard/monitoringdata','uses'=> 'AdminController@monitoringdatauser']);

Route::get('admin/data/cabang/menuhandle/{id}',['as'=>'admin/data/cabang/menuhandle/','uses'=> 'AdminController@datahandlecabang']);
Route::get('admin/data/cabang/menuhandle/tambahdata/{id}',['as'=>'admin/data/cabang/menuhandle/tambahdata/','uses'=> 'AdminController@tambahdatauserhandlecabang']);
Route::get('admin/tablepiket/{id}', 'AdminController@tablepiket')->name('admin.jadwalpiket');
Route::get('schedule/datacalender/{id}',['as'=>'schedule/datacalender','uses'=> 'AdminController@datacalender']);
Route::get('admin/datauser/tambah',['as'=>'admin/dataworklist/tambah','uses'=> 'AdminController@tambahdatauseradmin']);
Route::get('admin/dataperiode/tambah',['as'=>'admin/dataperiode/tambah','uses'=> 'AdminController@tambahdataperiodeadmin']);
Route::get('admin/data/datauseradmin',['as'=>'admin/data/datauseradmin','uses'=> 'AdminController@datauseradmin']);
Route::get('admin/data/user/nonaktif/{id}',['as'=>'admin/data/user/nonaktif','uses'=> 'AdminController@nonaktifdatauseradmin']);
Route::get('admin/data/user/aktif/{id}',['as'=>'admin/data/user/aktif','uses'=> 'AdminController@aktifdatauseradmin']);
Route::get('admin/user/data/detail/{id}',['as'=>'admin/user/data/detail','uses'=> 'AdminController@datadetailuseradmin']);
Route::get('admin/dataworklist/tiketbaru',['as'=>'admin/dataworklist/tiketbaru','uses'=> 'AdminController@buattiketbaru']);
Route::get('admin/tiket/getdataoptionkinerja/{id}',['as'=>'admin/tiket/getdataoptionkinerja','uses'=> 'AdminController@getdataoptionkinerja']);
Route::get('admin/tiket/getdataoptionkinerjax/{id}',['as'=>'admin/tiket/getdataoptionkinerjax','uses'=> 'AdminController@getdataoptionkinerjax']);

Route::get('admin/data/tugasschedule',['as'=>'admin/data/tugasharian','uses'=> 'AdminController@datatugasjadwal']);
Route::get('admin/data/tugasuserlainnya',['as'=>'admin/data/tugasuserlainnya','uses'=> 'AdminController@tugasuserlainnya']);
Route::get('admin/data/tugasuserbelum',['as'=>'admin/data/tugasuserbelum','uses'=> 'AdminController@tugasuserbelum']);
Route::get('admin/data/dataperiode',['as'=>'admin/data/dataperiode','uses'=> 'AdminController@dataperiode']);
Route::get('admin/data/datacabang',['as'=>'admin/data/datacabang','uses'=> 'AdminController@datacabang']);
Route::get('admin/data/datacabang/tambah',['as'=>'admin/data/datacabang/tambah','uses'=> 'AdminController@tambahdatacabang']);
Route::get('admin/data/datacabang/tambah/{id}',['as'=>'admin/data/datacabang/tambahid','uses'=> 'AdminController@tambahdataverifikatorcabang']);
Route::get('admin/data/datahendlecabang/tambah/{id}',['as'=>'admin/data/datahendlecabang/tambah/','uses'=> 'AdminController@tambahdatahendlecabang']);
Route::get('admin/data/datagroup',['as'=>'admin/data/datagroup','uses'=> 'AdminController@datagroup']);
Route::get('admin/data/showtiketadmin/{id}',['as'=>'admin/data/showtiketadmin','uses'=> 'AdminController@showtiketadmin']);
Route::get('admin/data/edittiketadmin/{id}',['as'=>'admin/data/edittiketadmin','uses'=> 'AdminController@edittiketadmin']);
Route::get('admin/maps/data/cabang/{id}',['as'=>'admin/maps/data/cabang','uses'=> 'AdminController@datamapscabang']);
Route::get('admin/tiket/data/tambah',['as'=>'admin/tiket/data/tambah','uses'=> 'AdminController@inputtiketbaru']);
Route::get('admin/tiket/getdataoption/{id}',['as'=>'admin/tiket/getdataoption','uses'=> 'AdminController@getdataoptiontiket']);
Route::get('admin/datagroup/tambahuser/{id}',['as'=>'admin/datagroup/tambahuser','uses'=> 'AdminController@tambahusergroup']);
Route::get('admin/datagroup/tambahcabang/{id}',['as'=>'admin/datagroup/tambahcabang','uses'=> 'AdminController@tambahcabanggroup']);
Route::get('admin/schedule/show/on/{id}','AdminController@showdataschedule');
Route::get('admin/datagroup/tambah',['as'=>'admin/datagroup/tambah','uses'=> 'AdminController@tambahgroupbaru']);
Route::get('admin/datatask/user/pengerjaan/{id}',['as'=>'admin/datatask/user/pengerjaan','uses'=> 'AdminController@datataskpengerjaanuser']);
Route::get('admin/datatask/user/pengerjaan/showdata/{id}/{kd}',['as'=>'admin/datatask/user/pengerjaan/showdata','uses'=> 'AdminController@datataskshowdatauser']);


Route::post('admin/buattiket/personal',['as'=>'radmin/buattiket/personal','uses'=> 'AdminController@buattiketpersonal']);
Route::post('admin/buattiket/group',['as'=>'admin/buattiket/group','uses'=> 'AdminController@buattiketgroupl']);

Route::post('admin/buattiket/laporan',['as'=>'admin/buattiket/laporan','uses'=> 'AdminController@buattiketlaporan']);

Route::post('admin/buatjadwal/user',['as'=>'admin/buatjadwal/user','uses'=> 'AdminController@ajaxRequestPost']);
Route::post('admin/user/tambahuser','AdminController@tambahuserbaru');
Route::post('admin/periode/tambahperiode','AdminController@tambahperiodebaru');
Route::post('admin/datagroup/tambahusergroup','AdminController@tambahusergroupbaru');
Route::post('admin/datagroup/tambahcabanggroup','AdminController@tambahcabanggroupbaru');
Route::post('admin/group/tambahgroup','AdminController@posttambahgroupbaru');
Route::post('admin/data/datacabang/tambahverifikator','AdminController@tambahuserverifikator');
Route::post('admin/data/datacabang/tambahhendlecabang','AdminController@tambahhendlecabang');
Route::post('admin/data/cabang/menuhandle/posttambahdata','AdminController@posttambahuserbackuphandle');


Route::get('taskorder',['as'=>'taskorder','uses'=> 'AdminController@taskorder']);
Route::post('taskorder/postmonitoringharian','AdminController@postmonitoringharian');

Auth::routes();
// Route::get('datamaps', function () {
//     return view('maps');
// });
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/inputdatatiket', 'HomeController@inputdatatiketpersonal');
Route::post('/user/inputdatatiketgroup', 'HomeController@inputdatatiketgroup');
Route::get('/', 'HomeController@index');
Route::get('/newcase', 'PublicController@newcase');
Route::get('/cek-status-laporan', 'PublicController@cek_status_laporan');
Route::get('/caricabang/{id}', 'PublicController@caricabang');
Route::get('/caridatatiket/{id}', 'PublicController@caridatatiket');
Route::get('/pilihcabang/{id}', 'PublicController@pilihcabang');
Route::post('/simpan-newcase', 'PublicController@postnewcase');


Route::post('/ubahpassword',['as'=>'all','uses'=> 'HomeController@ubahpassword']);
Route::post('/user/laporan/posttambah',['as'=>'posttambahlaporan','uses'=> 'UserController@posttambahlaporan']);
Route::post('user/datalaporan/penyelesaian',['as'=>'user/datalaporan/penyelesaian','uses'=> 'UserController@postpenyelesaianlaporan']);
Route::get('user/lihattiket/{id}',['as'=>'user1','uses'=> 'UserController@lihattiketpersonal']);
Route::get('user/group/lihattiket/{id}',['as'=>'user12','uses'=> 'UserController@lihattiketgroup']);
Route::get('user/lihattugas',['as'=>'user2','uses'=> 'UserController@lihattugaspersonal']);
Route::get('user/laporan/tambah',['as'=>'user3','uses'=> 'UserController@laporantambah']);
Route::get('user/laporan/lihatdatalaporan/{id}',['as'=>'user/laporan/lihatdatalaporan','uses'=> 'UserController@lihatdatalaporan']);
Route::get('user/laporan/lihatlaporan/{id}',['as'=>'user/laporan/lihatlaporan','uses'=> 'UserController@lihatlaporan']);
Route::get('user/notifikasi/lihatnotif/{id}',['as'=>'user/notifikasi/lihatnotif','uses'=> 'UserController@lihatnotifikasi']);
Route::get('user/task/kinerja/{id}',['as'=>'user/task/kinerja','uses'=> 'UserController@lihattaskkinerja']);
Route::get('user/task/kinerja-admin/{id}',['as'=>'user/task/kinerja-admin','uses'=> 'UserController@lihattaskkinerjaadmin']);
Route::get('user/notifikasi/lihatnotifwaktu/',['as'=>'user/notifikasi/lihatnotifwaktu/','uses'=> 'UserController@lihatnotifikasiwaktu']);
Route::get('user/userleader/modal/beritugas',['as'=>'user/userleader/modal/beritugas','uses'=> 'UserController@beritugasuser']);
Route::get('user/userleader/modal/lihattugas',['as'=>'user/userleader/modal/lihattugas','uses'=> 'UserController@lihattugasuser']);
Route::get('user/userleader/modal/periodekpi',['as'=>'user/userleader/modal/periodekpi','uses'=> 'UserController@periodekpi']);
Route::get('user/userleader/modal/printlaporan',['as'=>'user/userleader/modal/printlaporan','uses'=> 'UserController@printlaporanuser']);
Route::get('user/userleader/table/laporandatakinerja/{id}',['as'=>'user/userleader/table/laporandatakinerja/','uses'=> 'UserController@laporandatakinerja']);
Route::get('user/userleader/table/detailtask/{id}',['as'=>'user/userleader/table/detailtask','uses'=> 'UserController@detaildatatask']);
Route::post('user/userleader/table/detailtask/penilaian', 'UserController@penilaiantask');

Route::get('user/user/task/kerjakan/{id}',['as'=>'user/user/task/kerjakan','uses'=> 'UserController@kerjakandatatask']);
Route::get('user/user/handledatacabang',['as'=>'user/user/handledatacabang/','uses'=> 'UserController@hendledatacabang']);
Route::get('user/user/handledatacabang/task/{id}',['as'=>'user/user/handledatacabang/task','uses'=> 'UserController@taskharianhendledatacabang']);
// Maintenance Bulanan
Route::get('user/user/handledatacabang/taskbulanan/{id}',['as'=>'user/user/handledatacabang/taskbulanan','uses'=> 'UserController@taskbulananhendledatacabang']);
Route::get('user/user/handledatacabang/taskbulanan/cetak-rencana/{id}',['as'=>'user/user/handledatacabang/taskbulanan/cetak-rencana','uses'=> 'UserController@cetakrencanataskbulananhendledatacabang']);
Route::get('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/{id}',['as'=>'user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/','uses'=> 'UserController@tambahmaintenancebulananhendledatacabang']);
Route::post('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan',['as'=>'user/user/handledatacabang/taskbulanan/post-tambah-maintenance-bulanan/','uses'=> 'UserController@posttambahmaintenancebulananhendledatacabang']);
Route::get('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/{id}',['as'=>'user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail','uses'=> 'UserController@detailmaintenancebulananhendledatacabang']);
Route::get('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/tambah-perangkat/{id}',['as'=>'user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/tambah-perangkat','uses'=> 'UserController@tambahdetailmaintenancebulananhendledatacabang']);
Route::post('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail-cari/cari-perangkat',['as'=>'user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/cari-perangkat','uses'=> 'UserController@caridetailmaintenancebulananhendledatacabang']);
Route::post('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/pilih-perangkat',['as'=>'user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/pilih-perangkat','uses'=> 'UserController@pilihdetailmaintenancebulananhendledatacabang']);
Route::post('user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/pilih-perangkat/simpan',['as'=>'user/user/handledatacabang/taskbulanan/tambah-maintenance-bulanan/detail/pilih-perangkat/simpan','uses'=> 'UserController@simpanpilihdetailmaintenancebulananhendledatacabang']);
Route::get('user/user/handledatacabang/taskbulanan/maintenance-bulanan/detail/perangkat/{id}/{kode}',['as'=>'user/user/handledatacabang/taskbulanan/maintenance-bulanan/detail/perangkat','uses'=> 'UserController@maintenanceperangkatdetail']);
Route::post('user/user/handledatacabang/taskbulanan/maintenance-bulanan/simpan-detail/perangkat',['as'=>'user/user/handledatacabang/taskbulanan/maintenance-bulanan/simpan-detail/perangkat','uses'=> 'UserController@maintenanceperangkatsimpandatadetail']);
Route::post('user/user/handledatacabang/taskbulanan/maintenance-bulanan/simpan-detail/verif-perangkat',['as'=>'user/user/handledatacabang/taskbulanan/maintenance-bulanan/simpan-detail/verif-perangkat','uses'=> 'UserController@maintenanceverifperangkatsimpandatadetail']);

Route::get('user/user/handledatacabang/customtask/{id}',['as'=>'user/user/handledatacabang/customtask/','uses'=> 'UserController@customtaskhendledatacabang']);
Route::get('user/user/handlecabang/customtask/lengkapidata/{id}',['as'=>'user/user/handledatacabang/customtask/lengkapidata/','uses'=> 'UserController@lengkapicustomtaskhendledatacabang']);
Route::post('user/user/handlecabang/customtask/lengkapisubdata/{id}',['as'=>'user/user/handledatacabang/customtask/lengkapisubdata/','uses'=> 'UserController@lengkapisubcustomtaskhendledatacabang']);
Route::post('user/user/handlecabang/customtask/new-data',['as'=>'user/user/handledatacabang/customtask/new-data/','uses'=> 'UserController@tambahcustomtaskhendledatacabang']);
Route::post('user/user/handlecabang/customtask/new-data/simpan',['as'=>'user/user/handledatacabang/customtask/new-data/simpan','uses'=> 'UserController@simpantambahcustomtaskhendledatacabang']);
Route::post('user/user/handlecabang/customtasksub/new-data/simpan',['as'=>'user/user/handledatacabang/customtasksub/new-data/simpan','uses'=> 'UserController@simpantambahcustomtasksubhendledatacabang']);
Route::post('user/user/handlecabang/formcustomtasksub/caridatainventaris',['as'=>'caridatainventaris-formcustomtasksub','uses'=> 'UserController@caridatainventaris_formcustomtasksub']);
Route::post('user/user/handlecabang/formcustomtasksub/pilihdatainventaris',['as'=>'pilihdatainventaris-formcustomtasksub','uses'=> 'UserController@pilihdatainventaris_formcustomtasksub']);
Route::post('user/user/handlecabang/formcustomtasksub/pilihdatainventaris/simpandata',['as'=>'simpandata-pilihdatainventaris-formcustomtasksub','uses'=> 'UserController@simpandata_pilihdatainventaris_formcustomtasksub']);
Route::get('user/user/handlecabang/respon-laporan-user/{id}',['as'=>'user/user/handlecabang/respon-laporan-user/','uses'=> 'UserController@respondatalaporanuser']);
// Route::get('user/userleader/modal/postprintlaporan/{id}',['as'=>'user/userleader/modal/postprintlaporan/id','uses'=> 'UserController@postprintlaporanid']);
Route::post('user/userleader/modalreport/postprintlaporan',['as'=>'user/userleader/modalreport/postprintlaporan','uses'=> 'UserController@postprintlaporan']);
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
Route::get('master-data-user',['as'=>'master-data-hardware','uses'=> 'MasterUserController@masterdatahardware']);
Route::post('master-data-user/laporan/detail',['as'=>'master-data-user/laporan/detail','uses'=> 'MasterUserController@masterdatalaporandetail']);
Route::post('master-data-user/laporan/monitoring/harian',['as'=>'master-data-user/laporan/monitoring/harian','uses'=> 'MasterUserController@masterdatalaporanharian']);
Route::post('master-data-user/laporan/monitoring/harian/preview',['as'=>'master-data-user/laporan/monitoring/harian/preview','uses'=> 'MasterUserController@masterpreviewmonitoringharian']);
Route::post('master-data-user/laporan/monitoring/harian/previewbackupharian',['as'=>'master-data-user/laporan/monitoring/harian/previewbackupharian','uses'=> 'MasterUserController@masterpreviewbackupharianmonitoringharian']);
Route::post('master-data-user/laporan/monitoring/kerusakan',['as'=>'master-data-user/laporan/monitoring/kerusakan','uses'=> 'MasterUserController@masterdatalaporankerusakan']);

Route::post('master-data-user/laporan/monitoring/backup-bulanan',['as'=>'laporan_monitoring_backup-bulanan','uses'=> 'MasterUserController@masterdatalaporanbackupbulanan']);

Route::get('master-data-kinerja',['as'=>'master-data-kinerja','uses'=> 'AdminController@masterdatakinerja']);
Route::post('master-data-kinerja/detaildata',['as'=>'master-data-kinerja-detail-data','uses'=> 'AdminController@masterdatakinerjadetail']);
Route::post('master-data-kinerja/simpandetaildata',['as'=>'simpan-master-data-kinerja-detail-data','uses'=> 'AdminController@tambahmasterdatakinerjadetail']);
Route::post('master-data-kinerja/detaildata/form',['as'=>'master-data-kinerja-detail-data-form','uses'=> 'AdminController@masterdatakinerjadetailform']);
Route::post('master-data-kinerja/detaildata/fieldform',['as'=>'master-data-kinerja-detail-data-fieldform','uses'=> 'AdminController@masterdatakinerjadetailfieldform']);
// VERIFIKATOR
Route::get('verifikator/datatask/user/pengerjaan/{id}',['as'=>'verifikator/datatask/user/pengerjaan','uses'=> 'VerifikatorController@datatask']);
Route::get('verifikator/datatask/tambahorder',['as'=>'verifikator/datatask/tambahorder','uses'=> 'VerifikatorController@tambahordertask']);
Route::get('verifikator/datagraphic/task',['as'=>'verifikator/datagraphic/task','uses'=> 'VerifikatorController@datagraphic']);
Route::post('postverifikator/datagraphic/posttask',['as'=>'postverifikator/datagraphic/posttask','uses'=> 'VerifikatorController@datapostgraphic']);
Route::post('postverifikator/datagraphic/postviewtask',['as'=>'postverifikator/datagraphic/postviewtask','uses'=> 'VerifikatorController@postdataviewtaskgraphic']);
Route::post('verifikator/datatask/user/pdf', 'PdfController@printdataverif');
Route::post('verifikator/datatask/user/verif', 'VerifikatorController@verifdatauser');
Route::post('verifikator/datatask/user/unverif', 'VerifikatorController@unverifdatauser');
Route::post('verifikator/datatask/tambahorder', 'VerifikatorController@posttambahorder');

// Route::post('ajaxRequest', [AdminController::class, 'ajaxRequestPost'])->name('ajaxRequest.post');
// Route::get('data_peserta','AdminController@data_peserta');
Route::get('log-eror-it', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);


