<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SDM PT. Mitra Bumdes - Dashboard</title>
	<link rel="shortcut icon" href="<?=base_url()?>/assets/img/iconmbn.ico" type="image/x-icon" />
    <!-- Custom fonts for this template-->
    <link href="<?=base_url()?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url()?>/assets/css/sb-admin-2.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>/assets/jqgrid/jqueryui/redmond/jquery-ui.min.css" />
            <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>/assets/jqgrid/css/ui.jqgrid.css" />
            <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>/assets/jqgrid/css/ui.multiselect.css" />
<style>
body{
	font-size:14px;
}
</style>
</head><body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-database"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SDM PT.MBN</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
 <!-- Nav Item - Pages Collapse Menu -->
 <?php if($session->get('nama_level')=='Administrator'){?>
  <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CPAdmin"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-table"></i>
                    <span> ADMIN</span>
                </a>
                <div id="CPAdmin" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      
                        <a class="collapse-item" href="javascript:void(0)" onclick="menu('user')">USER</a>
                        <a class="collapse-item" href="javascript:void(0)" onclick="menu('jabatan')">JABATAN</a>
                        <a class="collapse-item" href="javascript:void(0)" onclick="menu('jenis_kelamin')">JENIS KELAMIN</a>
                        <a class="collapse-item" href="javascript:void(0)" onclick="menu('level')">LEVEL</a>
                        <a class="collapse-item" href="javascript:void(0)" onclick="menu('pendidikan')">PENDIDIKAN</a>
                        <a class="collapse-item" href="javascript:void(0)" onclick="menu('status')">STATUS</a>
                        <a class="collapse-item" href="javascript:void(0)" onclick="menu('unit')">UNIT</a>
                        <div class="collapse-divider"></div>
                        
                    </div>
                </div>
            </li>
 <?php }?>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-table"></i>
                    <span> DATA PEGAWAI</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      
                        <a class="collapse-item" href="javascript:void(0)" onclick="menu('home/pegawai')">Table</a>
                        <div class="collapse-divider"></div>
                        
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
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$session->get('username')?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?=base_url()?>/assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
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
<div class="container-fluid">
    
    <div class="alert alert-success" role="alert">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </div>

    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Selamat Datang!</h4>
            <p>Selamat Datang <b><?=$session->get('nama_unit')?></b> , Anda Login Sebagai <strong><?=$session->get('username')?></strong></p>
        <hr>
    </div>
</div>
<!-- Begin Page Content -->
<div class="container-fluid">

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; PT MITRA BUMDES NUSANTARA</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan Logout jika ingin mengakhiri sesi ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?=base_url()?>/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url()?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url()?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url()?>/assets/js/sb-admin-2.min.js"></script>

   <script src="<?=base_url()?>/assets/jqgrid/js/jquery.js" type="text/javascript"></script>
            <script src="<?=base_url()?>/assets/jqgrid/js/jquery-ui-custom.min.js" type="text/javascript"></script>
            <script src="<?=base_url()?>/assets/jqgrid/js/jquery.layout.js" type="text/javascript"></script>
            <script src="<?=base_url()?>/assets/jqgrid/js/grid.locale-en.js" type="text/javascript"></script>

            <script src="<?=base_url()?>/assets/jqgrid/js/ui.multiselect.js" type="text/javascript"></script>
            <script src="<?=base_url()?>/assets/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
            <script src="<?=base_url()?>/assets/jqgrid/js/jquery.tablednd.js" type="text/javascript"></script>
            <script src="<?=base_url()?>/assets/jqgrid/js/jquery.contextmenu.js" type="text/javascript"></script>
			<script>
			function menu(link){
				$.post(link,{},function(res){
					$('.container-fluid').html(res);
				});
			}
			</script>
</body>

</html>

