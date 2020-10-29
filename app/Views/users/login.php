<?php echo $this->extend('master-layout') ?>

<?php echo $this->section('content') ?>
    <!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="<?php echo assetUrl();?>img/page-top-bg/3.jpg" >
		<div class="container text-center">
			<h2>Log-In</h2>
		</div>
	</section>
	<!-- Page info section end -->

<?php 
  $session = \Config\Services::session();
?>
		 <?php if($session->getFlashdata('error') != null){ ?>
                    <div class="alert alert-danger"><?php echo $session->getFlashdata('error')?></div>
                  <?php } ?>
                  <?php if($session->getFlashdata('success') != null){ ?>
                    <div class="alert alert-success"><?php echo $session->getFlashdata('success')?></div>
                  <?php } ?>

	<!-- Contact section -->
	<section class="contact-section spad">
		<div class="container">
			<?php echo form_open('/loginSubmit', ['class' => 'contact-form', 'method' => 'post']);?>
			<div class="row branches">
				<div class="col-lg-6 ">
					<div class="row">
						<div class="col-md-12">
							<?php echo form_input('email', '', ['type' => 'email', 'placeholder' => 'Your E-mail', 'required' => 'required']);?>
						</div>
						<div class="col-md-12">
							<?php echo form_password('password', '', ['type' => 'password', 'placeholder' => 'Your Password', 'required' => 'required']);?>
						</div>
					</div>					
				</div>
						<div class="col-md-12 margin-top-20px" >
					<button class="site-btn" type="submit">Submit</button>
					<!-- <input type="submit" value="Submit" class=" btn site-btn text-primary"> -->
					<a href="<?php echo base_url('register');?>" class="btn btn-primary">Register Now</a>
				</div>	
						
					
				
			</div>
			
			<?php echo form_close();?>
        </div>
	</section>
<?php echo $this->endSection() ?>