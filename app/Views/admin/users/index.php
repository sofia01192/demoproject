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
<body class="bg-gradient-primary">

   <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block " style="background:url('./public/assets/images/about-us.png') no-repeat;">
                <a href="<?php echo base_url('/');?>" title="Main Website | <?php echo $settings['site-title']; ?>">
                  <img src="./public/assets/images/logo.png">
                </a>
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <?php if($session->getFlashdata('error') != null){ ?>
                    <div class="alert alert-danger"><?php echo $session->getFlashdata('error')?></div>
                  <?php } ?>
                  <?php if($session->getFlashdata('success') != null){ ?>
                    <div class="alert alert-success"><?php echo $session->getFlashdata('success')?></div>
                  <?php } ?>
                  <form class="user" method="post" action="<?php echo base_url('admin-login');?>">
                    <div class="form-group">
                      <input type="email" name="username" class="form-control form-control-user" required="required" placeholder="Enter Email Address..." value="ping@naveedramzan.com">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" required="required" placeholder="Password" value="admin">
                    </div>
                    <input type="submit" value="Log-In" class="btn btn-primary btn-user btn-block">                    
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>/public/admin/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>/public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url();?>/public/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url();?>/public/admin/js/sb-admin-2.min.js"></script>

</body>

</html>