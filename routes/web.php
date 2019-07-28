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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>['auth','admin']], function(){
    Route::get('/home', function(){
       return view('admin.index');
    })->name('admin.index');
});


//Route Group Pegawai
Route::group(['prefix'=>'pegawai','middleware'=>['auth','pegawai']], function(){
    Route::get('/', function (){
        return redirect()->route('pegawai.index');
    });

    Route::get('/home/', [
        'uses' => 'PegawaiController@index',
        'as' => 'pegawai.index'
    ]);

    Route::post('/prosesTagihan/{id}', [
        'uses' => 'PegawaiController@prosesTagihan',
        'as' => 'pegawai.prosesTagihan'
    ]);

    Route::post('/deleteTagihan/{id}', [
        'uses' => 'PegawaiController@deleteTagihan',
        'as' => 'pegawai.deleteTagihan'
    ]);

});


//Route Group Siswa
Route::group(['prefix'=>'siswa','middleware'=>['auth','siswa']], function(){
    Route::get('/', function (){
        return redirect()->route('siswa.index');
    });

    //Controller Profile
    Route::get('/profile', [
        'uses' => 'SPPController@profile',
        'as' => 'siswa.profile.index'
    ]);

    Route::get('/cektagihan/{id_tagihan}',[
        'uses' => 'SPPController@cekTagihan',
        'as' => 'siswa.cek_tagihan'
    ]);

    Route::get('/home/', [
        'uses' => 'SPPController@siswaIndex',
        'as' => 'siswa.index'
    ]);

    Route::get('/bayar/{id}/', [
        'uses' => 'SPPController@bayarForm',
        'as' => 'siswa.bayar'
    ]);

    Route::post('/proses/',[
        'uses' => 'SPPController@bayarProses',
        'as' => 'siswa.proses'
        ]);

    Route::delete('/cancelTagihan/{id_tagihan}', [
        'uses' => 'SPPController@cancelTagihan',
        'as' => 'siswa.cancelTagihan'
    ]);

    Route::get('/profile/', [
        'uses' => 'SPPController@myProfile',
        'as' => 'siswa.profile.index'
        ]);

    //siswa controller
    Route::get('/profile/{id}', [
        'uses' => 'SPPController@edit',
        'as' => 'siswa.edit'
    ]);

    Route::post('/profile/{id}', [
        'uses' => 'SPPController@update',
        'as' => 'siswa.update'
    ]);

});

//Route Group Admin
Route::group(['prefix'=>'admin','middleware'=>['auth','admin']], function(){
   Route::get('/', [
       'uses' => 'AdminController@index',
       'as' => 'admin.index'
   ]);

   Route::get('/siswa',[
      'uses' => 'AdminController@userlist',
      'as' => 'admin.siswa.index'
   ]);

   Route::get('/siswa/details/{id}', [
       'uses' => 'AdminController@details', 
       'as' => 'admin.siswa.edit'
   ]);

   Route::post('/siswa/', [
       'uses' => 'AdminController@addSiswa',
       'as' => 'admin.siswa.index'
   ]);

    Route::post('/siswa/details/{id}', [
        'uses' => 'AdminController@updateDetails',
        'as' => 'admin.siswa.update'
    ]);

    Route::get('/siswa/delete/{id}', [
        'uses' => 'AdminController@deleteSiswa',
        'as' => 'admin.siswa.delete'
    ]);


//    Pegawai
   Route::get('/pegawai/', [
        'uses' => 'AdminController@detailsPegawai', 
        'as' => 'admin.pegawai.index'
   ]);

   Route::post('/pegawai/', [
       'uses' => 'AdminController@addPegawai', 
       'as' => 'admin.pegawai.index'
   ]);

   Route::get('/pegawai/details/{id}', [
        'uses' => 'AdminController@pegawaiDetails', 
        'as' => 'admin.pegawai.edit'
   ]);  

   Route::post('/pegawai/details/{id}', [
    'uses' => 'AdminController@updateDetailsPegawai', 
    'as' => 'admin.pegawai.update'
    ]);  

    Route::get('/pegawai/{id}', [
        'uses' => 'AdminController@deletePegawai',
        'as' => 'admin.pegawai.delete'
   ]);

//  Academic Year

    Route::get('/tahun/', [
       'uses' => 'AdminController@detailsTahun',
        'as' => 'admin.tahun.index'
    ]);

    Route::get('/tahun/edit/{id}', [
        'uses' => 'AdminController@detailsEditTahun',
        'as' => 'admin.tahun.edit'
    ]);

    Route::post('/tahun/add', [
        'uses' => 'AdminController@addTahun',
        'as' => 'admin.tahun.add'
    ]);

    Route::post('/tahun/update', [
        'uses' => 'AdminController@updateTahun',
        'as' => 'admin.tahun.update'
    ]);

    Route::get('/tahun/delete/{id}', [
        'uses' => 'AdminController@deleteTahun',
        'as' => 'admin.tahun.delete'
    ]);
});


//Route Group Test
Route::group(['prefix'=>'test'], function(){
    Route::get('/yearTest', [
        'uses' => 'TestController@yearTest'
    ]);

    Route::get('/forceclose', [
        'uses' => 'TestController@forceExit'
    ]);

    Route::get('/test2', [
        'uses' => 'TestController@test2'
    ]);
});