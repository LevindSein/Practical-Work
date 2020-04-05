@extends('manajer.layout')
@section('content')
<?php
$ttl_Blok = 0;
$ttl_Listrik = 0;
$ttl_Air = 0;
$ttl_Keamanan = 0;
$ttl_Kebersihan = 0;

for($i=0;$i<$ttlBlok;$i++){
  $ttl_Blok = $ttl_Blok + $Blokku[$i];
  $ttl_Listrik = $ttl_Listrik + $Listrik[$i];
  $ttl_Air = $ttl_Air + $Air[$i];
  $ttl_Keamanan = $ttl_Keamanan + $Keamanan[$i];
  $ttl_Kebersihan = $ttl_Kebersihan + $Kebersihan[$i];
}

$widListrik = round($ttl_Listrik / $ttl_Blok * 100);
$widAir = round($ttl_Air / $ttl_Blok * 100);
$widKeamanan = round($ttl_Keamanan / $ttl_Blok * 100);
$widKebersihan = round($ttl_Kebersihan / $ttl_Blok * 100);

//Realisasi
$thn = 0;
$asalAir = 0;
$asalListrik = 0;
$asalKeamanan = 0;
$asalKebersihan = 0;
$sel_air = 0;
$sel_listrik = 0;
$sel_keamanan = 0;
$sel_kebersihan = 0;
foreach($asalPendapatan as $d){
  $thn = $d->tahun;
  $asalListrik = $d->listrik;
  $asalAir = $d->air;
  $asalKeamanan = $d->keamanan;
  $asalKebersihan = $d->kebersihan;
  $sel_listrik = $d->sellistrik;
  $sel_air = $d->selair;
  $sel_keamanan = $d->selkeamanan;
  $sel_kebersihan = $d->selkebersihan;
}


?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>
          
          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Pendapatan per-Bulan di Tahun {{$thn}}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="pendapatanChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Realisasi Tahun {{$thn}}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-warning"></i> Listrik
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Air Bersih
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> IPK & Keamanan
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Kebersihan
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Akumulasi Tahun {{$thn}}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="akumulasiChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Selisih Tahun {{$thn}}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart1"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-warning"></i> Listrik
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Air Bersih
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> IPK & Keamanan
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Kebersihan
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Pengguna Fasilitas</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Tempat Usaha <span class="float-right">{{$ttl_Blok}} Unit - 100%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Jasa Listrik <span class="float-right">{{$ttl_Listrik}} Unit - {{$widListrik}}%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{$widListrik}}%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Jasa Air <span class="float-right">{{$ttl_Air}} Unit - {{$widAir}}%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: {{$widAir}}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Jasa IPK & Keamanan <span class="float-right">{{$ttl_Keamanan}} Unit - {{$widKeamanan}}%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{$widKeamanan}}%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Jasa Kebersihan <span class="float-right">{{$ttl_Kebersihan}} Unit - {{$widKebersihan}}%</span></h4>
                  <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$widKebersihan}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Tentang Aplikasi</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 21rem;" src="img/undraw_posting_photo.svg" alt="">
                  </div>
                  <p>Aplikasi dikelola oleh PT. Pengelola Pusat Perdagangan Caringin.</p>
                </div>
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
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Air Bersih", "Kebersihan", "IPK & Keamanan", "Listrik"],
    datasets: [{
      data: [{{$asalAir}}, {{$asalKebersihan}}, {{$asalKeamanan}}, {{$asalListrik}}],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      enabled : true,
      callbacks: {
        // this callback is used to create the tooltip label
        label: function(tooltipItem, data) {
          // get the data label and data value to display
          // convert the data value to local string so it uses a comma seperated number
          var dataLabel = data.labels[tooltipItem.index];
          var value = ': Rp.' + data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index].toLocaleString();

          // make this isn't a multi-line label (e.g. [["label 1 - line 1, "line 2, ], [etc...]])
          if (Chart.helpers.isArray(dataLabel)) {
            // show value on first line of multiline label
            // need to clone because we are changing the value
            dataLabel = dataLabel.slice();
            dataLabel[0] += value;
          } else {
            dataLabel += value;
          }

          // return the text to display on the tooltip
          return dataLabel;
        }
      },
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage : 50,
    rotation : 10,
  },
});

