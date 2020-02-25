<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nasabah;
use App\Jasa_air;
use App\Jasa_listrik;
use App\Jasa_ipkeamanan;
use App\Jasa_kebersihan;
use App\Tempat_usaha;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class nasabahController extends Controller
{
    //Nasabah
    public function showdata(){
        $dataset = DB::table('nasabah')->get();
        return view('admin.data-nasabah',['dataset'=>$dataset]);
    }
    public function showform(){
        return view('admin.tambah-nasabah');
    }
    public function store(Request $request){
        $data = new Nasabah([
            'nm_nasabah'=>$request->get('nama'),
            'no_ktp'=>$request->get('ktp'),
            'no_npwp'=>$request->get('npwp'),
            'no_tlp'=>$request->get('telpon')
        ]);
        $data->save();
        return redirect('showformnasabah')->with('alert-success','Data Tersimpan');
    }
    public function updateNasabah($id){
        $dataset = DB::table('nasabah')->where('ID_NASABAH',$id)->get();
        return view('admin.update-nasabah',['dataset'=>$dataset]);
    }
    public function updateStore(Request $request, $id){
        DB::table('nasabah')->where('ID_NASABAH', $id)->update([
            'NM_NASABAH'=>$request->get('nama'),
            'NO_KTP'=>$request->get('ktp'),
            'NO_NPWP'=>$request->get('npwp'),
            'NO_TLP'=>$request->get('telpon')
        ]);
        return redirect()->route('show');
    }

    //Tempat Usaha
    public function showtempatusaha(){
        $dataset = DB::table('tempat_usaha')
        ->leftJoin('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->leftJoin('tarif_air','tempat_usaha.ID_TRFAIR','=','tarif_air.ID_TRFAIR')
        ->leftJoin('tarif_listrik','tempat_usaha.ID_TRFLISTRIK','=','tarif_listrik.ID_TRFLISTRIK')
        ->leftJoin('tarif_ipk','tempat_usaha.ID_TRFIPK','=','tarif_ipk.ID_TRFIPK')
        ->leftJoin('tarif_keamanan','tempat_usaha.ID_TRFKEAMANAN','=','tarif_keamanan.ID_TRFKEAMANAN')
        ->leftJoin('tarif_kebersihan','tempat_usaha.ID_TRFKEBERSIHAN','=','tarif_kebersihan.ID_TRFKEBERSIHAN')
        ->select('tarif_ipk.ID_TRFIPK','tarif_keamanan.ID_TRFKEAMANAN','tarif_kebersihan.ID_TRFKEBERSIHAN','tarif_air.ID_TRFAIR','tarif_listrik.ID_TRFLISTRIK',
            'tempat_usaha.KD_KONTROL', 'nasabah.NM_NASABAH', 
            'tarif_ipk.TRF_IPK','tarif_keamanan.TRF_KEAMANAN','tarif_kebersihan.TRF_KEBERSIHAN',
            'tempat_usaha.NO_ALAMAT','tempat_usaha.JML_ALAMAT','tempat_usaha.BENTUK_USAHA',
            'tempat_usaha.NOMTR_AIR','tempat_usaha.NOMTR_LISTRIK', 'tempat_usaha.ID_TEMPAT','tempat_usaha.TGL_TEMPAT','tempat_usaha.DAYA')
        ->get();

        $datasets = json_decode($dataset, true);
        foreach($datasets as $data){
            if($data['ID_TRFAIR'] != null){
                $data_air = DB::table('jasa_air')->where('ID_TEMPAT',$data['ID_TEMPAT'])->get();
                if($data_air->isEmpty()){
                    $insert_air = new Jasa_air([
                        'id_tempat'=>$data['ID_TEMPAT'],
                        'tgl_jsair'=>$data['TGL_TEMPAT']
                    ]);
                    $insert_air->save();
                }
            }
            if($data['ID_TRFLISTRIK'] != null){
                $data_listrik = DB::table('jasa_listrik')->where('ID_TEMPAT',$data['ID_TEMPAT'])->get();
                if($data_listrik->isEmpty()){
                    $insert_listrik = new Jasa_listrik([
                        'id_tempat'=>$data['ID_TEMPAT'],
                        'tgl_jslistrik'=>$data['TGL_TEMPAT']
                    ]);
                    $insert_listrik->save();
                }
            }
            if($data['ID_TRFKEBERSIHAN'] != null){
                $data_kebersihan = DB::table('jasa_kebersihan')->where('ID_TEMPAT',$data['ID_TEMPAT'])->get();
                if($data_kebersihan->isEmpty()){
                    $insert_kebersihan = new Jasa_kebersihan([
                        'id_tempat'=>$data['ID_TEMPAT'],
                        'tgl_jskebersihan'=>$data['TGL_TEMPAT']
                    ]);
                    $insert_kebersihan->save();
                }
            }
            if($data['ID_TRFIPK'] != null){
                $data_keamanan = DB::table('jasa_ipkeamanan')->where('ID_TEMPAT',$data['ID_TEMPAT'])->get();
                if($data_keamanan->isEmpty()){
                    $insert_keamanan = new Jasa_ipkeamanan([
                        'id_tempat'=>$data['ID_TEMPAT'],
                        'tgl_jsipkeamanan'=>$data['TGL_TEMPAT']
                    ]);
                    $insert_keamanan->save();
                }
            }
        }

        $dataJasaAir = DB::table('jasa_air')
        ->join('tempat_usaha','tempat_usaha.ID_TEMPAT','=','jasa_air.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('jasa_air.TGL_JSAIR','tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH','tempat_usaha.NOMTR_AIR','tempat_usaha.BENTUK_USAHA')
        ->get();
        $dataJasaListrik = DB::table('jasa_listrik')
        ->join('tempat_usaha','tempat_usaha.ID_TEMPAT','=','jasa_listrik.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->select('jasa_listrik.TGL_JSLISTRIK','tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH','tempat_usaha.NOMTR_LISTRIK','tempat_usaha.BENTUK_USAHA','tempat_usaha.DAYA')
        ->get();
        $dataJasaKebersihan = DB::table('jasa_kebersihan')
        ->join('tempat_usaha','tempat_usaha.ID_TEMPAT','=','jasa_kebersihan.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->join('tarif_kebersihan','tempat_usaha.ID_TRFKEBERSIHAN','=','tarif_kebersihan.ID_TRFKEBERSIHAN')
        ->select('jasa_kebersihan.TGL_JSKEBERSIHAN','tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH','tarif_kebersihan.TRF_KEBERSIHAN','tempat_usaha.BENTUK_USAHA')
        ->get();
        $dataJasaKeamanan = DB::table('jasa_ipkeamanan')
        ->join('tempat_usaha','tempat_usaha.ID_TEMPAT','=','jasa_ipkeamanan.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->join('tarif_ipk','tempat_usaha.ID_TRFIPK','=','tarif_ipk.ID_TRFIPK')
        ->join('tarif_keamanan','tempat_usaha.ID_TRFKEAMANAN','=','tarif_keamanan.ID_TRFKEAMANAN')
        ->select('jasa_ipkeamanan.TGL_JSIPKEAMANAN','tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH','tarif_ipk.TRF_IPK','tarif_keamanan.TRF_KEAMANAN','tempat_usaha.BENTUK_USAHA')
        ->get();

        return view('admin.tempat-usaha',['dataset'=>$dataset,'dataJasaAir'=>$dataJasaAir,'dataJasaListrik'=>$dataJasaListrik,'dataJasaKebersihan'=>$dataJasaKebersihan,'dataJasaKeamanan'=>$dataJasaKeamanan]);


    }
    public function showformtempat(){
        $tarif_ipk = DB::table('tarif_ipk')->select('TRF_IPK','ID_TRFIPK')->get();
        $tarif_keamanan = DB::table('tarif_keamanan')->select('TRF_KEAMANAN','ID_TRFKEAMANAN')->get();
        $tarif_kebersihan = DB::table('tarif_kebersihan')->select('TRF_KEBERSIHAN','ID_TRFKEBERSIHAN')->get();
        return view('admin.tambah-tempat', ['tarif_ipk'=>$tarif_ipk,'tarif_keamanan'=>$tarif_keamanan,'tarif_kebersihan'=>$tarif_kebersihan]);
    }
    public function storeTempat(Request $request){
        //Kode Kontrol
        $blok = $request->get("blok"); 
        $los = $request->get("los"); 

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


        //Identitas
        $radio = $request->get('identitas');
        if($radio = "k")
            $nasabah = DB::table('nasabah')->select('ID_NASABAH')->where('no_ktp',$request->get('ktp'))->first();
        else
            $nasabah = DB::table('nasabah')->select('ID_NASABAH')->where('no_npwp',$request->get('npwp'))->first();
        
        $id_nas = $nasabah->ID_NASABAH;
        
        //fasilitas
        $mAir = $request->get('meterAir');
        $airId = 1;
        $mListrik = $request->get('meterListrik');
        $daya = $request->get('dayaListrik');
        $listrikId = 1;
        $kebersihanId = $request->get('kebersihanId');
        $ipkId = $request->get('ipkId');
        $keamananId = $request->get('keamananId');

        if(empty($request->get('air'))){
            $mAir = NULL;
            $airId = NULL;
        }
        if(empty($request->get('listrik'))){
            $mListrik = NULL;
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

        //Tambah Data
        $dataTempat = new Tempat_usaha([
            'blok'=>$request->get('blok'),
            'no_alamat'=>$request->get('los'),
            'daya'=>$daya,
            'jml_alamat'=>$jumLos,
            'bentuk_usaha'=>$request->get('bentuk_usaha'),
            'id_nasabah'=>$id_nas,
            'id_trfkebersihan'=>$kebersihanId,
            'id_trfipk'=>$ipkId,
            'id_trfkeamanan'=>$keamananId,
            'id_trflistrik'=>$listrikId,
            'id_trfair'=>$airId,
            'kd_kontrol'=>$join,
            'nomtr_air'=>$mAir,
            'nomtr_listrik'=>$mListrik
        ]);
        $dataTempat->save();
        return redirect('showformtempatusaha')->with('alert-success','Data Ditambah');
    }
    public function updateTempat($id){
        $dataset = DB::table('tempat_usaha')->where('ID_TEMPAT',$id)->get();

        //get value in row
        $dataku = DB::table('tempat_usaha')->where('ID_TEMPAT',$id)->first();
        $id_nasabah = $dataku->ID_NASABAH;
        $id_ipk = $dataku->ID_TRFIPK;
        $id_keamanan = $dataku->ID_TRFKEAMANAN;
        $id_kebersihan = $dataku->ID_TRFKEBERSIHAN;

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

        //identitas
        $nasabah = DB::table('nasabah')->where('id_nasabah', $id_nasabah)->first();
        $noktp = $nasabah->NO_KTP;
        $nonpwp = $nasabah->NO_NPWP;

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

        return view('admin.update-tempat',['dataset'=>$dataset,'noktp'=>$noktp,'nonpwp'=>$nonpwp,
                    'tarif_ipk'=>$tarif_ipk,'tarif_keamanan'=>$tarif_keamanan,'tarif_kebersihan'=>$tarif_kebersihan,
                    'trfipk'=>$trfipk,'id_ipk'=>$id_ipk,
                    'trfaman'=>$trfaman,'id_keamanan'=>$id_keamanan, 
                    'trfkebersihan'=>$trfkebersihan, 'id_kebersihan'=>$id_kebersihan
        ]);
    }
    public function updateStoreTempat(Request $request, $id){
        //Identitas
        $radio = $request->get('identitas');
        if($radio = "k")
            $nasabah = DB::table('nasabah')->select('ID_NASABAH')->where('no_ktp',$request->get('ktp'))->first();
        else
            $nasabah = DB::table('nasabah')->select('ID_NASABAH')->where('no_npwp',$request->get('npwp'))->first();
        
        $id_nas = $nasabah->ID_NASABAH;
        
        //fasilitas
        $mAir = $request->get('meterAir');
        $airId = 1;
        $mListrik = $request->get('meterListrik');
        $listrikId = 1;
        $kebersihanId = $request->get('kebersihanId');
        $ipkId = $request->get('ipkId');
        $keamananId = $request->get('keamananId');

        if(empty($request->get('air'))){
            $mAir = NULL;
            $airId = NULL;
        }
        if(empty($request->get('listrik'))){
            $mListrik = NULL;
            $listrikId = NULL;
        }
        if(empty($request->get('keamanan'))){
            $keamananId = NULL;
            $ipkId = NULL;
        }
        if(empty($request->get('kebersihan'))){
            $kebersihanId = NULL;
        }

        
        DB::table('tempat_usaha')->where('ID_TEMPAT', $id)->update([
            'BENTUK_USAHA'=>$request->get('bentuk_usaha'),
            'ID_NASABAH'=>$id_nas,
            'ID_TRFKEBERSIHAN'=>$kebersihanId,
            'ID_TRFIPK'=>$ipkId,
            'ID_TRFKEAMANAN'=>$keamananId,
            'ID_TRFLISTRIK'=>$listrikId,
            'ID_TRFAIR'=>$airId,
            'NOMTR_AIR'=>$mAir,
            'NOMTR_LISTRIK'=>$mListrik
        ]);
        return redirect()->route('tempat');
    }
}
