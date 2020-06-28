<?php
use App\Blok;
use App\Nasabah;
use App\Meteran_air;
use App\Meteran_listrik;
use Illuminate\Support\Facades\DB;

$dataset = DB::table('blok')
  ->select('NM_BLOK')
  ->get();
$blok = array();
for($i = 0; $i < $dataset->count(); $i++){
  $blok[$i] = $dataset[$i]->NM_BLOK;
}

$dataset1 = DB::table('nasabah')
  ->select('NM_NASABAH','NO_ANGGOTA','NO_KTP','NO_NPWP')
  ->get();
$anggota = array();
$ktp = array();
$npwp = array();
for($j = 0; $j < $dataset1->count(); $j++){
  $anggota[$j] = $dataset1[$j]->NO_ANGGOTA." - ".$dataset1[$j]->NM_NASABAH;
  $ktp[$j] = $dataset1[$j]->NO_KTP." - ".$dataset1[$j]->NM_NASABAH;
  $npwp[$j] = $dataset1[$j]->NO_NPWP." - ".$dataset1[$j]->NM_NASABAH;
}

$meterAir = DB::table('meteran_air')
  ->select('ID_MAIR','NOMTR_AIR')
  ->get();
$mAir = array();
for($k = 0; $k < $meterAir->count(); $k++){
  $mAir[$k] = $meterAir[$k]->ID_MAIR." - ".$meterAir[$k]->NOMTR_AIR;
}

$meterListrik = DB::table('meteran_listrik')
  ->select('ID_MLISTRIK','NOMTR_LISTRIK')
  ->get();
$mListrik = array();
for($L = 0; $L < $meterListrik->count(); $L++){
  $mListrik[$L] = $meterListrik[$L]->ID_MLISTRIK." - ".$meterListrik[$L]->NOMTR_LISTRIK;
}
?>
<?php
    $role = Session::get('role');
?>


