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
Route::get('showdatanasabah','nasabahController@showdata')->name('show');
Route::get('showformnasabah','nasabahController@showform');
Route::post('storenasabah','nasabahController@store');
Route::get('updatenasabah/{id}','nasabahController@updateNasabah');
Route::post('update/store/{id}','nasabahController@updateStore');
//Tempat Usaha
Route::get('showtempatusaha','nasabahController@showtempatusaha')->name('tempat');
Route::get('showformtempatusaha','nasabahController@showformtempat');
Route::post('storetempat','nasabahController@storeTempat');
Route::get('updatetempat/{id}','nasabahController@updateTempat');
Route::post('update/storetempat/{id}','nasabahController@updateStoreTempat');

//Tarif
    //Air
Route::get('showformtarifair','tarifController@showTAir');
Route::post('update/storeA/{id}','tarifController@updateStoreA');
    //Listrik
Route::get('showformtariflistrik','tarifController@showTListrik');
Route::post('update/storeL/{id}','tarifController@updateStoreL');
    //IPK
Route::get('showformtarifipk','tarifController@showTIpk')->name('showi');
Route::get('tambahipk','tarifController@showIpk');
Route::get('updateipk/{id}','tarifController@updateIpk');
Route::post('update/storeI/{id}','tarifController@updateStoreI');
Route::post('storeipk','tarifController@storeipk');
    //Keamanan
Route::get('showformtarifkeamanan','tarifController@showTKeamanan')->name('showk');
Route::get('tambahkeamanan','tarifController@showKeamanan');
Route::get('updatekeamanan/{id}','tarifController@updateKeamanan');
Route::post('update/storeK/{id}','tarifController@updateStoreK');
Route::post('storekeamanan','tarifController@storekeamanan');
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

//Tagihan
Route::get('datatagihannasabah/{id}','tagihanController@dataTagihan');
Route::get('bayartagihan','tagihanController@bayarTagihan');
Route::get('tambahtagihan','tagihanController@tagihanNas')->name('tagihan');
Route::get('showformtagihan/{id}','tagihanController@formtagihan')->name('showformtagihan');
Route::post('tagihan/store/{id}','tagihanController@storetagihan');


//Tunggakan
Route::get('bayartunggakan','tunggakanController@bayarTunggakan');

//Meteran
    //AIR
Route::get('dataalatair','meteranController@dataalatair')->name('alatair');
Route::get('tambahalatair','meteranController@formalatair');
Route::post('storealatair','meteranController@storealatair');
Route::get('updatealatair/{id}','meteranController@updatealatair');
Route::post('update/storealatair/{id}','meteranController@storeupdatealatair');
    //LISTRIK
Route::get('dataalatlistrik','meteranController@dataalatlistrik')->name('alatlistrik');
Route::get('tambahalatlistrik','meteranController@formalatlistrik');
Route::post('storealatlistrik','meteranController@storealatlistrik');
Route::get('updatealatlistrik/{id}','meteranController@updatealatlistrik');
Route::post('update/storealatlistrik/{id}','meteranController@storeupdatealatlistrik');

//User
Route::get('showdatauser','userController@showdatauser');
Route::get('showtambahuser','userController@tambahuser');

//Dashboard
Route::get('showdashboard','dashboardController@dashboard');
