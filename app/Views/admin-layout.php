<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin End | <?php echo $settings['site-title']; ?> | <?php echo $settings['slogan']; ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta charset="UTF-8">
  <meta name="description" content="<?php echo $settings['site-description']; ?>">
  <meta name="keywords" content="<?php echo $settings['site-keywords']; ?>">
  <link href="<?php echo base_url('public/admin/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?php echo base_url('public/admin/css/sb-admin-2.min.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('public/admin/css/developer.css');?>" rel="stylesheet">
</head>
<?php 
  $session = \Config\Services::session();
?>
<body id="page-top">
   <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin-dashboard');?>">
        <div class="sidebar-brand-text mx-3">
          <img src="<?php echo assetUrl();?>img/logo.png">
        </div>
      </a>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('admin-dashboard');?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#operations" aria-expanded="true" aria-controls="operations">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Operations</span>
        </a>
        <div id="operations" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url('admin-showlist/tickets');?>">Tickets</a>
            <a class="collapse-item" href="<?php echo base_url('admin-showlist/parlours');?>">Parlours</a>
            <a class="collapse-item" href="<?php echo base_url('admin-showlist/users');?>">Users</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#settings" aria-expanded="true" aria-controls="settings">
          <i class="fas fa-fw fa-cog"></i>
          <span>Settings</span>
        </a>
        <div id="settings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url('admin-showlist/cities');?>">Cities</a>
            <a class="collapse-item" href="<?php echo base_url('admin-showlist/countries');?>">Countries</a>
            <hr>            
            <a class="collapse-item" href="<?php echo base_url('admin-showlist/cms');?>">CMS</a>
            <a class="collapse-item" href="<?php echo base_url('admin-showlist/settings');?>">Settings</a>
            <a class="collapse-item" href="<?php echo base_url('admin-showlist/userroles');?>">Userroles</a>
            <a class="collapse-item" href="<?php echo base_url('admin-showlist/emailtemplates');?>">Email Templates</a>
            <hr>
            <a class="collapse-item" href="<?php echo base_url('admin-showlist/ticketpriorities');?>">Ticket Priorities</a>
            <a class="collapse-item" href="<?php echo base_url('admin-showlist/ticketcategories');?>">Ticket Categories</a>
            <a class="collapse-item" href="<?php echo base_url('admin-showlist/ticketstatuses');?>">Ticket Statuses</a>
            <hr>
            <a class="collapse-item" href="<?php echo base_url('admin-showlist/faqs');?>">FAQs</a>
            <a class="collapse-item" href="<?php echo base_url('admin-showlist/services');?>">Services</a>
          </div>
        </div>
      </li>
      
      <hr class="sidebar-divider d-none d-md-block">
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
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
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $session->adminData['title'];?></span>
                <img class="img-profile rounded-circle" src="<?php echo base_url('img/no-photo.png');?>">
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
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

        <?php echo $this->renderSection('content') ?>
        
      </div>
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?php echo $settings['site-title']; ?> <?php echo date('Y');?></span>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url('admin-logout');?>">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo base_url('public/admin/vendor/jquery/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
  <script src="<?php echo base_url('public/admin/vendor/jquery-easing/jquery.easing.min.js');?>"></script>
  <script src="<?php echo base_url('public/admin/js/sb-admin-2.min.js');?>"></script>
  <script src="<?php echo base_url('public/admin/vendor/chart.js/Chart.min.js');?>"></script>
  <script src="<?php echo base_url('public/admin/js/demo/chart-area-demo.js');?>"></script>
  <script src="<?php echo base_url('public/admin/js/demo/chart-pie-demo.js');?>"></script>
  <script src="<?php echo base_url('public/admin/js/developer.js');?>"></script>
  <script src="https://cdn.tiny.cloud/1/bdl71ac4dyppw8ly9ekuy68vvy9mluhbpjwzk23n65glxis4/tinymce/5/tinymce.min.js" referrerpolicy="origin"/></script>
  <script type="text/javascript">
    tinymce.init({
      selector: 'textarea',
      menubar: false
    });
  </script>
</body>
</html>