@extends( $role == 'Super Admin' ? 'admin.layout' : 'normal.layout')
@section('content')

       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Tambah Tempat Usaha</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
              <form autocomplete="off" class="user" action="storetempat" method="POST">
              @csrf
                <div class="autocomplete">
                  Blok
                  <input required name="blok" style="text-transform: uppercase;" type="text" class="form-control form-control-user" id="exampleInputKodeBlok" placeholder="A-1">
                </div>
                <div class="form-group">
                  No. Los
                  <input required name="los" style="text-transform: uppercase;" type="text" class="form-control form-control-user" id="exampleInputBanyakLos" placeholder="1, 2, 2A">
                </div>
                <div class="form-group">
                  Bentuk Usaha
                  <input required name="bentuk_usaha" style="text-transform: capitalize;" type="text" class="form-control form-control-user" id="exampleInputBentukUsaha" placeholder="Misal : Penjual Buah">
                </div>
                <div class="form-group row">
                  <div class="col-sm-2">Identitas</div>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="identitas" id="myRadioKTP" value="k" checked>
                      <label class="form-check-label" for="myRadioKTP">
                        KTP
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="identitas" id="myRadioNPWP" value="n">
                      <label class="form-check-label" for="myRadioNPWP">
                        NPWP
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="identitas" id="myRadioAnggota" value="a">
                      <label class="form-check-label" for="myRadioAnggota">
                        No.Anggota
                      </label>
                    </div>
                  </div>
                </div>

                <!-- Hidden Identitas -->
                <div class="autocomplete" style="display:none" id="myDivKTP">
                  No. KTP
                  <input name="ktp" type="text" class="form-control form-control-user inline-block" id="ktpku" placeholder="1484xxxx">
                  <a href="{{url('showformnasabah')}}">Nasabah Tidak Ada ?</a>
                </div>
                <div class="autocomplete" style="display:none" id="myDivNPWP">
                  No. NPWP
                  <input name="npwp" type="text" class="form-control form-control-user" id="npwpku" placeholder="261xxxxxx">
                  <a href="{{url('showformnasabah')}}">Nasabah Tidak Ada ?</a>
                </div>
                <div class="autocomplete" style="display:none" id="myDivAnggota">
                  No. Anggota
                  <input name="anggota" type="text" class="form-control form-control-user" id="anggotaku" placeholder="BP3C261xxxxx">
                  <a href="{{url('showformnasabah')}}">Nasabah Tidak Ada ?</a>
                </div>

                <div class="form-group row">
                  <div class="col-sm-2">Fasilitas</div>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="air" id="myCheck1" value="a" data-related-item="myDiv1">
                      <label class="form-check-label" for="myCheck1">
                        Air
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="listrik" id="myCheck2" value="l" data-related-item="myDiv2">
                      <label class="form-check-label" for="myCheck2">
                        Listrik
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="keamanan" id="myCheck3" data-related-item="myDiv3">
                      <label class="form-check-label" for="myCheck3">
                        IPK & Keamanan
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="kebersihan" id="myCheck4" data-related-item="myDiv4">
                      <label class="form-check-label" for="myCheck4">
                        Kebersihan
                      </label>
                    </div>
                  </div>
                </div>
                
                <!-- Hidden Fasilitas -->
                <div class="autocomplete" style="display:none">
                  ID Alat Meter Air
                  <input type="text" class="form-control form-control-user" name="meterAir"  id="myDiv1" placeholder="1xx">
                  <a href="{{url('dataalat')}}">Data Alat disini !</a>
                </div>
                <div class="autocomplete" style="display:none">
                  Daya
                  <input type="number" min="0" class="form-control form-control-user" name="dayaListrik" id="dayaL" placeholder="12xx">  
                  <br>
                  ID Alat Meter Listrik
                  <input type="text" class="form-control form-control-user" name="meterListrik" id="myDiv2" placeholder="1xx">
                  <a href="{{url('dataalat')}}">Data Alat disini !</a>
                </div>
                <div class="form-group" style="display:none">
                  <label for="sel1">Kategori Tarif IPK</label>
                  <select class="form-control" name="ipkId" id="myDiv3">
                    <option disabled selected hidden>Pilih Tarif</option>
                    @foreach($tarif_ipk as $data)
                    <option value='{{$data->ID_TRFIPK}}'>{{$data->TRF_IPK}}</option>
                    @endforeach
                  </select>
                  <br>
                  <label for="sel1">Kategori Tarif Keamanan</label>
                  <select class="form-control" name="keamananId">
                    <option disabled selected hidden>Pilih Tarif</option>
                    @foreach($tarif_keamanan as $data)
                    <option value='{{$data->ID_TRFKEAMANAN}}'>{{$data->TRF_KEAMANAN}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group" style="display:none">
                  <label for="sel1">Kategori Tarif Kebersihan</label>
                  <select class="form-control" name="kebersihanId" id="myDiv4">
                    <option disabled selected hidden>Pilih Tarif</option>
                    @foreach($tarif_kebersihan as $data)
                    <option value="{{$data->ID_TRFKEBERSIHAN}}">{{$data->TRF_KEBERSIHAN}}</option>
                    @endforeach
                  </select>
                </div>
                

                <input type="submit" value="Tambah Tempat" class="btn btn-primary btn-user btn-block">
              </form>
              
            </div>
          </div>
        </div>
      </div>
    <!-- End of Main Content -->
@endsection

@section('js')
  <!-- Fasilitas Button -->
  <script>
  function evaluate(){
    var item = $(this);
    var relatedItem = $("#" + item.attr("data-related-item")).parent();
   
    if(item.is(":checked")){
        relatedItem.fadeIn();
    }else{
        relatedItem.fadeOut();   
    }
  }
  $('input[type="checkbox"]').click(evaluate).each(evaluate);
  </script>

  <!-- Identitas Button -->
  <script>
  function radioKTP(){
    if($('#myRadioKTP').is(':checked'))
    {
      document.getElementById('myDivKTP').style.display ='block';
      document.getElementById('myDivNPWP').style.display ='none';
      document.getElementById('myDivAnggota').style.display ='none';
      document.getElementById('ktpku').required = true;
      document.getElementById('npwpku').required = false;
      document.getElementById('anggotaku').required = false;
    }
    else if($('#myRadioNPWP').is(':checked')){
      document.getElementById('myDivKTP').style.display ='none';
      document.getElementById('myDivNPWP').style.display ='block';
      document.getElementById('myDivAnggota').style.display ='none';
      document.getElementById('ktpku').required = false;
      document.getElementById('npwpku').required = true;
      document.getElementById('anggotaku').required = false;
    }
    else{
      document.getElementById('myDivKTP').style.display ='none';
      document.getElementById('myDivNPWP').style.display ='none';
      document.getElementById('myDivAnggota').style.display ='block';
      document.getElementById('ktpku').required = false;
      document.getElementById('npwpku').required = false;
      document.getElementById('anggotaku').required = true;
    }
  }
  $('input[type="radio"]').click(radioKTP).each(radioKTP);
  </script>

  <!-- Checking -->
  <script>
  function checkListrik(){
    if($('#myCheck2').is(':checked'))
    {
      document.getElementById('myDiv2').required = true;
      document.getElementById('dayaL').required = true;
    }
    else{
      document.getElementById('myDiv2').required = false;
      document.getElementById('dayaL').required = false;
    }
  }
  $('input[type="checkbox"]').click(checkListrik).each(checkListrik);
  </script>

  <script>
  function checkAir(){
    if($('#myCheck1').is(':checked'))
    {
      document.getElementById('myDiv1').required = true;
    }
    else{
      document.getElementById('myDiv1').required = false;
    }
  }
  $('input[type="checkbox"]').click(checkAir).each(checkAir);
  </script>

  <script>
    var blok = <?php echo json_encode($blok); ?>;
    var anggota = <?php echo json_encode($anggota); ?>;
    var ktp = <?php echo json_encode($ktp); ?>;
    var npwp = <?php echo json_encode($npwp); ?>;
    var mair = <?php echo json_encode($mAir); ?>;
    var mlistrik = <?php echo json_encode($mListrik); ?>;
  </script>

  <script>
  autocomplete(document.getElementById("exampleInputKodeBlok"), blok);
  autocomplete(document.getElementById("ktpku"), ktp);
  autocomplete(document.getElementById("npwpku"), npwp);
  autocomplete(document.getElementById("anggotaku"), anggota);
  autocomplete(document.getElementById("myDiv1"), mair);
  autocomplete(document.getElementById("myDiv2"), mlistrik);
  </script>
@endsection