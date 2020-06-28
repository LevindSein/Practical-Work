<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nasabah;
use App\Blok;
use App\Tempat_usaha;
use App\Penghapusan;
use App\Pemilik;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;
use Exception;
use Illuminate\Support\Facades\Session;

class nasabahController extends Controller
{
    //Nasabah
    public function showdata(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){
        $dataset = DB::table('nasabah')->get();
        return view('admin.data-nasabah',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    public function showform(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){
        return view('admin.tambah-nasabah');
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    public function store(Request $request){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){
        try {
            $random = str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);
            $no_anggota = "BP3C".$random;
            
            $data = new Nasabah([
                'nm_nasabah'=>$request->get('nama'),
                'no_anggota'=>$no_anggota,
                'no_ktp'=>$request->get('ktp'),
                'no_npwp'=>$request->get('npwp'),
                'no_tlp'=>$request->get('telpon')
            ]);
            $data->save();
            $data = new Pemilik([
                'nm_pemilik'=>$request->get('nama'),
                'no_anggota'=>$no_anggota,
                'no_ktp'=>$request->get('ktp'),
                'no_npwp'=>$request->get('npwp'),
                'no_tlp'=>$request->get('telpon')
            ]);
            $data->save();
        }
        catch(\Exception $e){
            return redirect('showformnasabah')->with('warning','Data Sudah Digunakan');
        }
        return redirect('showformnasabah')->with('success','Data Ditambah');
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }
    public function updateNasabah($id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){
        $dataset = DB::table('nasabah')->where('ID_NASABAH',$id)->get();
        return view('admin.update-nasabah',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    public function updateStore(Request $request, $id){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){
        try{
            DB::table('nasabah')->where('ID_NASABAH', $id)->update([
                'NM_NASABAH'=>$request->get('nama'),
                'NO_KTP'=>$request->get('ktp'),
                'NO_NPWP'=>$request->get('npwp'),
                'NO_TLP'=>$request->get('telpon')
            ]);
            DB::table('pemilik')->where('ID_PEMILIK', $id)->update([
                'NM_PEMILIK'=>$request->get('nama'),
                'NO_KTP'=>$request->get('ktp'),
                'NO_NPWP'=>$request->get('npwp'),
                'NO_TLP'=>$request->get('telpon')
            ]);
        }
        catch(\Exception $e){
            return redirect()->back()->with('error','Data Gagal Disimpan');    
        }
        return redirect()->route('show')->with('success','Data Tersimpan');
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }

    }

    //Tempat Usaha
    public function showtempatusaha(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->leftJoin('pemilik','tempat_usaha.ID_PEMILIK','=','pemilik.ID_PEMILIK')
        ->leftJoin('meteran_air','tempat_usaha.ID_MAIR','=','meteran_air.ID_MAIR')
        ->leftJoin('meteran_listrik','tempat_usaha.ID_MLISTRIK','=','meteran_listrik.ID_MLISTRIK')
        ->leftJoin('tarif_air','tempat_usaha.ID_TRFAIR','=','tarif_air.ID_TRFAIR')
        ->leftJoin('tarif_listrik','tempat_usaha.ID_TRFLISTRIK','=','tarif_listrik.ID_TRFLISTRIK')
        ->leftJoin('tarif_ipk','tempat_usaha.ID_TRFIPK','=','tarif_ipk.ID_TRFIPK')
        ->leftJoin('tarif_keamanan','tempat_usaha.ID_TRFKEAMANAN','=','tarif_keamanan.ID_TRFKEAMANAN')
        ->leftJoin('tarif_kebersihan','tempat_usaha.ID_TRFKEBERSIHAN','=','tarif_kebersihan.ID_TRFKEBERSIHAN')
        ->select('tarif_ipk.ID_TRFIPK','tarif_keamanan.ID_TRFKEAMANAN','tarif_kebersihan.ID_TRFKEBERSIHAN',
            'tarif_air.ID_TRFAIR','tarif_listrik.ID_TRFLISTRIK',
            'tempat_usaha.KD_KONTROL', 'nasabah.NM_NASABAH','pemilik.NM_PEMILIK',
            'meteran_air.NOMTR_AIR','meteran_listrik.NOMTR_LISTRIK', 
            'tarif_ipk.TRF_IPK','tarif_keamanan.TRF_KEAMANAN','tarif_kebersihan.TRF_KEBERSIHAN',
            'tempat_usaha.NO_ALAMAT','tempat_usaha.JML_ALAMAT','tempat_usaha.BENTUK_USAHA',
            'tempat_usaha.ID_TEMPAT','tempat_usaha.TGL_TEMPAT','tempat_usaha.DAYA',
            'tempat_usaha.ID_TRFAIR','tempat_usaha.ID_TRFLISTRIK','tempat_usaha.STT_CICIL')
        ->get();

        return view('admin.tempat-usaha',['dataset'=>$dataset]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    
    public function showformtempat(){
        if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $tarif_ipk = DB::table('tarif_ipk')->select('TRF_IPK','ID_TRFIPK')->get();
        $tarif_keamanan = DB::table('tarif_keamanan')->select('TRF_KEAMANAN','ID_TRFKEAMANAN')->get();
        $tarif_kebersihan = DB::table('tarif_kebersihan')->select('TRF_KEBERSIHAN','ID_TRFKEBERSIHAN')->get();
        return view('admin.tambah-tempat', ['tarif_ipk'=>$tarif_ipk,'tarif_keamanan'=>$tarif_keamanan,'tarif_kebersihan'=>$tarif_kebersihan]);
            }
            else{
                abort(403, 'Oops! Access Forbidden');
            }
        }
    }
    public function storeTempat(Request $request){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        //Kode Kontrol
        $bl = $request->get("blok");
        $blok = strtoupper($bl);
        $los = $request->get("los");
        $losKap = strtoupper($los);

        $split = preg_split ('/,/', $los);
        $variable = $split[0];
        $aa = str_split($variable,1);
        $hitung = count($aa);
        $tt=array();
        $huruf="";
        $jumLos = count($split);

        if (is_numeric($aa[0]))
        {
            if(ctype_alpha($aa[$hitung-1])){
                for($j=0;$j<=$hitung-1;$j++){
                    if(ctype_alpha($aa[$j])){
                        $tt[$j]=$aa[$j];
                        $huruf=$huruf.$tt[$j];
                    }
                }
                $x = strtoupper($huruf);
                $bb = $aa[0];
                for($i=1; $i<$hitung-1; $i++){
                    $bb = $bb.$aa[$i];
                }
                $cc = (int)$bb;
                $dd = sprintf("%'03d",$cc);
                $cc = (string)$dd;
                $ff = $cc.$x;
                $join = $blok."-".$ff;
            }
            else{
                $format = sprintf("%'03d",$split[0]);
                $join = $blok."-".$format;
            }    
        }
        else {
            $join = $blok."-".$split[0];
        }

        $nomor_ktp = explode(" - ",$request->get('ktp'));
        $nomor_ktp = $nomor_ktp[0];
        $nomor_npwp = explode(" - ",$request->get('npwp'));
        $nomor_npwp = $nomor_npwp[0];
        $nomor_anggota = explode(" - ",$request->get('anggota'));
        $nomor_anggota = $nomor_anggota[0];

        //Identitas
        $radio = $request->get('identitas');
        if($radio == "k"){
            $nasabah = DB::table('nasabah')->select('ID_NASABAH')->where('no_ktp',$nomor_ktp)->first();
        }
        else if($radio == "n"){
            $nasabah = DB::table('nasabah')->select('ID_NASABAH')->where('no_npwp',$nomor_npwp)->first();
        }
        else{
            $nasabah = DB::table('nasabah')->select('ID_NASABAH')->where('no_anggota',$nomor_anggota)->first();
        }

        $mAir = DB::table('meteran_air')->select('ID_MAIR')->where('id_mair',$request->get('meterAir'))->first();
        $mListrik = DB::table('meteran_listrik')->select('ID_MLISTRIK')->where('id_mlistrik',$request->get('meterListrik'))->first();

        if(!empty($request->get('air')))
            $id_mair = $mAir->ID_MAIR;

        $id_nas = $nasabah->ID_NASABAH;

        if(!empty($request->get('listrik')))
            $id_mlistrik = $mListrik->ID_MLISTRIK;
        
        //fasilitas
        $airId = 1;
        $daya = $request->get('dayaListrik');
        $listrikId = 1;
        $kebersihanId = $request->get('kebersihanId');
        $ipkId = $request->get('ipkId');
        $keamananId = $request->get('keamananId');

        if(empty($request->get('air'))){
            $id_mair = NULL;
            $airId = NULL;
        }
        if(empty($request->get('listrik'))){
            $id_mlistrik = NULL;
            $daya = NULL;
            $listrikId = NULL;
        }
        if(empty($request->get('keamanan'))){
            $keamananId = NULL;
            $ipkId = NULL;
        }
        if(empty($request->get('kebersihan'))){
            $kebersihanId = NULL;
        }

        $user = DB::table('tempat_usaha')
        ->select('ID_USER')
        ->where('BLOK',$blok)
        ->first();
        $userId = $user->ID_USER;

        //Tambah Data
        try {
            $dataBlok = new Blok([
                'nm_blok'=>$blok
            ]);
            $dataBlok->save();  
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
            }
        }

        $dataTempat = new Tempat_usaha([
            'blok'=>$blok,
            'no_alamat'=>$losKap,
            'kd_kontrol'=>$join,
            'daya'=>$daya,
            'jml_alamat'=>$jumLos,
            'bentuk_usaha'=>$request->get('bentuk_usaha'),
            'id_nasabah'=>$id_nas,
            'id_pemilik'=>$id_nas,
            'id_user'=>$userId,
            'id_trfkebersihan'=>$kebersihanId,
            'id_trfipk'=>$ipkId,
            'id_trfkeamanan'=>$keamananId,
            'id_trflistrik'=>$listrikId,
            'id_trfair'=>$airId,
            'id_mair'=>$id_mair,
            'id_mlistrik'=>$id_mlistrik
        ]);
        $dataTempat->save();
    } catch(\Exception $e){
        return redirect('showformtempatusaha')->with('error','Data Gagal Ditambah, Identitas Tidak ada atau Meteran Terpakai');
    }
        return redirect('showformtempatusaha')->with('success','Data Ditambah');
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }

    public function updateTempat($id){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        $dataset = DB::table('tempat_usaha')->where('ID_TEMPAT',$id)->get();

        //get value in row
        $dataku = DB::table('tempat_usaha')->where('ID_TEMPAT',$id)->first();
        $id_mair = $dataku->ID_MAIR;
        $id_mlistrik = $dataku->ID_MLISTRIK;
        $id_air = $dataku->ID_TRFAIR;
        $id_listrik = $dataku->ID_TRFLISTRIK;
        $id_nasabah = $dataku->ID_NASABAH;
        $id_pemilik = $dataku->ID_PEMILIK;
        $id_ipk = $dataku->ID_TRFIPK;
        $id_keamanan = $dataku->ID_TRFKEAMANAN;
        $id_kebersihan = $dataku->ID_TRFKEBERSIHAN;
        $izin_cicil = $dataku->STT_CICIL;

        //tarif ipk & keamanan
        if($id_ipk != null && $id_keamanan != null)
        {
            $tipk = DB::table('tarif_ipk')->where('id_trfipk', $id_ipk)->first();
            $taman = DB::table('tarif_keamanan')->where('id_trfkeamanan', $id_keamanan)->first();
            $trfipk = $tipk->TRF_IPK;
            $trfaman = $taman->TRF_KEAMANAN;
        }
        else{
            $trfipk = "Pilih Tarif";
            $trfaman = "Pilih Tarif";
        }

        //pemilik
        $nasabah = DB::table('pemilik')->where('id_pemilik', $id_pemilik)->first();
        $noktp = $nasabah->NO_KTP;
        $nonpwp = $nasabah->NO_NPWP;
        $noanggota = $nasabah->NO_ANGGOTA;

        //pengguna
        $nasabah1 = DB::table('nasabah')->where('id_nasabah', $id_nasabah)->first();
        $noktp1 = $nasabah1->NO_KTP;
        $nonpwp1 = $nasabah1->NO_NPWP;
        $noanggota1 = $nasabah1->NO_ANGGOTA;

        //tarif kebersihan
        if($id_kebersihan != null)
        {
            $tbersih = DB::table('tarif_kebersihan')->where('id_trfkebersihan', $id_kebersihan)->first();
            $trfkebersihan = $tbersih->TRF_KEBERSIHAN;
        }
        else
            $trfkebersihan = "Pilih Tarif";

        //selection
        $tarif_ipk = DB::table('tarif_ipk')->select('TRF_IPK','ID_TRFIPK')->get();
        $tarif_keamanan = DB::table('tarif_keamanan')->select('TRF_KEAMANAN','ID_TRFKEAMANAN')->get();
        $tarif_kebersihan = DB::table('tarif_kebersihan')->select('TRF_KEBERSIHAN','ID_TRFKEBERSIHAN')->get();
        return view('admin.update-tempat',['dataset'=>$dataset,'noktp'=>$noktp,'nonpwp'=>$nonpwp,'noanggota'=>$noanggota,
                    'noktp1'=>$noktp1,'nonpwp1'=>$nonpwp1,'noanggota1'=>$noanggota1,
                    'tarif_ipk'=>$tarif_ipk,'tarif_keamanan'=>$tarif_keamanan,'tarif_kebersihan'=>$tarif_kebersihan,
                    'trfipk'=>$trfipk,'id_ipk'=>$id_ipk,
                    'trfaman'=>$trfaman,'id_keamanan'=>$id_keamanan, 
                    'trfkebersihan'=>$trfkebersihan, 'id_kebersihan'=>$id_kebersihan,
                    'id_air'=>$id_air,'id_listrik'=>$id_listrik,'izin_cicil'=>$izin_cicil
        ]);
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }

    public function updateStoreTempat(Request $request, $id){
    	if(!Session::get('login')){
            return redirect('login')->with('error','Silahkan Login Terlebih Dahulu');
        }
        else{
            if(Session::get('role') == "Super Admin"){

        try{
        $kosong = "(kosong)";
        //Penghapusan
        if(empty($request->get('air')) && empty($request->get('listrik')) && empty($request->get('keamanan')) && empty($request->get('kebersihan'))){
            DB::table('tempat_usaha')->where('ID_TEMPAT', $id)->update([
                'BENTUK_USAHA'=>$kosong,
                'ID_TRFKEBERSIHAN'=>null,
                'ID_TRFIPK'=>null,
                'ID_TRFKEAMANAN'=>null,
                'ID_TRFLISTRIK'=>null,
                'ID_TRFAIR'=>null
            ]);
            
            $dataku = DB::table('tempat_usaha')->where('ID_TEMPAT',$id)->first();
            $id_nasabah = $dataku->ID_NASABAH;
            //identitas
            $nasabah = DB::table('nasabah')->where('id_nasabah', $id_nasabah)->first();
            $nama = $nasabah->NM_NASABAH;
            $noktp = $nasabah->NO_KTP;
            $nonpwp = $nasabah->NO_NPWP;
            $noanggota = $nasabah->NO_ANGGOTA;

            $tunggakan = DB::table('tagihanku')
            ->select(
                     DB::raw('SUM(SELISIH) as selisih'),
                     DB::raw('SUM(DENDA) as denda'))
            ->groupBy('ID_TEMPAT')
            ->where([
                ['STT_LUNAS',0],
                ['ID_TEMPAT',$id]
            ])
            ->first();

            if($tunggakan == null){
                $ttl = 0;
            }
            else{
                $ttl = $tunggakan->selisih + $tunggakan->denda;
            }
            var_dump($ttl);

            $data = new Penghapusan([
                'id_tempat'=>$id,
                'nama'=>$nama,
                'nmr_anggota'=>$noanggota,
                'nmr_ktp'=>$noktp,
                'nmr_npwp'=>$nonpwp,
                'ttl_tunggakan'=>$ttl
            ]);
            $data->save();
            DB::table('tagihanku')->where('id_tempat',$id)->delete();
        }
        else{
            
            $nomor_ktp = explode(" - ",$request->get('ktp'));
            $nomor_ktp = $nomor_ktp[0];
            $nomor_npwp = explode(" - ",$request->get('npwp'));
            $nomor_npwp = $nomor_npwp[0];
            $nomor_anggota = explode(" - ",$request->get('anggota'));
            $nomor_anggota = $nomor_anggota[0];
            $nomor_ktp1 = explode(" - ",$request->get('ktp1'));
            $nomor_ktp1 = $nomor_ktp1[0];
            $nomor_npwp1 = explode(" - ",$request->get('npwp1'));
            $nomor_npwp1 = $nomor_npwp1[0];
            $nomor_anggota1 = explode(" - ",$request->get('anggota1'));
            $nomor_anggota1 = $nomor_anggota1[0];

            //pemilik
            $radio = $request->get('identitas');
            if($radio == "k"){
                $nasabah = DB::table('pemilik')->select('ID_PEMILIK')->where('no_ktp',$nomor_ktp)->first();
            }
            else if($radio == "n"){
                $nasabah = DB::table('pemilik')->select('ID_PEMILIK')->where('no_npwp',$nomor_npwp)->first();
            }
            else{
                $nasabah = DB::table('pemilik')->select('ID_PEMILIK')->where('no_anggota',$nomor_anggota)->first();
            }

            //pengguna
            $radio1 = $request->get('identitas1');
            if($radio1 == "k1"){
                $nasabah1 = DB::table('nasabah')->select('ID_NASABAH')->where('no_ktp',$nomor_ktp1)->first();
            }
            else if($radio1 == "n1"){
                $nasabah1 = DB::table('nasabah')->select('ID_NASABAH')->where('no_npwp',$nomor_npwp1)->first();
            }
            else{
                $nasabah1 = DB::table('nasabah')->select('ID_NASABAH')->where('no_anggota',$nomor_anggota1)->first();
            }
        
            $mAir = DB::table('meteran_air')->select('ID_MAIR')->where('id_mair',$request->get('meterAir'))->first();
            $mListrik = DB::table('meteran_listrik')->select('ID_MLISTRIK')->where('id_mlistrik',$request->get('meterListrik'))->first();    

            // $id_mair = $mAir->ID_MAIR;
            // $id_mlistrik = $mListrik->ID_MLISTRIK;
            $id_pemilik = $nasabah->ID_PEMILIK;
            $id_nas = $nasabah1->ID_NASABAH;
        
            //fasilitas
            $daya = $request->get('dayaListrik');
            $airId = 1;
            $listrikId = 1;
            $kebersihanId = $request->get('kebersihanId');
            $ipkId = $request->get('ipkId');
            $keamananId = $request->get('keamananId');

            //air
            if(empty($request->get('air'))){
                // $id_mair = NULL;
                $airId = NULL;
            }
            //listrik
            if(empty($request->get('listrik'))){
                // $id_mlistrik = NULL;
                $listrikId = NULL;
            }
            //keamanan
            if(empty($request->get('keamanan'))){
                $keamananId = NULL;
                $ipkId = NULL;
            }
            //kebersihan
            if(empty($request->get('kebersihan'))){
                $kebersihanId = NULL;
            }
        
            //cicilan
            $cicilan = $request->get('cicilan');
            if($cicilan == "1"){
                $cicil = 1;
            }
            else{
                $cicil = 0;
            }

            DB::table('tempat_usaha')->where('ID_TEMPAT', $id)->update([
                'BENTUK_USAHA'=>$request->get('bentuk_usaha'),
                'ID_NASABAH'=>$id_nas,
                'ID_PEMILIK'=>$id_pemilik,
                'ID_TRFKEBERSIHAN'=>$kebersihanId,
                'ID_TRFIPK'=>$ipkId,
                'ID_TRFKEAMANAN'=>$keamananId,
                'ID_TRFLISTRIK'=>$listrikId,
                'ID_TRFAIR'=>$airId,
                'DAYA'=>$daya,
                'STT_CICIL'=>$cicil
            ]);
        }
    } catch(\Exception $e){
        return redirect()->back()->with('error','Data Gagal Disimpan');
    }
        return redirect()->route('tempat')->with('success','Data Tersimpan');
        }
        else{
            abort(403, 'Oops! Access Forbidden');
        }
    }
    }
}
