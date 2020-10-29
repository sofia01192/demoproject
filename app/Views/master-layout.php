<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $settings['site-title']; ?></title>
	<meta charset="UTF-8">
	<meta name="description" content="<?php echo $settings['site-description']; ?>">
	<meta name="keywords" content="<?php echo $settings['site-keywords']; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>
	<!--timepicker-->

	
<!-- link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" /> -->
	<!-- Stylesheets -->
 <link rel="stylesheet" href="<?php echo assetUrl();?>css/bootstrap.min.css"/> 
	<link rel="stylesheet" href="<?php echo assetUrl();?>css/font-awesome.min.css"/>
	<link rel="stylesheet" href="<?php echo assetUrl();?>css/jquery-ui.min.css"/>
	<link rel="stylesheet" href="<?php echo assetUrl();?>css/flaticon.css"/>
	<link rel="stylesheet" href="<?php echo assetUrl();?>css/owl.carousel.css"/>
	<link rel="stylesheet" href="<?php echo assetUrl();?>css/style.css"/>
	<link rel="stylesheet" href="<?php echo assetUrl();?>css/animate.css"/>
	<link rel="stylesheet" href="<?php echo assetUrl();?>css/developer.css"/>
	<link rel="stylesheet" href="<?php echo assetUrl();?>jquery-timepicker/jquery.timepicker.min.css"/>

	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo base_url('/public/jquery-timepicker/jquery.timepicker.min.js') ?>"></script>
</head>
<body>

		
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	
	<!-- Header section -->
	<header class="header-section">
		<div class="header-warp">
			<!-- logo -->
			<a href="<?php echo base_url();?>" class="site-logo">
				<img src="<?php echo assetUrl();?>img/logo.png" alt="">
			</a>
			<!-- responsive -->
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			<!-- Navigation Menu -->
			
				<?php 
  $session = \Config\Services::session();


