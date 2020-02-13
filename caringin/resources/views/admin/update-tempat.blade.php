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
              <form class="user">
                <div class="form-group">
                  Blok
                  <input type="text" class="form-control form-control-user" id="exampleInputKodeBlok" placeholder="Misal: A-1">
                </div>
                <div class="form-group">
                  No. Los
                  <input type="text" class="form-control form-control-user" id="exampleInputBanyakLos" placeholder="Misal: 1, 2, 2A">
                </div>
                <div class="form-group">
                  No. KTP
                  <input type="text" class="form-control form-control-user" id="exampleInputBanyakLos" placeholder="321xxxxx">
                </div>
                <!-- <div class="form-group">
                  <label for="sel1">Status Kepemilikan</label>
                  <select class="form-control" id="exampleInputStatus">
                    <option value="pemilik">Pemilik</option>
                    <option value="penyewa">Penyewa</option>
                  </select>
                </div> -->
                <div class="form-group">
                  Bentuk Usaha
                  <input type="text" class="form-control form-control-user" id="exampleInputBentukUsaha" placeholder="Misal : Penjual Buah">
                </div>
                <div class="form-group row">
                  <div class="col-sm-2">Fasilitas</div>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="myCheck1" data-related-item="myDiv1">
                      <label class="form-check-label" for="myCheck1">
                        Air
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="myCheck2" data-related-item="myDiv2" checked>
                      <label class="form-check-label" for="myCheck2">
                        Listrik
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="myCheck3" data-related-item="myDiv3">
                      <label class="form-check-label" for="myCheck3">
                        IPK & Keamanan
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="myCheck4" data-related-item="myDiv4">
                      <label class="form-check-label" for="myCheck4">
                        Kebersihan
                      </label>
                    </div>
                  </div>
                </div>
                
                <div class="form-group" style="display:none">
                  Nomor Meter Air
                  <input type="text" class="form-control form-control-user"  id="myDiv1" placeholder="1484xxxx">
                </div>
                <div class="form-group" style="display:none">
                  Nomor Meter Listrik
                  <input type="text" class="form-control form-control-user" id="myDiv2" placeholder="1484xxxx">
                </div>
                <div class="form-group" style="display:none">
                  <label for="sel1">Kategori Tarif IPK</label>
                  <select class="form-control" id="myDiv3">
                    <option disabled selected hidden>Pilih Tarif</option>
                    <option>200000</option>
                  </select>
                  <br>
                  <label for="sel1">Kategori Tarif Keamanan</label>
                  <select class="form-control">
                    <option disabled selected hidden>Pilih Tarif</option>
                    <option>200000</option>
                  </select>
                </div>
                <div class="form-group" style="display:none">
                  <label for="sel1">Kategori Tarif Kebersihan</label>
                  <select class="form-control" id="myDiv4">
                    <option disabled selected hidden>Pilih Tarif</option>
                    <option>100000</option>
                  </select>
                </div>
                

                <a href="index.html" class="btn btn-primary btn-user btn-block">
                  Tambah Tempat
                </a>
              </form>
              
            </div>
          </div>
        </div>

    <!-- End of Main Content -->
@endsection

@section('js')
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
@endsection