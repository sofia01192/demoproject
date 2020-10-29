<?php echo $this->extend('master-layout') ?>

<?php echo $this->section('content') ?>
    <!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="<?php echo assetUrl()?>img/page-top-bg/3.jpg" >
		<div class="container text-center">
			<h2>Dashboard</h2>
		</div>
	</section>
	<!-- Page info section end -->

<?php 
  $session = \Config\Services::session();
?>
	<!-- Contact section -->
	<section class="contact-section spad">
		<div class="container">
			<center>

		 <?php if($session->getFlashdata('error') != null){ ?>
                    <div class="alert alert-danger"><?php echo $session->getFlashdata('error')?></div>
                  <?php } ?>
                  <?php if($session->getFlashdata('success') != null){ ?>
                    <div class="alert alert-success"><?php echo $session->getFlashdata('success')?></div>
                  <?php } ?>
					<h1>WELCOME PARLOUR ADMIN HAVE A NICE DAY</h1>
			</center>
        </div>
	</section>
<?php echo $this->endSection() ?>