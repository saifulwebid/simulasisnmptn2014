<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//DB::connection()->disableQueryLog();

Route::get('/', 'HomeController@getIndex');
Route::post('/', 'HomeController@postIndex');

Route::get('login', array('as' => 'auth.login', 'uses' => 'UserController@getLogin'));
Route::post('login', array('uses' => 'UserController@postLogin'));
Route::get('logout', array('as' => 'auth.logout', 'uses' => 'UserController@getLogout'));

Route::get('ajax/ptn', array('as' => 'ajax.ptn', 'uses' => 'AjaxController@getProdiByPTN'));

Route::get('ptn', array('as' => 'ptn.index', 'uses' => 'PtnController@getListOfPTN'));
	Route::get('ptn/{id_ptn}', array('as' => 'ptn.profile', 'uses' => 'PtnController@getPTN'));

Route::get('saya/verifikasi', array('as' => 'self.verify', 'uses' => 'NilaiController@getVerifyNilai'));
Route::post('saya/verifikasi', array('uses' => 'NilaiController@postVerifyNilai'));

Route::get('saya/pilih', array('as' => 'self.pilihan', 'uses' => 'PilihanController@getMyPilihan'));
Route::post('saya/pilih', array('uses' => 'PilihanController@postMyPilihan'));

Route::get('saya/password', array('as' => 'self.password', 'uses' => 'UserController@getChangePassword'));
Route::post('saya/password', array('uses' => 'UserController@postChangePassword'));

Route::get('filter', array('as' => 'filter.main', 'uses' => 'FilteringController@getMainMenu'));
Route::get('filter/semester', array('as' => 'filter.semester', 'uses' => 'FilteringController@getFilterByRanking'));
Route::get('filter/prodi', array('as' => 'filter.prodi', 'uses' => 'FilteringController@getFilterByProdi'));
Route::get('filter/rekap', array('as' => 'filter.rekap', 'uses' => 'FilteringController@getRekapitulasi'));
	Route::get('filter/rekap/{id_ptn}', array('as' => 'filter.rekap.ptn', 'uses' => 'FilteringController@getRekapPtn'));

Route::get('operator/rekap', array('as' => 'operator.rekap', 'uses' => 'OperatorController@getRekapKelas'));
Route::get('operator/nilai', array('as' => 'operator.nilai', 'uses' => 'OperatorController@getNilaiKelas'));
	Route::get('operator/nilai/{id_siswa}', array('as' => 'operator.nilaisiswa', 'uses' => 'OperatorController@getNilaiSiswa'));
	Route::post('operator/nilai/{id_siswa}', array('uses' => 'OperatorController@postNilaiSiswa'));
Route::get('operator/reset', array('as' => 'operator.reset', 'uses' => 'OperatorController@getResetPassword'));
	Route::get('operator/reset/{id_siswa}', array('as' => 'operator.resetsiswa', 'uses' => 'OperatorController@getResetPasswordSiswa'));
	Route::post('operator/reset/{id_siswa}', array('uses' => 'OperatorController@postResetPasswordSiswa'));
Route::get('operator/batal/{id_siswa}', array('as' => 'operator.batal', 'uses' => 'OperatorController@getBatalkanVerifikasi'));
Route::post('operator/batal/{id_siswa}', array('uses' => 'OperatorController@postBatalkanVerifikasi'));

Route::get('admin/rekap', array('as' => 'admin.rekap', 'uses' => 'AdminController@getRekapUmum'));
	Route::get('admin/rekap/{id_kelas}', array('as' => 'admin.kelas', 'uses' => 'AdminController@getRekapKelas'));
Route::get('admin/nilai', array('as' => 'admin.nilai', 'uses' => 'AdminController@getNilaiMenu'));
Route::post('admin/nilai', array('uses' => 'AdminController@postNilaiMenu'));
	Route::get('admin/nilai/{id_siswa}', array('as' => 'admin.nilaisiswa', 'uses' => 'AdminController@getNilaiSiswa'));
	Route::post('admin/nilai/{id_siswa}', array('uses' => 'AdminController@postNilaiSiswa'));
Route::get('admin/reset', array('as' => 'admin.reset', 'uses' => 'AdminController@getResetPassword'));
Route::post('admin/reset', array('uses' => 'AdminController@postResetPassword'));
	Route::get('admin/reset/{id_siswa}', array('as' => 'admin.resetsiswa', 'uses' => 'AdminController@getResetPasswordSiswa'));
	Route::post('admin/reset/{id_siswa}', array('uses' => 'AdminController@postResetPasswordSiswa'));
Route::get('admin/batal/{id_siswa}', array('as' => 'admin.batal', 'uses' => 'AdminController@getBatalkanVerifikasi'));
Route::post('admin/batal/{id_siswa}', array('uses' => 'AdminController@postBatalkanVerifikasi'));
Route::get('admin/log', array('as' => 'admin.log', 'uses' => 'AdminController@getLog'));

Route::any('about', function() { return View::make('static.about'); });