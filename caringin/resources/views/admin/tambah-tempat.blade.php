@extends('admin.layout')
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
              <form class="user" action="storetempat" method="POST">
              @csrf
                <div class="form-group">
                  Blok
                  <input required name="blok" style="text-transform: uppercase;" type="text" class="form-control form-control-user" id="exampleInputKodeBlok" placeholder="A-1">
                </div>
                <div class="form-group">
                  No. Los
                  <input required name="los" type="text" class="form-control form-control-user" id="exampleInputBanyakLos" placeholder="Misal: 1, 2, 2A">
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
                  </div>
                </div>

                <!-- Hidden Identitas -->
                <div class="form-group" style="display:none" id="myDivKTP">
                  No. KTP
                  <input name="ktp" type="text" class="form-control form-control-user" placeholder="1484xxxx">
                </div>
                <div class="form-group" style="display:none" id="myDivNPWP">
                  No. NPWP
                  <input name="npwp" type="text" class="form-control form-control-user" placeholder="261xxxxxx">
                </div>

                <div class="form-group row">
                  <div class="col-sm-2">Fasilitas</div>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="air" id="myCheck1" data-related-item="myDiv1">
                      <label class="form-check-label" for="myCheck1">
                        Air
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="listrik" id="myCheck2" data-related-item="myDiv2">
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
                <div class="form-group" style="display:none">
                  Nomor Meter Air
                  <input type="text" class="form-control form-control-user" name="meterAir"  id="myDiv1" placeholder="1484xxxx">
                </div>
                <div class="form-group" style="display:none">
                  Nomor Meter Listrik
                  <input type="text" class="form-control form-control-user" name="meterListrik" id="myDiv2" placeholder="1484xxxx">
                  <br>
                  Daya
                  <input type="text" class="form-control form-control-user" name="dayaListrik" placeholder="12xx">
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
    }
    else{
      document.getElementById('myDivKTP').style.display ='none';
      document.getElementById('myDivNPWP').style.display ='block';
    }
  }
  $('input[type="radio"]').click(radioKTP).each(radioKTP);
  </script>
@endsection