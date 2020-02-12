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
Route::get('shownasabah','nasabahController@showdata')->name('show');
Route::get('updatenasabah/{id}','nasabahController@updateNasabah');
Route::get('showformnasabah','nasabahController@showform');
Route::post('storenasabah','nasabahController@store');
Route::post('update/store/{id}','nasabahController@updateStore');
//Tempat Usaha
Route::get('showformtempatusaha','nasabahController@showformtempat');
Route::get('showtempatusaha','nasabahController@showtempatusaha');
Route::get('updatetempat','nasabahController@updateTempat');

//Tagihan
Route::get('tambahtagihan','tagihanController@tagihanNas');
Route::get('showformtagihan','tagihanController@formtagihan');

//Tarif
    //Air
Route::get('showformtarifair','tarifController@showTAir');
Route::post('update/storeA/{id}','tarifController@updateStoreA');
    //Listrik
Route::get('showformtariflistrik','tarifController@showTListrik');
Route::post('update/storeL/{id}','tarifController@updateStoreL');
    //IPK
Route::get('showformtarifipk','tarifController@showTIpk');
    //Keamanan
Route::get('showformtarifkeamanan','tarifController@showTKeamanan');
    //Kebersihan
Route::get('showformtarifkebersihan','tarifController@showTKebersihan')->name('showb');
Route::get('tambahkebersihan','tarifController@showKebersihan');
Route::get('updatekebersihan/{id}','tarifController@updateKebersihan');
Route::post('update/storeB/{id}','tarifController@updateStoreB');
Route::post('storekebersihan','tarifController@storekebersihan');

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
