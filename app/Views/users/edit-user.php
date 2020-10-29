<?php echo $this->extend('master-layout'); ?>

<?php echo $this->section('content'); ?>


    <!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="<?php echo assetUrl();?>img/page-top-bg/3.jpg" >
		<div class="container text-center">
			<h2>Edit User</h2>
		</div>
	</section>
	<!-- Page info section end -->


	<!-- Contact section -->
	<section class="contact-section spad">
		<div class="container">
			<h1>hello world</h1>
			<?php echo form_open('Users/updateuserProfile', ['class' => 'contact-form', 'method' => 'post']);?>
			<?php foreach ($user as $us) : ?>
			<?php echo form_hidden('id', $us["id"]); ?>
			<div class="row branches">

				<div class="col-lg-6 ">
					<div class="row">
						<div class="col-md-12">
							<label>Full Name</label>
							<?php echo form_input('name', $value = $us["title"], ['type' => 'text', 'required' => 'required']);?>
						</div>
						<div class="col-md-12">
							<label>Telephone</label>
							<?php echo form_input('phone', $value = $us["telephone"], ['type' => 'text', 'required' => 'required']);?>
						</div>
						
						
					</div>	
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-md-12">
							<label>Identity Number</label>
							<?php echo form_input('identity_no', $value = strval($us["identity_no"]),['type' => 'text' , 'required' => 'required']);?>
						 
						</div>
					</div>				
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-md-12">
							<label>Address</label>
							<?php echo form_input('address', $value = strval($us["address"]), ['type' => 'text']);?>
						</div>
					</div>				
				</div>
				<div class="col-md-12 margin-top-20px" >
					<button class="site-btn" type="submit">Update</button>
					<button class="btn btn-primary" onclick="redirect('Users/userProfile')">Cancel</button>
				</div>	
				
			</div>
			<?php endforeach; ?>
			<?php echo form_close();?>
        </div>
	</section>

<?php echo $this->endSection(); ?>