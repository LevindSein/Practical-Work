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
Route::get('showformnasabah','nasabahController@showform');

//Tagihan
Route::get('showformtagihanair','tagihanAirController@show');
Route::get('showformtagihanlistrik','tagihanListrikController@show');

//Tarif
Route::get('showformtarifair','tarifAirController@show');
Route::get('showformtarifipk','tarifIPKController@show');
Route::get('showformtarifkeamanan','tarifKeamananController@show');
Route::get('showformtarifkebersihan','tarifKebersihanController@show');
Route::get('showformtariflistrik','tarifListrikController@show');

//Laporan
Route::get('showlaporanharian','laporanHarianController@show');
Route::get('showlaporanbulanan','laporanBulananController@show');
Route::get('showlaporantahunan','laporanTahunanController@show');
Route::get('showlaporantagihan','laporanTagihanController@show');
Route::get('showlaporantunggakan','laporanTunggakanController@show');
Route::get('showlaporanbongkaran','laporanBongkaranController@show');
Route::get('showlaporanpenghapusan','laporanPenghapusanController@show'); 

//User
Route::get('showdatauser','dataUserController@show');
Route::get('showtambahuser','tambahUserController@show');