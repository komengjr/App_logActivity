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
Route::post('masteradmin/datagroupworklist/postdata/edit',['as'=>'masteradmin/datagroupworklist/postdata/tambah','uses'=> 'MasterAdminController@datagroupworklisteditpost']);
Route::post('masteradmin/datagroupworklist/postdata/hapus',['as'=>'masteradmin/datagroupworklist/postdata/hapus','uses'=> 'MasterAdminController@datagroupworklisthapuspost']);

Route::post('masteradmin/datapersonworklist/postdata/tambah',['as'=>'masteradmin/datapersonworklist/postdata/tambah','uses'=> 'MasterAdminController@datapersonworklisttambahpost']);
Route::post('masteradmin/datapersonworklist/postdata/edit',['as'=>'masteradmin/datapersonworklist/postdata/edit','uses'=> 'MasterAdminController@datapersonworklisteditpost']);
Route::post('masteradmin/datapersonworklist/postdata/hapus',['as'=>'masteradmin/datapersonworklist/postdata/hapus','uses'=> 'MasterAdminController@datapersonworklisthapuspost']);

Route::post('masteradmin/datatypeworklist/postdata/tambah',['as'=>'masteradmin/datatypeworklist/postdata/tambah','uses'=> 'MasterAdminController@datatypeworklisttambahpost']);

// ADMIN ROUTE

Route::get('schedule',['as'=>'schedule','uses'=> 'AdminController@schedule']);
Route::get('schedule/datacalender/{id}',['as'=>'schedule/datacalender','uses'=> 'AdminController@datacalender']);
Route::get('admin/data/datauseradmin',['as'=>'admin/data/datauseradmin','uses'=> 'AdminController@datauseradmin']);
Route::get('admin/user/data/detail/{id}',['as'=>'admin/user/data/detail','uses'=> 'AdminController@datadetailuseradmin']);
Route::get('admin/dataworklist/tiketbaru',['as'=>'admin/dataworklist/tiketbaru','uses'=> 'AdminController@buattiketbaru']);
Route::get('admin/tiket/getdataoptionkinerja/{id}',['as'=>'admin/tiket/getdataoptionkinerja','uses'=> 'AdminController@getdataoptionkinerja']);
Route::get('admin/tiket/getdataoptionkinerjax/{id}',['as'=>'admin/tiket/getdataoptionkinerjax','uses'=> 'AdminController@getdataoptionkinerjax']);

Route::get('admin/data/tugasharian',['as'=>'admin/data/tugasharian','uses'=> 'AdminController@datatugasharian']);
Route::get('admin/data/tugasuserbelum',['as'=>'admin/data/tugasuserbelum','uses'=> 'AdminController@tugasuserbelum']);
Route::get('admin/data/dataperiode',['as'=>'admin/data/dataperiode','uses'=> 'AdminController@dataperiode']);
Route::get('admin/data/showtiketadmin/{id}',['as'=>'admin/data/showtiketadmin','uses'=> 'AdminController@showtiketadmin']);
Route::get('admin/data/edittiketadmin/{id}',['as'=>'admin/data/edittiketadmin','uses'=> 'AdminController@edittiketadmin']);
Route::get('admin/maps/data/cabang/{id}',['as'=>'admin/maps/data/cabang','uses'=> 'AdminController@datamapscabang']);
Route::get('admin/tiket/data/tambah',['as'=>'admin/tiket/data/tambah','uses'=> 'AdminController@inputtiketbaru']);
Route::get('admin/tiket/getdataoption/{id}',['as'=>'admin/tiket/getdataoption','uses'=> 'AdminController@getdataoptiontiket']);

Route::post('admin/buattiket/personal',['as'=>'radmin/buattiket/personal','uses'=> 'AdminController@buattiketpersonal']);
Route::post('admin/buattiket/group',['as'=>'admin/buattiket/group','uses'=> 'AdminController@buattiketgroupl']);
Route::post('admin/buattiket/laporan',['as'=>'admin/buattiket/laporan','uses'=> 'AdminController@buattiketlaporan']);

Route::post('admin/buatjadwal/user',['as'=>'admin/buatjadwal/user','uses'=> 'AdminController@ajaxRequestPost']);

Auth::routes();
Route::get('datamaps', function () {
    return view('maps');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/inputdatatiket', 'HomeController@inputdatatiketpersonal');
Route::post('/user/inputdatatiketgroup', 'HomeController@inputdatatiketgroup');
Route::get('/', 'HomeController@index')->name('home');


Route::post('/ubahpassword',['as'=>'all','uses'=> 'HomeController@ubahpassword']);
Route::post('/user/laporan/posttambah',['as'=>'posttambahlaporan','uses'=> 'UserController@posttambahlaporan']);
Route::get('user/lihattiket/{id}',['as'=>'user1','uses'=> 'UserController@lihattiketpersonal']);
Route::get('user/group/lihattiket/{id}',['as'=>'user12','uses'=> 'UserController@lihattiketgroup']);
Route::get('user/lihattugas',['as'=>'user2','uses'=> 'UserController@lihattugaspersonal']);
Route::get('user/laporan/tambah',['as'=>'user3','uses'=> 'UserController@laporantambah']);
Route::get('user/laporan/lihatlaporan/{id}',['as'=>'user/laporan/lihatlaporan','uses'=> 'UserController@lihatlaporan']);
Route::get('user/notifikasi/lihatnotif/{id}',['as'=>'user/notifikasi/lihatnotif','uses'=> 'UserController@lihatnotifikasi']);
Route::get('user/task/kinerja/{id}',['as'=>'user/task/kinerja','uses'=> 'UserController@lihattaskkinerja']);
Route::get('user/notifikasi/lihatnotifwaktu/',['as'=>'user/notifikasi/lihatnotifwaktu/','uses'=> 'UserController@lihatnotifikasiwaktu']);

Route::post('user/lengkapi/data', 'UserController@lengkapidatabiodata');

// Route::post('ajaxRequest', [AdminController::class, 'ajaxRequestPost'])->name('ajaxRequest.post');
