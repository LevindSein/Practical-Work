<?php
    $username = Session::get('username');
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>PT Pengelola Pusat Perdagangan Caringin</title>

        <!-- Custom fonts for this template -->
        <link
            href="{{asset('vendor/fontawesome-free/css/all.min.css')}}"
            rel="stylesheet"
            type="text/css">
        <link
            href="{{asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}"
            rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link
            href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}"
            rel="stylesheet">

        <link rel="icon" href="{{asset('img/logo.png')}}">

        <script src="{{asset('js/animate.min.js')}}"></script>

    </head>

    <body id="page-top">
        
    <div class="se-pre-con"></div>

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul
                class="navbar-nav bg-gradient-sidebar sidebar sidebar-dark accordion"
                id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a
                    class="sidebar-brand d-flex align-items-center justify-content-center"
                    href="#">
                    <div class="sidebar-brand-text mx-3">ADMIN</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="{{url('showdashboard')}}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Tagihan -->
                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseTagihan"
                        aria-expanded="true"
                        aria-controls="collapseTagihan">
                        <i class="fas fa-fw fa-plus"></i>
                        <span>Tagihan</span>
                    </a>
                    <div
                        id="collapseTagihan"
                        class="collapse"
                        aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <div class="collapse-divider"></div>
                            <a class="collapse-item" href="{{url('tambahtagihan')}}">Tambah Tagihan</a>
                            <a class="collapse-item" href="{{url('otorisasitagihan')}}">Otoritas Tagihan</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Tarif -->
                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseTarif"
                        aria-expanded="true"
                        aria-controls="collapseTarif">
                        <i class="fas fa-fw fa-list"></i>
                        <span>Tarif</span>
                    </a>
                    <div
                        id="collapseTarif"
                        class="collapse"
                        aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
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
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapsePages"
                        aria-expanded="true"
                        aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Laporan</span>
                    </a>
                    <div
                        id="collapsePages"
                        class="collapse"
                        aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <div class="collapse-divider"></div>
                            <a class="collapse-item" href="{{url('showlaporanharian')}}">Laporan Harian</a>
                            <a class="collapse-item" href="{{url('showlaporanbulanan')}}">Laporan Bulanan</a>
                            <a class="collapse-item" href="{{url('showpemakaian')}}">Pemakaian Bulanan</a>
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
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseNasabah"
                        aria-expanded="true"
                        aria-controls="collapseNasabah">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Nasabah</span>
                    </a>
                    <div
                        id="collapseNasabah"
                        class="collapse"
                        aria-labelledby="headingNasabah"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{url('showformnasabah')}}">Tambah Nasabah</a>
                            <a class="collapse-item" href="{{url('showdatanasabah')}}">Data Nasabah</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Tempat Usaha -->
                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseUsaha"
                        aria-expanded="true"
                        aria-controls="collapseUsaha">
                        <i class="fas fa-fw fa-store"></i>
                        <span>Tempat Usaha</span>
                    </a>
                    <div
                        id="collapseUsaha"
                        class="collapse"
                        aria-labelledby="headingUsaha"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{url('showformtempatusaha')}}">Tambah Tempat Usaha</a>
                            <a class="collapse-item" href="{{url('showtempatusaha')}}">Data Tempat Usaha</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - METERAN -->
                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseMeter"
                        aria-expanded="true"
                        aria-controls="collapseMeter">
                        <i class="fas fa-tools"></i>
                        <span>Alat Meter</span>
                    </a>
                    <div
                        id="collapseMeter"
                        class="collapse"
                        aria-labelledby="headingMeter"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{url('tambahalat')}}">Tambah Alat</a>
                            <a class="collapse-item" href="{{url('dataalat')}}">Data Alat</a>
                            <a class="collapse-item" href="{{url('gantialat')}}">Ganti Alat</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Hari Libur -->
                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseLibur"
                        aria-expanded="true"
                        aria-controls="collapseLibur">
                        <i class="far fa-calendar-alt"></i>
                        <span>Hari Libur</span>
                    </a>
                    <div
                        id="collapseLibur"
                        class="collapse"
                        aria-labelledby="headingLibur"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{url('tambahlibur')}}">Tambah Hari Libur</a>
                            <a class="collapse-item" href="{{url('showdatalibur')}}">Data Hari Libur</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - User -->
                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseUser"
                        aria-expanded="true"
                        aria-controls="collapseUser">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Pegawai</span>
                    </a>
                    <div
                        id="collapseUser"
                        class="collapse"
                        aria-labelledby="headingUser"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{url('showtambahuser')}}">Tambah Pegawai</a>
                            <a class="collapse-item" href="{{url('showdatauser')}}">Data Pegawai</a>
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
                    <nav
                        class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button
                            id="sidebarToggleTop"
                            class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="searchDropdown"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div
                                    class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                class="form-control bg-light border-0 small"
                                                placeholder="Search for..."
                                                aria-label="Search"
                                                aria-describedby="basic-addon2">
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
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="userDropdown"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$username}}</span>
                                    <img
                                        class="img-profile rounded-circle"
                                        src="{{asset('img/icon_user.png')}}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div
                                    class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a
                                        class="dropdown-item"
                                        href="#"
                                        data-toggle="modal"
                                        data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->
                    @include('admin.flash-message')
                    @include('admin.message')
                    @yield('content')
                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy;PT Pengelola Pusat Perdagangan Caringin</span>
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
            <div
                class="modal fade"
                id="logoutModal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true">
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
                            <a class="btn btn-primary" href="{{url('logout')}}">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(window).load(function() {
            		$(".se-pre-con").fadeIn("slow").fadeOut("slow");;
	            });
            </script>

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
            <script src="{{asset('js/datatables.buttons.min.js')}}"></script>
            <script src="{{asset('js/buttons.flash.min.js')}}"></script>
            <script src="{{asset('js/jszip.min.js')}}"></script>
            <script src="{{asset('js/pdfmake.min.js')}}"></script>
            <script src="{{asset('js/vfs_fonts.js')}}"></script>
            <script src="{{asset('js/buttons.html5.min.js')}}"></script>
            <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
            
            <!--for column table toggle-->
            <script>
                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    $($.fn.dataTable.tables(true))
                        .DataTable()
                        .columns
                        .adjust();
                });
            </script>
            <script>
                jQuery.fn.dataTable.Api.register( 'processing()', function ( show ) {
                    return this.iterator( 'table', function ( ctx ) {
                        ctx.oApi._fnProcessingDisplay( ctx, show );
                    } );
                });
            </script>
            <script>
                $(document).ready(function () {
                    $(
                        '#tableListrikPakai,#tableAirPakai,#tableKebersihanPakai,#tableKeamananPakai,#dataAir,#dataListrik'
                    ).DataTable({
                        "processing": true,
                        "bProcessing":true,
                        "language": {
                            'loadingRecords': '&nbsp;',
                            'processing': '<i class="fas fa-spinner"></i>'
                        },
                        "scrollX": true,
                        "bSortable": false,
                        "deferRender": true
                    });
                });
            </script>
            <script>
                $(document).ready(function () {
                    $(
                        '#tableAir,#tableListrik,#tableKeamanan,#tableKebersihan,#tableTempat,#tableUser,#tableTagihan,#dataNasabah,#tableTunggakan'
                    ).DataTable({
                        "processing": true,
                        "bProcessing":true,
                        "language": {
                            'loadingRecords': '&nbsp;',
                            'processing': '<i class="fas fa-spinner"></i>'
                        },
                        "scrollX": true,
                        "bSortable": false,
                        "deferRender": true,
                        "dom": "r" + "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'r" +
                                "ow'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

                        "buttons": [
                            {
                                text: '<i class="fas fa-file-pdf fa-lg"></i>',
                                extend: 'pdf',
                                className: 'btn btn-danger bg-gradient-danger',
                                title: 'BP3C PDF',
                                exportOptions: {
                                    columns: ':visible(.export-col)'
                                },
                                customize: function (doc) {
                                    doc.pageMargins = [25,25,25,25];
                                    doc.defaultStyle.fontSize = 12;
                                    doc.styles.tableHeader.fontSize = 14;
                                    doc.styles.title.fontSize = 20;
                                }
                            }, {
                                text: '<i class="fas fa-file-excel fa-lg"></i>',
                                extend: 'excel',
                                className: 'btn btn-success bg-gradient-success',
                                title: 'BP3C Excel',
                                exportOptions: {
                                    columns: ':visible(.export-col)'
                                }
                            }
                        ]
                    });
                });
            </script>
            <script>
                $(document).ready(function(){
                    $("#success-alert,#warning-alert,#error-alert,#info-alert").fadeTo(1700, 500).slideUp(500, function(){
                        $("#success-alert,#warning-alert,#error-alert,#info-alert").slideUp(500);
                    });
                });
            </script>
            <script>
                $(document).ready(function(){
                    $("#pass-alert").fadeTo(8000, 7000).slideUp(7000, function(){
                        $("#pass-alert").slideUp(7000);
                    });
                });
            </script>

            @yield('js')
        </body>

    </html>