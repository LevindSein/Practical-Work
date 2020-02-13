<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PT Pengelola Pusat Perdagangan</title>

  <!-- Custom fonts for this template -->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3">ADMIN</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Tagihan -->
      <li class="nav-item">
        <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTagihan" aria-expanded="true" aria-controls="collapseTagihan">
          <i class="fas fa-fw fa-plus"></i>
          <span>Tagihan</span>
        </a>
        <div id="collapseTagihan" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <div class="collapse-divider"></div>
            <a class="collapse-item" href="{{url('tambahtagihan')}}">Tagihan Nasabah</a>
          </div>
        </div> -->
        
        <a class="nav-link" href="{{url('tambahtagihan')}}">
          <i class="fas fa-fw fa-plus"></i>
          <span>Tagihan</span></a>
      </li>
      
      <!-- Nav Item - Tarif -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTarif" aria-expanded="true" aria-controls="collapseTarif">
          <i class="fas fa-fw fa-list"></i>
          <span>Tarif</span>
        </a>
        <div id="collapseTarif" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <div class="collapse-divider"></div>
            <a class="collapse-item" href="{{url('showformtarifair')}}">Tarif Air</a>
            <a class="collapse-item" href="{{url('showformtariflistrik')}}">Tarif Listrik</a>
            <a class="collapse-item" href="{{url('showformtarifkebersihan')}}">Tarif Kebersihan</a>
            <a class="collapse-item" href="{{url('showformtarifipk')}}">Tarif IPK</a>
            <a class="collapse-item" href="{{url('showformtarifkeamanan')}}">Tarif Keamanan</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Laporan -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Laporan</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <div class="collapse-divider"></div>
            <a class="collapse-item" href="{{url('showlaporanharian')}}">Laporan Harian</a>
            <a class="collapse-item" href="{{url('showlaporanbulanan')}}">Laporan Bulanan</a>
            <a class="collapse-item" href="{{url('showlaporantahunan')}}">Laporan Tahunan</a>
            <a class="collapse-item" href="{{url('showlaporantagihan')}}">Laporan Tagihan</a>
            <a class="collapse-item" href="{{url('showlaporantunggakan')}}">Laporan Tunggakan</a>
            <a class="collapse-item" href="{{url('showlaporanbongkaran')}}">Laporan Bongkaran</a>
            <a class="collapse-item" href="{{url('showlaporanpenghapusan')}}">Laporan Penghapusan</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Nasabah -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNasabah" aria-expanded="true" aria-controls="collapseNasabah">
          <i class="fas fa-fw fa-users"></i>
          <span>Nasabah</span>
        </a>
        <div id="collapseNasabah" class="collapse" aria-labelledby="headingNasabah" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('showformnasabah')}}">Tambah Nasabah</a>
            <a class="collapse-item" href="{{url('showdatanasabah')}}">Data Nasabah</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Tempat Usaha -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsaha" aria-expanded="true" aria-controls="collapseUsaha">
          <i class="fas fa-fw fa-store"></i>
          <span>Tempat Usaha</span>
        </a>
        <div id="collapseUsaha" class="collapse" aria-labelledby="headingUsaha" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('showformtempatusaha')}}">Tambah Tempat Usaha</a>
            <a class="collapse-item" href="{{url('showtempatusaha')}}">Data Tempat Usaha</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - User -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
          <i class="fas fa-fw fa-user"></i>
          <span>User</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingUser" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('showtambahuser')}}">Tambah User</a>
            <a class="collapse-item" href="{{url('showdatauser')}}">Data User</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Nama User disini</span>
                <img class="img-profile rounded-circle" src="https://dw9to29mmj727.cloudfront.net/misc/newsletter-naruto3.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
        @yield('content')
              <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Pengelola Pusat Perdagangan</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin untuk logout?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Pilih "Logout" di bawah ini jika anda siap untuk mengakhiri sesi anda saat ini.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="login.html">Logout</a>
      </div>
    </div>
  </div>
</div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

  <!-- Button -->
  <script src="{{asset('https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js')}}" rel="stylesheet"></script>
  <script src="{{asset('https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js')}}" rel="stylesheet"></script>
  <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js')}}" rel="stylesheet"></script>
  <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js')}}" rel="stylesheet"></script>
  <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js')}}" rel="stylesheet"></script>
  <script src="{{asset('https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js')}}" rel="stylesheet"></script>
  <script src="{{asset('https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js')}}" rel="stylesheet"></script>
 
  <!--for column table toggle-->
  <script>
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
   $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust();
    });
  </script>
  <script>
    $(document).ready(function () {
      $('#tableAir,#tableListrik,#tableKeamanan,#tableKebersihan,#tableTempat,#tableUser,#tableTagihan,#dataNasabah').DataTable({
        scrollX: true,
        dom: 'Bflrtip',
        buttons: [
            { extend: 'excel'},
            { extend: 'pdf'},
            { extend: 'print'}
          ]
      });
    });
  </script>
@yield('js')
</body>

</html>