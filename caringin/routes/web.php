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


//Nasabah
Route::get('showdatanasabah','nasabahController@showdata');
Route::get('updatenasabah','nasabahController@updateNasabah');
Route::get('showformnasabah','nasabahController@showform');
Route::get('showformtempatusaha','nasabahController@showformtempat');
Route::get('showtempatusaha','nasabahController@showtempatusaha');
Route::get('updatetempat','nasabahController@updateTempat');

//Tagihan
Route::get('showformtagihanair','tagihanController@tagihanAir');
Route::get('showformtagihanlistrik','tagihanController@tagihanListrik');

//Tarif
Route::get('showformtarifair','tarifController@showTAir');
Route::get('showformtarifipk','tarifController@showTIpk');
Route::get('showformtarifkeamanan','tarifController@showTKeamanan');
Route::get('showformtarifkebersihan','tarifController@showTkebersihan');
Route::get('showformtariflistrik','tarifController@showTListrik');

//Laporan
Route::get('showlaporanharian','laporanController@showHarian');
Route::get('showlaporanbulanan','laporanController@showBulanan');
Route::get('showlaporantahunan','laporanController@showTahunan');
Route::get('showlaporantagihan','laporanController@showTagihan');
Route::get('showlaporantunggakan','laporanController@showTunggakan');
Route::get('showlaporanbongkaran','laporanController@showBongkaran');
Route::get('showlaporanpenghapusan','laporanController@showPenghapusan'); 
//DataTagihan
Route::get('datatagihannasabah','laporanController@dataTagihan');

//User
Route::get('showdatauser','userController@showdatauser');
Route::get('showtambahuser','userController@tambahuser');