</script>
<script>
    var pendapatanCanvas = document.getElementById("pendapatanChart");
      Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
      Chart.defaults.global.defaultFontColor = '#858796';
      Chart.defaults.global.defaultFontSize = 10;

      var data = {
      labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des"],
      datasets: [
        {
            label: "Tagihan",
            backgroundColor: "#4e73df",
            data: [{{$tagihanJan}}, {{$tagihanFeb}}, {{$tagihanMar}}, {{$tagihanApr}}, {{$tagihanMei}}, {{$tagihanJun}}, {{$tagihanJul}}, {{$tagihanAgu}}, {{$tagihanSep}}, {{$tagihanOkt}}, {{$tagihanNov}}, {{$tagihanDes}}]
        },
        {
            label: "Realisasi",
            backgroundColor: "#1cc88a",
            data: [{{$realisasiJan}}, {{$realisasiFeb}}, {{$realisasiMar}}, {{$realisasiApr}}, {{$realisasiMei}}, {{$realisasiJun}}, {{$realisasiJul}}, {{$realisasiAgu}}, {{$realisasiSep}}, {{$realisasiOkt}}, {{$realisasiNov}}, {{$realisasiDes}}]
        },
        {
            label: "Selisih",
            backgroundColor: "#e74a3b",
            data: [{{$selisihJan}}, {{$selisihFeb}}, {{$selisihMar}}, {{$selisihApr}}, {{$selisihMei}}, {{$selisihJun}}, {{$selisihJul}}, {{$selisihAgu}}, {{$selisihSep}}, {{$selisihOkt}}, {{$selisihNov}}, {{$selisihDes}}],
        }
      ]
    };
    var pendapatanChart = new Chart(pendapatanCanvas, {
        type: 'bar',
        data: data,
        options: {
          tooltips: {
      enabled : true,
      callbacks: {
        // this callback is used to create the tooltip label
        label: function(tooltipItem, data) {
          // get the data label and data value to display
          // convert the data value to local string so it uses a comma seperated number
          var dataLabel = data.labels[tooltipItem.index];
          var value = ': Rp.' + data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index].toLocaleString();

          // make this isn't a multi-line label (e.g. [["label 1 - line 1, "line 2, ], [etc...]])
          if (Chart.helpers.isArray(dataLabel)) {
            // show value on first line of multiline label
            // need to clone because we are changing the value
            dataLabel = dataLabel.slice();
            dataLabel[0] += value;
          } else {
            dataLabel += value;
          }

          // return the text to display on the tooltip
          return dataLabel;
        }
      }},
            barValueSpacing: 20,
            scales: {
                xAxes: [{
                  barPercentage: 1,
                  categoryPercentage: 0.6
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                    }
                }]
            }
        }
    });

  </script>
  <script>
    var pendapatanCanvas = document.getElementById("akumulasiChart");
      Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
      Chart.defaults.global.defaultFontColor = '#858796';
      Chart.defaults.global.defaultFontSize = 10;

      var data = {
      labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des"],
      datasets: [
        {
            label: "Realisasi",
            backgroundColor: "#1cc88a",
            data: [{{$reaAkum[0]}}, {{$reaAkum[1]}}, {{$reaAkum[2]}}, {{$reaAkum[3]}}, {{$reaAkum[4]}}, {{$reaAkum[5]}}, {{$reaAkum[6]}}, {{$reaAkum[7]}}, {{$reaAkum[8]}}, {{$reaAkum[9]}}, {{$reaAkum[10]}}, {{$reaAkum[11]}}]
        },
        {
            label: "Selisih",
            backgroundColor: "#e74a3b",
            data: [{{$selAkum[0]}}, {{$selAkum[1]}}, {{$selAkum[2]}}, {{$selAkum[3]}}, {{$selAkum[4]}}, {{$selAkum[5]}}, {{$selAkum[6]}}, {{$selAkum[7]}}, {{$selAkum[8]}}, {{$selAkum[9]}}, {{$selAkum[10]}}, {{$selAkum[11]}}],
        }
      ]
    };
    var pendapatanChart = new Chart(pendapatanCanvas, {
        type: 'bar',
        data: data,
        options: {
          tooltips: {
      enabled : true,
      callbacks: {
        // this callback is used to create the tooltip label
        label: function(tooltipItem, data) {
          // get the data label and data value to display
          // convert the data value to local string so it uses a comma seperated number
          var dataLabel = data.labels[tooltipItem.index];
          var value = ': Rp.' + data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index].toLocaleString();

          // make this isn't a multi-line label (e.g. [["label 1 - line 1, "line 2, ], [etc...]])
          if (Chart.helpers.isArray(dataLabel)) {
            // show value on first line of multiline label
            // need to clone because we are changing the value
            dataLabel = dataLabel.slice();
            dataLabel[0] += value;
          } else {
            dataLabel += value;
          }

          // return the text to display on the tooltip
          return dataLabel;
        }
      }},
            barValueSpacing: 20,
            scales: {
                xAxes: [{
                  barPercentage: 1,
                  categoryPercentage: 0.6
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                    }
                }]
            }
        }
    });

  </script>
  <script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart1");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Air Bersih", "Kebersihan", "IPK & Keamanan", "Listrik"],
    datasets: [{
      data: [{{$sel_air}}, {{$sel_kebersihan}}, {{$sel_keamanan}}, {{$sel_listrik}}],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      enabled : true,
      callbacks: {
        // this callback is used to create the tooltip label
        label: function(tooltipItem, data) {
          // get the data label and data value to display
          // convert the data value to local string so it uses a comma seperated number
          var dataLabel = data.labels[tooltipItem.index];
          var value = ': Rp.' + data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index].toLocaleString();

          // make this isn't a multi-line label (e.g. [["label 1 - line 1, "line 2, ], [etc...]])
          if (Chart.helpers.isArray(dataLabel)) {
            // show value on first line of multiline label
            // need to clone because we are changing the value
            dataLabel = dataLabel.slice();
            dataLabel[0] += value;
          } else {
            dataLabel += value;
          }

          // return the text to display on the tooltip
          return dataLabel;
        }
      },
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage : 50,
    rotation : 10,
  },
});

</script>
@endsection