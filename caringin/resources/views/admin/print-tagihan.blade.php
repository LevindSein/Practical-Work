@extends('admin.layout')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Print Tagihan</h1>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="printTagihan" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Kode Kontrol</th>
                      <th>Nama</th>
                      <th>Pakai Air (M<sup>3</sup>)</th>
                      <th>Pakai Listrik (Watt)</th>
                      <th>Air Bersih (Rp.)</th>
                      <th>Listrik (Rp.)</th>
                      <th>IPK & Keamanan (Rp.)</th>
                      <th>Kebersihan (Rp.)</th>
                      <th>Total (Rp.)</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($dataset as $data)
                    <tr>
                      <td class="text-center">{{$data->TGL_TAGIHAN}}</td>
                      <td class="text-center">{{$data->KD_KONTROL}}</td>
                      <td class="text-left">{{$data->NM_NASABAH}}</td>
                      <td>
                      @if($data->PAKAI_AIR == null)
                          0
                      @else
                          {{number_format($data->PAKAI_AIR)}}
                      @endif
                      </td>
                      <td>
                      @if($data->PAKAI_LISTRIK == null)
                          0
                      @else
                          {{number_format($data->PAKAI_LISTRIK)}}
                      @endif
                      </td>
                      <td>
                      @if($data->TTL_AIR == null)
                          0
                      @else
                          {{number_format($data->TTL_AIR)}}
                      @endif
                      </td>
                      <td>
                      @if($data->TTL_LISTRIK == null)
                          0
                      @else
                          {{number_format($data->TTL_LISTRIK)}}
                      @endif
                      </td>
                      <td>
                      @if($data->TTL_IPKEAMANAN == null)
                          0
                      @else
                          {{number_format($data->TTL_IPKEAMANAN)}}
                      @endif
                      </td>
                      <td>
                      @if($data->TTL_KEBERSIHAN == null)
                          0
                      @else
                          {{number_format($data->TTL_KEBERSIHAN)}}
                      @endif
                      </td>
                      <td>
                      @if($data->TTL_TAGIHAN == null)
                          0
                      @else
                          {{number_format($data->TTL_TAGIHAN)}}
                      @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                  </div>
                  </div>
                </div>
                <!--END Tab Panes-->
              </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $(
            '#printTagihan'
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
                    title: 'Tagihan Tempat Usaha',
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