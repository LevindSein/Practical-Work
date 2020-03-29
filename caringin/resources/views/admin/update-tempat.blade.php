@extends('admin.layout')
@section('content')
       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-center">
          <h1 class="h3 mb-0 text-gray-800">Update Tempat Usaha</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="p-4">
            @foreach ($dataset as $data)
              <form class="user" action="{{url('update/storetempat',[$data->ID_TEMPAT])}}" method="POST">
              @csrf
                <div class="form-group">
                  Blok
                  <input readonly value="{{$data->BLOK}}" type="text" name="blok" class="form-control form-control-user" id="exampleInputKodeBlok" placeholder="(kosong)">
                </div>
                <div class="form-group">
                  No. Los
                  <input readonly value="{{$data->NO_ALAMAT}}" type="text" name="los" class="form-control form-control-user" id="exampleInputBanyakLos" placeholder="(kosong)">
                </div>
                <div class="form-group">
                  Bentuk Usaha
                  <input value="{{$data->BENTUK_USAHA}}" style="text-transform: capitalize;" type="text" name="bentuk_usaha" class="form-control form-control-user" id="exampleInputBentukUsaha" placeholder="(kosong)">
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-2">Pemilik</div>
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

                <!-- Hidden Pemilik -->
                <div class="form-group" style="display:none" id="myDivKTP">
                  No. KTP
                  <input value="{{$noktp}}" type="text" name="ktp" id="ktpku" class="form-control form-control-user" placeholder="(kosong)">
                </div>
                <div class="form-group" style="display:none" id="myDivNPWP">
                  No. NPWP
                  <input value="{{$nonpwp}}" type="text" name="npwp" id="npwpku" class="form-control form-control-user" placeholder="(kosong)">
                </div>
                <div class="form-group" style="display:none" id="myDivAnggota">
                  No. Anggota
                  <input value="{{$noanggota}}" type="text" name="anggota" class="form-control form-control-user" id="anggotaku" placeholder="BP3C261xxxxx">
                </div>

                <div class="form-group row">
                  <div class="col-sm-2">Pengguna</div>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="identitas1" id="myRadioKTP1" value="k1" checked>
                      <label class="form-check-label" for="myRadioKTP1">
                        KTP
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="identitas1" id="myRadioNPWP1" value="n1">
                      <label class="form-check-label" for="myRadioNPWP1">
                        NPWP
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="identitas1" id="myRadioAnggota1" value="a1">
                      <label class="form-check-label" for="myRadioAnggota1">
                        No.Anggota
                      </label>
                    </div>
                  </div>
                </div>

                <!-- Hidden Pengguna -->
                <div class="form-group" style="display:none" id="myDivKTP1">
                  No. KTP
                  <input value="{{$noktp1}}" type="text" name="ktp1" id="ktpku1" class="form-control form-control-user" placeholder="(kosong)">
                </div>
                <div class="form-group" style="display:none" id="myDivNPWP1">
                  No. NPWP
                  <input value="{{$nonpwp1}}" type="text" name="npwp1" id="npwpku1" class="form-control form-control-user" placeholder="(kosong)">
                </div>
                <div class="form-group" style="display:none" id="myDivAnggota1">
                  No. Anggota
                  <input value="{{$noanggota1}}" type="text" name="anggota1" id="anggotaku1" class="form-control form-control-user" placeholder="BP3C261xxxxx">
                </div>

                <div class="form-group row">
                  <div class="col-sm-2">Fasilitas</div>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="myCheck1" name="air" data-related-item="myDiv1"
                      <?php if($id_air != NULL){ ?> checked="checked" <?php } ?>>
                      <label class="form-check-label" for="myCheck1">
                        Air
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="myCheck2" name="listrik" data-related-item="myDiv2"
                      <?php if($id_listrik != NULL){ ?> checked="checked" <?php } ?>>
                      <label class="form-check-label" for="myCheck2">
                        Listrik
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="myCheck3" name="keamanan" data-related-item="myDiv3"
                      <?php if($id_keamanan != NULL){ ?> checked="checked" <?php } ?>>
                      <label class="form-check-label" for="myCheck3" >
                        IPK & Keamanan
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="myCheck4" name="kebersihan" data-related-item="myDiv4"
                      <?php if($id_kebersihan != NULL){ ?> checked="checked" <?php } ?>>
                      <label class="form-check-label" for="myCheck4">
                        Kebersihan
                      </label>
                    </div>
                  </div>
                </div>
                
                <!-- Hidden Fasilitas -->
                <div class="form-group" style="display:none">
                  ID Alat Meter Air
                  <input readonly value="{{$data->ID_MAIR}}" type="text" class="form-control form-control-user" name="meterAir" id="myDiv1" placeholder="1484xxxx">
                </div>
                <div class="form-group" style="display:none">
                  ID Alat Meter Listrik
                  <input readonly value="{{$data->ID_MLISTRIK}}" type="text" class="form-control form-control-user" name="meterListrik" id="myDiv2" placeholder="1484xxxx">
                  <br>
                  Daya
                  <input value="{{$data->DAYA}}" type="text" class="form-control form-control-user" name="dayaListrik" id="dayaL" placeholder="12xx">
                </div>
                <div class="form-group" style="display:none">
                  <label for="sel1">Kategori Tarif IPK</label>
                  <select class="form-control" name="ipkId" id="myDiv3">
                    <option selected hidden value="{{$id_ipk}}">{{$trfipk}}</option>
                    @foreach($tarif_ipk as $data)
                    <option value='{{$data->ID_TRFIPK}}'>{{$data->TRF_IPK}}</option>
                    @endforeach
                  </select>
                  <br>
                  <label for="sel1">Kategori Tarif Keamanan</label>
                  <select class="form-control" name="keamananId">
                    <option selected hidden value="{{$id_keamanan}}">{{$trfaman}}</option>
                    @foreach($tarif_keamanan as $data)
                    <option value='{{$data->ID_TRFKEAMANAN}}'>{{$data->TRF_KEAMANAN}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group" style="display:none">
                  <label for="sel1">Kategori Tarif Kebersihan</label>
                  <select class="form-control" name="kebersihanId" id="myDiv4">
                    <option selected hidden value="{{$id_kebersihan}}">{{$trfkebersihan}}</option>
                    @foreach($tarif_kebersihan as $data)
                    <option value='{{$data->ID_TRFKEBERSIHAN}}'>{{$data->TRF_KEBERSIHAN}}</option>
                    @endforeach
                  </select>
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-2">Cicilan</div>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="cicilan" id="myRadio1" value="1" 
                      <?php if($izin_cicil == 1){ ?> checked="checked" <?php } ?>>
                      <label class="form-check-label" for="myRadio1">
                        Ya
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="cicilan" id="myRadio2" value="0"
                      <?php if($izin_cicil == 0){ ?> checked="checked" <?php } ?>>
                      <label class="form-check-label" for="myRadio2">
                        Tidak
                      </label>
                    </div>
                  </div>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
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

  <!-- Pemilik Button -->
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

  <!-- Pengguna Button -->
  <script>
  function radioKTP1(){
    if($('#myRadioKTP1').is(':checked'))
    {
      document.getElementById('myDivKTP1').style.display ='block';
      document.getElementById('myDivNPWP1').style.display ='none';
      document.getElementById('myDivAnggota1').style.display ='none';
      document.getElementById('ktpku1').required = true;
      document.getElementById('npwpku1').required = false;
      document.getElementById('anggotaku1').required = false;
    }
    else if($('#myRadioNPWP1').is(':checked')){
      document.getElementById('myDivKTP1').style.display ='none';
      document.getElementById('myDivNPWP1').style.display ='block';
      document.getElementById('myDivAnggota1').style.display ='none';
      document.getElementById('ktpku1').required = false;
      document.getElementById('npwpku1').required = true;
      document.getElementById('anggotaku1').required = false;
    }
    else{
      document.getElementById('myDivKTP1').style.display ='none';
      document.getElementById('myDivNPWP1').style.display ='none';
      document.getElementById('myDivAnggota1').style.display ='block';
      document.getElementById('ktpku1').required = false;
      document.getElementById('npwpku1').required = false;
      document.getElementById('anggotaku1').required = true;
    }
  }
  $('input[type="radio"]').click(radioKTP1).each(radioKTP1);
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
@endsection