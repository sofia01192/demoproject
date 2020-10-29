<?php echo $this->extend('master-layout') ?>

<?php echo $this->section('content') ?>
    <!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="<?php echo assetUrl();?>img/page-top-bg/3.jpg" >
		<div class="container text-center">
			<h2>Register</h2>
		</div>
	</section>


	<!-- Contact section -->
	<section class="contact-section spad">
		<div class="container">
			<?php echo form_open('register-submit', ['class' => 'contact-form', 'method' => 'post']);?>
			<div class="row branches">
				<div class="col-lg-6 ">
					<div class="row">
						<div class="col-md-12">
							<?php echo form_input('name',  $value = set_value("name"), ['type' => 'text', 'placeholder' => 'Your Full Name', 'required' => 'required']);?>
							<?php if(isset($validations)): ?>
								<p class=" small text-danger"><?php echo displayError($validations,'title'); ?></p>
							<?php endif;?>
							
							
						</div>
						<div class="col-md-12">
							<?php echo form_input('phone', $value = set_value("phone"), ['type' => 'text', 'placeholder' => 'Your Phone', 'required' => 'required']);?>
							<?php if(isset($validations)): ?>
								<p class=" small text-danger"><?php echo displayError($validations,'phone'); ?></p>
							<?php endif;?>
							
						</div>
						<!-- z -->
						<div class="col-md-12">
							<?php echo form_password('password', '', ['type' => 'password', 'placeholder' => 'Your Password', 'required' => 'required']);?>
							<?php if(isset($validations)): ?>
								<p class=" small text-danger"><?php echo displayError($validations,'password'); ?></p>
							<?php endif;?>
							
						</div>
					</div>	
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-md-12">
							<?php echo form_input('email', $value = set_value("email"), ['type' => 'email', 'placeholder' => 'Your E-mail', 'required' => 'required']);?>
							<?php if(isset($validations)): ?>
								<p class=" small text-danger"><?php echo displayError($validations,'email'); ?></p>
							<?php endif;?>
							
						</div>
					</div>				
				</div>
				<div class="col-md-12 margin-top-20px" >
					<button class="site-btn" type="submit">Submit</button>
					<a href="<?php echo base_url('login');?>" class="btn btn-primary">Log-In</a>
				</div>	
				
			</div>
			
			<?php echo form_close();?>
        </div>
	</section>
<?php echo $this->endSection() ?>