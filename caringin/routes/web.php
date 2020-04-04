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

//LOGIN
Route::get('login','Auth\LoginController@index')->name('index');
Route::post('storelogin','Auth\LoginController@storeLogin');
//LOGOUT
Route::get('logout','Auth\LoginController@logoutUser');

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
Route::get('showlaporanbongkaran','laporanController@showBongkaran')->name('bongkaran');

Route::get('showlaporanpenghapusan','laporanController@showPenghapusan');
Route::get('bongkaralat/{id}/{selAir}/{selListrik}/{selKeamanan}/{selKebersihan}/{denAir}/{denListrik}','laporanController@bongkarAlat');
Route::get('printperingatan/{id}/{selAir}/{selListrik}/{selKeamanan}/{selKebersihan}/{denAir}/{denListrik}/{exp}/{tglTagihan}','laporanController@printPeringatan');

Route::get('showpemakaian','laporanController@showPemakaian');
Route::get('print/rekapair/{bln}','laporanController@printRekapAir');
Route::get('print/rincianair/{bln}','laporanController@printRincianAir');
Route::get('print/rekaplistrik/{bln}','laporanController@printRekapListrik');
Route::get('print/rincianlistrik/{bln}','laporanController@printRincianListrik');
Route::get('print/rekapkebersihan/{bln}','laporanController@printRekapKebersihan');
Route::get('print/rinciankebersihan/{bln}','laporanController@printRincianKebersihan');
Route::get('print/rekapkeamanan/{bln}','laporanController@printRekapKeamanan');
Route::get('print/rinciankeamanan/{bln}','laporanController@printRincianKeamanan');

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
Route::get('gantialat','meteranController@gantialat')->name('ganti');
Route::get('updategantialatair/{id}','meteranController@updategantialatair')->name('updategantiair');
Route::get('updategantialatlistrik/{id}','meteranController@updategantialatlistrik')->name('updategantilistrik');
Route::post('update/storegantialatair/{id}','meteranController@storegantialatair');
Route::post('update/storegantialatlistrik/{id}','meteranController@storegantialatlistrik');
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
Route::get('showdatauser','userController@showdatauser')->name('datauser');
Route::get('showtambahuser','userController@tambahuser');
Route::post('storeuser','userController@storeUser');

//Dashboard
Route::get('showdashboard','dashboardController@dashboard')->name('showdashboard');
//ENDADMIN

//ADMINNORMAL
Route::get('tambahtagihan/admin','tagihanController@tagihanNasAdmin')->name('tagihanAdmin');
Route::get('showformtagihan/admin/{id}','tagihanController@formtagihanAdmin')->name('showformtagihanAdmin');
Route::post('tagihan/store/admin/{id}','tagihanController@storetagihanAdmin');
//ENDADMINNORMAL

//KASIR
Route::get('showtagihankasir','laporanController@showTagihanKasir')->name('lapTagihanKasir');
Route::get('datatagihankasir/{id}','tagihanController@dataTagihanKasir')->name('datatagihanKasir');
Route::get('all/datatagihankasir/{id}','tagihanController@dataTagihanKasirAll')->name('datatagihanKasirAll');
Route::get('bayartagihankasir/{id}','tagihanController@bayarTagihanKasir')->name('bayartagihanKasir');
Route::post('bayarankasir/store/{id}','tagihanController@storeBayarKasir');
Route::get('printstruk/{id}','tagihanController@printStrukKasir');
Route::get('penerimaanharian','tagihanController@penerimaan');
Route::post('checkout/tagihan/{id}','tagihanController@checkout');
Route::post('storecheckout','tagihanController@storeCheckout');
Route::get('print/penerimaan/{tgl}','tagihanController@printPenerimaan');
//ENDKASIR

//KEUANGAN
Route::get('showpenerimaanharian','laporanController@showPenerimaanHarian')->name('showpenerimaanharian');
Route::get('showpenerimaanbulanan','laporanController@showPenerimaanBulanan');
Route::get('showpendapatantahunan','laporanController@showPendapatanTahunan');
Route::get('print/harian/keuangan/{tgl}','laporanController@printHarianKeuangan');
Route::get('print/bulanan/keuangan/{bln}','laporanController@printBulananKeuangan');
Route::get('print/bulananno/keuangan/{bln}','laporanController@printBulananNoKeuangan');
Route::get('print/rincian/keuangan/{bln}','laporanController@printRincianKeuangan');
Route::get('print/rincianno/keuangan/{bln}','laporanController@printRincianNoKeuangan');
Route::get('print/tahunan/keuangan/{thn}','laporanController@printTahunanKeuangan');
//ENDKEUANGAN

//MANAJER
Route::get('showdashboardmanager','dashboardController@dashboardManager')->name('showdashboardmanajer');
Route::get('showlaporanharianmanager','laporanController@showHarianManager');
Route::get('showlaporanharianmanager/filter','laporanController@filterHarianManager');
Route::get('showlaporanbulananmanager','laporanController@showBulananManager');
Route::get('showlaporanbulananmanager/filter','laporanController@filterBulananManager');
Route::get('showlaporantahunanmanager','laporanController@showTahunanManager');
Route::get('showpemakaianmanager','laporanController@showPemakaianManager');
Route::get('tempatusahamanager','laporanController@tempatUsahaManager');
Route::get('showlaporantagihanmanager','laporanController@showTagihanManager')->name('lapTagihanManager');
Route::get('datatagihanmanager/{id}','tagihanController@dataTagihanManager')->name('datatagihanManager');

Route::get('print/harian/manajer/{tgl}','laporanController@printHarianManajer');
Route::get('print/bulanan/manajer/{bln}','laporanController@printBulananManajer');
Route::get('print/rincian/manajer/{bln}','laporanController@printRincianManajer');
Route::get('print/tahunan/manajer/{thn}','laporanController@printTahunanManajer');
Route::get('print/rekapair/manajer/{bln}','laporanController@printRekapAirManajer');
Route::get('print/rincianair/manajer/{bln}','laporanController@printRincianAirManajer');
Route::get('print/rekaplistrik/manajer/{bln}','laporanController@printRekapListrikManajer');
Route::get('print/rincianlistrik/manajer/{bln}','laporanController@printRincianListrikManajer');
Route::get('print/rekapkebersihan/manajer/{bln}','laporanController@printRekapKebersihanManajer');
Route::get('print/rinciankebersihan/manajer/{bln}','laporanController@printRincianKebersihanManajer');
Route::get('print/rekapkeamanan/manajer/{bln}','laporanController@printRekapKeamananManajer');
Route::get('print/rinciankeamanan/manajer/{bln}','laporanController@printRincianKeamananManajer');
Route::get('print/tempat/manajer','laporanController@printTempatManajer');
//ENDMANAJER