if($session->userData !== NULL){ echo "session value is set"; ?>
<ul class="main-menu">
				<li <?php echo (uri_string() == 'parlourdashboard')?'class="active"':'';?>><a href="<?php echo base_url('parlourdashboard');?>">Home</a></li>
				<li <?php echo (uri_string() == 'parlours')?'class="active"':'';?>><a href="<?php echo base_url('parlours');?>">My Parlours</a></li>
				
				<!-- <li <?php //echo (uri_string() == 'logout')?'class="active"':'';?>><a href="<?php //echo base_url('logout');?>">Logout</a></li> -->
				

  <button class="site-btn sb-line small dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $session->userData['title'];?>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="<?php echo base_url('user-profile'); ?>">Profile</a>
    <a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Logout</a>
    
  </div>


			</ul>
			
<?php }else{ echo "no session value";?>

	<ul class="main-menu">
				<li <?php echo (uri_string() == '/')?'class="active"':'';?>><a href="<?php echo base_url('/');?>">Home</a></li>
				<li <?php echo (uri_string() == 'about-us')?'class="active"':'';?>><a href="<?php echo base_url('about-us');?>">About Us</a></li>
				<li <?php echo (uri_string() == 'nearby-parlours')?'class="active"':'';?>><a href="<?php echo base_url('nearby-parlours');?>">Parlours</a></li>
				<li <?php echo (uri_string() == 'shop')?'class="active"':'';?>><a href="<?php echo base_url('shop');?>">Shop</a></li>
				<li <?php echo (uri_string() == 'blog')?'class="active"':'';?>><a href="<?php echo base_url('blog');?>">Blog</a></li>
				<li <?php echo (uri_string() == 'faqs')?'class="active"':'';?>><a href="<?php echo base_url('faqs');?>">FAQs</a></li>
				<li <?php echo (uri_string() == 'contact-us')?'class="active"':'';?>><a href="<?php echo base_url('contact-us');?>">Contact</a></li>
				<li <?php echo (uri_string() == 'login')?'class="active"':'';?>><a href="<?php echo base_url('login');?>">Login</a></li>
	<?php }?>

			</ul>

			<div class="header-right">
				<?php if($session->userData !== NULL){ ?>
				<a href="<?php echo base_url('add-your-parlour');?>" class="site-btn sb-line sb-big">Add Your Parlour</a>
			<?php }else{ ?>
				<a href="" class="site-btn sb-big">Book an Appointment</a>
			<?php } ?>
			</div>
		</div>
	</header>
	<!-- Header section end -->
                                   
	<?php echo $this->renderSection('content') ?>

	<!-- Footer section -->
	<footer class="footer-section set-bg" data-setbg="<?php echo assetUrl();?>img/footer-bg.jpg" id="footer">
		<div class="footer-warp">
			<div class="footer-widgets">
				<div class="row">
					<div class="col-xl-7 col-lg-7">
						<div class="row">
							<div class="col-xl-4 col-lg-5 col-md-6">
								<div class="footer-widget about-widget">
									<img src="<?php echo base_url('/public/img/logo.png')?>" alt="">
									<p><?php echo $aboutUsContent->content;?></p>
									<div class="fw-social">
										<a href=""><i class="fa fa-pinterest"></i></a>
										<a href=""><i class="fa fa-facebook"></i></a>
										<a href=""><i class="fa fa-twitter"></i></a>
										<a href=""><i class="fa fa-dribbble"></i></a>
										<a href=""><i class="fa fa-behance"></i></a>
										<a href=""><i class="fa fa-linkedin"></i></a>
									</div>
								</div> 
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 offset-xl-2 offset-lg-1 offset-md-0">
								<div class="footer-widget list-widget">
									<h4 class="fw-title"><i class="flaticon-009-makeup-5"></i>Our Services</h4>
									<ul>
									<?php $x = 0;
										  foreach($allServices as $as){ ?>										  	
										  	<?php if($x == 8){ ?>
										  		</ul><ul>
										  	<?php } ?>
										  	<li><a href="<?php echo base_url('services/'.str_replace(' ', '-', strtolower($as->title)));?>"><?php echo $as->title;?></a></li>
									<?php 	$x++;
										  } ?>
									</ul>
								</div> 
							</div>
						</div>	
					</div>
					<div class="col-xl-4 col-lg-5 offset-xl-1 offset-lg-0 offset-md-0 footer-widget">
						<h4 class="fw-title"><i class="flaticon-039-make-up"></i>Featured Parlours</h4>
					</div>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="footer-nav">
					<ul>
						<li><a href="<?php echo base_url('/');?>">Home</a></li>
						<li><a href="<?php echo base_url('/about-us');?>">About us</a></li>
						<li><a href="<?php echo base_url('list');?>">Parlours</a></li>
						<li><a href="<?php echo base_url('shop');?>">Shop</a></li>
						<li><a href="<?php echo base_url('blog');?>">Blog</a></li>
						<li><a href="<?php echo base_url('contact-us');?>">Contact</a></li>
					</ul>
				</div>
				<div class="copyright">
					<p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <?php echo $settings['site-title']?></p>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer section end -->


	<!--====== Javascripts & Jquery ======-->

	<!--timepicker-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	

	<script src="<?php echo assetUrl();?>js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo assetUrl();?>js/jquery-ui.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

	<script src="<?php echo assetUrl();?>js/bootstrap.min.js"></script>
	<script src="<?php echo assetUrl();?>js/owl.carousel.min.js"></script>
	<script src="<?php echo assetUrl();?>js/circle-progress.min.js"></script>
	<script src="<?php echo assetUrl();?>js/main.js"></script>
	<script src="<?php echo assetUrl();?>js/developer.js"></script>
<script src="<?php echo base_url('/public/jquery-timepicker/jquery.timepicker.min.js') ?>"></script>

<!-- script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
<!--   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>-->


    </body>
</html>