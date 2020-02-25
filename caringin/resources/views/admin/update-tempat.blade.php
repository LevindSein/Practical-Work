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
                  <input value="{{$noktp}}" type="text" name="ktp" class="form-control form-control-user" placeholder="(kosong)">
                </div>
                <div class="form-group" style="display:none" id="myDivNPWP">
                  No. NPWP
                  <input value="{{$nonpwp}}" type="text" name="npwp" class="form-control form-control-user" placeholder="(kosong)">
                </div>

                <div class="form-group row">
                  <div class="col-sm-2">Fasilitas</div>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="myCheck1" name="air" data-related-item="myDiv1">
                      <label class="form-check-label" for="myCheck1">
                        Air
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="myCheck2" name="listrik" data-related-item="myDiv2">
                      <label class="form-check-label" for="myCheck2">
                        Listrik
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="myCheck3" name="keamanan" data-related-item="myDiv3">
                      <label class="form-check-label" for="myCheck3">
                        IPK & Keamanan
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="myCheck4" name="kebersihan" data-related-item="myDiv4">
                      <label class="form-check-label" for="myCheck4">
                        Kebersihan
                      </label>
                    </div>
                  </div>
                </div>
                
                <!-- Hidden Fasilitas -->
                <div class="form-group" style="display:none">
                  Nomor Meter Air
                  <input value="{{$data->NOMTR_AIR}}" type="text" class="form-control form-control-user" name="meterAir" id="myDiv1" placeholder="1484xxxx">
                </div>
                <div class="form-group" style="display:none">
                  Nomor Meter Listrik
                  <input value="{{$data->NOMTR_LISTRIK}}" type="text" class="form-control form-control-user" name="meterListrik" id="myDiv2" placeholder="1484xxxx">
                  <br>
                  Daya
                  <input value="{{$data->DAYA}}" type="text" class="form-control form-control-user" name="dayaListrik" id="myDiv2" placeholder="12xx">
                </div>
                <div class="form-group" style="display:none">
                  <label for="sel1">Kategori Tarif IPK</label>
                  <select class="form-control" name="ipkId" id="myDiv3">
                    <option disabled selected hidden value="{{$id_ipk}}">{{$trfipk}}</option>
                    @foreach($tarif_ipk as $data)
                    <option value='{{$data->ID_TRFIPK}}'>{{$data->TRF_IPK}}</option>
                    @endforeach
                  </select>
                  <br>
                  <label for="sel1">Kategori Tarif Keamanan</label>
                  <select class="form-control" name="keamananId">
                    <option disabled selected hidden value="{{$id_keamanan}}">{{$trfaman}}</option>
                    @foreach($tarif_keamanan as $data)
                    <option value='{{$data->ID_TRFKEAMANAN}}'>{{$data->TRF_KEAMANAN}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group" style="display:none">
                  <label for="sel1">Kategori Tarif Kebersihan</label>
                  <select class="form-control" name="kebersihanId" id="myDiv4">
                    <option disabled selected hidden value="{{$id_kebersihan}}">{{$trfkebersihan}}</option>
                    @foreach($tarif_kebersihan as $data)
                    <option value='{{$data->ID_TRFKEBERSIHAN}}'>{{$data->TRF_KEBERSIHAN}}</option>
                    @endforeach
                  </select>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
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