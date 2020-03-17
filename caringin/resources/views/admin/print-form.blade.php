@extends('admin.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Print Form</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="form-group">
                <label for="sel1">Tampilkan Data :</label>
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Alat Air</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Alat Listrik</a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <!--AIR BERSIH-->
                  <div id="home" class="container tab-pane active"><br>
                  <div class="table-responsive">
                  <table class="table table-bordered" id="printAir" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>No. Los</th>
                      <th>Nomor Alat</th>
                      <th>Meter Lalu</th>
                      <th>Meter Baru</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataAir as $data)
                    <tr>
                      <td class="text-center">{{$data->KD_KONTROL}}</td>
                      <td class="text-left">{{$data->NM_NASABAH}}</td>
                      <td class="text-center">{{$data->NO_ALAMAT}}</td>
                      <td class="text-center">
                      @if($data->NOMTR_AIR == null)
                          0
                      @else
                          {{$data->NOMTR_AIR}}
                      @endif
                      </td>
                      <td class="text-center">{{number_format($data->MAKHIR_AIR)}}</td>
                      <td class="text-center">&nbsp;</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                  </div>
                  </div>
                  <!--END AIR BERSIH-->
                  <!--LISTRIK-->
                  <div id="menu1" class="container tab-pane fade"><br>
                  <div class="table-responsive">
                  <table class="table table-bordered" id="printListrik" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kode Kontrol</th>
                      <th>Nama Nasabah</th>
                      <th>No. Los</th>
                      <th>Nomor Alat</th>
                      <th>Meter Lalu</th>
                      <th>Meter Baru</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataListrik as $data)
                    <tr>
                      <td class="text-center">{{$data->KD_KONTROL}}</td>
                      <td class="text-left">{{$data->NM_NASABAH}}</td>
                      <td class="text-center">{{$data->NO_ALAMAT}}</td>
                      <td class="text-center">
                      @if($data->NOMTR_LISTRIK == null)
                          0
                      @else
                          {{$data->NOMTR_LISTRIK}}
                      @endif
                      </td>
                      <td class="text-center">{{number_format($data->MAKHIR_LISTRIK)}}</td>
                      <td class="text-center">&nbsp;</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                  </div>
                  </div>
                  <!--END LISTRIK-->
                </div>
                <!--END Tab Panes-->
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $(
            '#printAir'
        ).DataTable({
            "scrollX": true,
            "processing": true,
            "bSortable": false,
            "deferRender": true,
            "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'r" +
                    "ow'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

            "buttons": [
                {
                    text: '<i class="fas fa-print fa-lg"></i>',
                    extend: 'print',
                    className: 'btn btn-info bg-gradient-info',
                    title: 'Form Meteran Air',
                    exportOptions: {
                        columns: ':visible(.export-col)'
                    },
                    customize: function (win) {
                        $(win.document.body)
                            .css('font-size', '11pt')
                            .prepend(
                                '<img src="http://datatables.net/media/images/logo-fade.png" style="position:ab' +
                                'solute; top:0; left:0;" />'
                            );;
                    }
                }
            ]
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(
            '#printListrik'
        ).DataTable({
            "scrollX": true,
            "processing": true,
            "bSortable": false,
            "deferRender": true,
            "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'r" +
                    "ow'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

            "buttons": [
                {
                    text: '<i class="fas fa-print fa-lg"></i>',
                    extend: 'print',
                    className: 'btn btn-info bg-gradient-info',
                    title: 'Form Meteran Listrik',
                    exportOptions: {
                        columns: ':visible(.export-col)'
                    },
                    customize: function (win) {
                        $(win.document.body)
                            .css('font-size', '11pt')
                            .prepend(
                                '<img src="{{asset('img/bp3c.png')}}" style="position:ab' +
                                'solute; top:0; left:0;" />'
                            );;
                    }
                }
            ]
        });
    });
</script>
@endsection