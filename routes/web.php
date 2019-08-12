<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

// Users anggota,Ketua,bendahara,sekretaris,ketua
Route::group(['prefix' => 'users', 'namespace' => 'Users'], function(){
    Route::post('/', 'UserController@store')->name('users.store');
    Route::get('create', 'UserController@create')->name('users.create');
    Route::get('{user}/edit', 'UserController@edit')->name('users.edit');
    Route::patch('{user}/update', 'UserController@update')->name('users.update');

    Route::get('pegawai','PegawaiController@index')->name('pegawai.index');
    Route::get('anggota','AnggotaController@index')->name('anggota.index');
});

// Pinjaman atau pengajuan

Route::group(['prefix' => 'loans', 'namespace' => 'Loans'], function(){

    // Data Pinjaman
    route::get('/', 'LoanController@index')->name('loans');

    // setujui pinjaman
    route::get('submissions', 'SubmissionController@index')->name('submissions');
});

// jenis pinjaman

Route::group(['namespace' => 'Types'], function(){

    route::resource('types', 'TypeController');
});

// Angsuran
Route::group(['prefix'=> 'installments', 'namespace'=>'Installments'], function(){
    route::get('/', 'InstallmentController@index')->name('installments.index');
    Route::get('/{loan}/create', 'InstallmentController@create')->name('installments.create');
    Route::post('{loan}/store', 'InstallmentController@store')->name('installments.store');
});

// Simpanan

Route::group(['namespace'=>'Savings'], function(){
    route::resource('savings','SavingController');
});

// cetak laporan

Route::group(['namespace'=>'Reports'],function(){
    Route::get('report/savings', 'ReportController@savings')->name('reports.savings');
});