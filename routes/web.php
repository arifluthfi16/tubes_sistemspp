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

    Route::get('/cektagihan/{id_tagihan}',[
        'uses' => 'SPPController@cekTagihan',
        'as' => 'siswa.cek_tagihan'
    ]);

    Route::get('/home/', [
        'uses' => 'SPPController@siswaIndex',
        'as' => 'siswa.index'
    ]);

    Route::get('/bayar/', [
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
});

//Route Group Admin
Route::group(['prefix'=>'admin','middleware'=>['auth','admin']], function(){
   Route::get('/', [
       'uses' => 'AdminController@index',
       'as' => 'admin.index'
   ]);

   Route::get('/daftaruser/',[
      'uses' => 'AdminController@userlist',
      'as' => 'admin.userlist'
   ]);
});