<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Meteran_air;
use App\Meteran_listrik;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class meteranController extends Controller
{
    //meteran air
    public function updatealatair($id){
        $dataset = DB::table('meteran_air')->where('ID_MAIR',$id)->get();
        return view('admin.update-alat-air',['dataset'=>$dataset]);
    }
    public function storeupdatealatair(Request $request, $id){
        DB::table('meteran_air')->where('ID_MAIR', $id)->update([
            'NOMTR_AIR'=>$request->get('noalat'),
            'MAKHIR_AIR'=>$request->get('meteranair')
        ]);
        return redirect()->route('alat');
    }

    //meteran listrik
    public function updatealatlistrik($id){
        $dataset = DB::table('meteran_listrik')->where('ID_MLISTRIK',$id)->get();
        return view('admin.update-alat-listrik',['dataset'=>$dataset]);
    }
    public function storeupdatealatlistrik(Request $request, $id){
        DB::table('meteran_listrik')->where('ID_MLISTRIK', $id)->update([
            'NOMTR_LISTRIK'=>$request->get('noalat'),
            'MAKHIR_LISTRIK'=>$request->get('meteranlistrik')
        ]);
        return redirect()->route('alat');
    }

    public function dataalat(){
        $datasetA = DB::table('meteran_air')->get();
        $datasetL = DB::table('meteran_listrik')->get();
        return view('admin.data-alat',['datasetA'=>$datasetA,'datasetL'=>$datasetL]);
    }
    public function formalat(){
        return view('admin.tambah-alat');
    }
    public function storealat(Request $request){
        $radio = $request->get('alat');
        if($radio == "A"){
            $dataA = new Meteran_air([
                'nomtr_air'=>$request->get('noalat'),
                'makhir_air'=>$request->get('meteran')
            ]);
            $dataA->save();
        }
        else{
            $dataL = new Meteran_listrik([
                'nomtr_listrik'=>$request->get('noalat'),
                'makhir_listrik'=>$request->get('meteran')
            ]);
            $dataL->save();
        }
    
        return redirect('dataalat')->with('alert-success','Data Tersimpan');
    }

    public function printform(){
        $dataAir = DB::table('jasa_air')
        ->join('tempat_usaha','tempat_usaha.ID_TEMPAT','=','jasa_air.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->join('meteran_air','tempat_usaha.ID_MAIR','=','meteran_air.ID_MAIR')
        ->select('tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH','meteran_air.NOMTR_AIR','meteran_air.MAKHIR_AIR')
        ->get();
        $dataListrik = DB::table('jasa_listrik')
        ->join('tempat_usaha','tempat_usaha.ID_TEMPAT','=','jasa_listrik.ID_TEMPAT')
        ->join('nasabah','tempat_usaha.ID_NASABAH','=','nasabah.ID_NASABAH')
        ->join('meteran_listrik','tempat_usaha.ID_MLISTRIK','=','meteran_listrik.ID_MLISTRIK')
        ->select('tempat_usaha.KD_KONTROL','nasabah.NM_NASABAH','meteran_listrik.NOMTR_LISTRIK','meteran_listrik.MAKHIR_LISTRIK')
        ->get();

        return view('admin.print-form',['dataAir'=>$dataAir,'dataListrik'=>$dataListrik]);
    }
}