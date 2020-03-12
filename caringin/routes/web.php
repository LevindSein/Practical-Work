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


//ADMIN
//Nasabah
Route::get('showdatanasabah','nasabahController@showdata')->name('show');
Route::get('showformnasabah','nasabahController@showform');
Route::post('storenasabah','nasabahController@store');
Route::get('updatenasabah/{id}','nasabahController@updateNasabah')->name('updnasabah');
Route::post('update/store/{id}','nasabahController@updateStore');
//Tempat Usaha
Route::get('showtempatusaha','nasabahController@showtempatusaha')->name('tempat');
Route::get('showformtempatusaha','nasabahController@showformtempat');
Route::post('storetempat','nasabahController@storeTempat');
Route::get('updatetempat/{id}','nasabahController@updateTempat')->name('updtempat');
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
Route::get('updateipk/{id}','tarifController@updateIpk')->name('uptrfI');
Route::post('update/storeI/{id}','tarifController@updateStoreI');
Route::post('storeipk','tarifController@storeipk');
    //Keamanan
Route::get('showformtarifkeamanan','tarifController@showTKeamanan')->name('showk');
Route::get('tambahkeamanan','tarifController@showKeamanan');
Route::get('updatekeamanan/{id}','tarifController@updateKeamanan')->name('uptrfK');
Route::post('update/storeK/{id}','tarifController@updateStoreK');
Route::post('storekeamanan','tarifController@storekeamanan');
    //Kebersihan
Route::get('showformtarifkebersihan','tarifController@showTKebersihan')->name('showb');
Route::get('tambahkebersihan','tarifController@showKebersihan');
Route::get('updatekebersihan/{id}','tarifController@updateKebersihan')->name('uptrfB');
Route::post('update/storeB/{id}','tarifController@updateStoreB');
Route::post('storekebersihan','tarifController@storekebersihan');

//Laporan
Route::get('showlaporanharian','laporanController@showHarian');
Route::get('showlaporanharian/filter','laporanController@filterHarian');
Route::get('showlaporanbulanan','laporanController@showBulanan');
Route::get('showlaporanbulanan/filter','laporanController@filterBulanan');
Route::get('showlaporantahunan','laporanController@showTahunan');
Route::get('showlaporantagihan','laporanController@showTagihan')->name('lapTagihan');
Route::get('showlaporantunggakan','laporanController@showTunggakan');
Route::get('showlaporanbongkaran','laporanController@showBongkaran');
Route::get('showlaporanpenghapusan','laporanController@showPenghapusan');

//Tagihan
Route::get('datatagihannasabah/{id}','tagihanController@dataTagihan')->name('datatagihan');
Route::get('bayartagihan/{id}','tagihanController@bayarTagihan')->name('bayartagihan');
Route::post('bayaran/store/{id}','tagihanController@storeBayar');
Route::get('tambahtagihan','tagihanController@tagihanNas')->name('tagihan');
Route::get('showformtagihan/{id}','tagihanController@formtagihan')->name('showformtagihan');
Route::post('tagihan/store/{id}','tagihanController@storetagihan');
Route::get('semuatagihan','tagihanController@printTagihan');

//Tunggakan
Route::get('bayartunggakan','tunggakanController@bayarTunggakan');

//Meteran
Route::get('dataalat','meteranController@dataalat')->name('alat');
Route::get('tambahalat','meteranController@formalat')->name('formalat');
Route::post('storealat','meteranController@storealat');
    //AIR
Route::get('updatealatair/{id}','meteranController@updatealatair')->name('alatair');
Route::post('update/storealatair/{id}','meteranController@storeupdatealatair');
    //LISTRIK
Route::get('updatealatlistrik/{id}','meteranController@updatealatlistrik')->name('alatlistrik');
Route::post('update/storealatlistrik/{id}','meteranController@storeupdatealatlistrik');
    //Form
Route::get('printform','meteranController@printform');

//Hari Libur
Route::get('showdatalibur','liburanController@dataLibur');
Route::get('tambahlibur','liburanController@tambahLibur');
Route::post('storelibur','liburanController@storeLibur');

//User
Route::get('showdatauser','userController@showdatauser');
Route::get('showtambahuser','userController@tambahuser');

//Dashboard
Route::get('showdashboard','dashboardController@dashboard');
//ENDADMIN

//KASIR
Route::get('showtagihankasir','laporanController@showTagihanKasir')->name('lapTagihanKasir');
Route::get('datatagihankasir/{id}','tagihanController@dataTagihanKasir')->name('datatagihanKasir');
Route::get('bayartagihankasir/{id}','tagihanController@bayarTagihanKasir')->name('bayartagihanKasir');
Route::post('bayarankasir/store/{id}','tagihanController@storeBayarKasir');
Route::get('printstruk/{id}','tagihanController@printStrukKasir');
//ENDKASIR