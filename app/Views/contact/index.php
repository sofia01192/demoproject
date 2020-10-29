<?php echo $this->extend('master-layout') ?>

<?php echo $this->section('content') ?>
    <!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="<?php echo assetUrl();?>img/page-top-bg/3.jpg" >
		<div class="container text-center">
			<h2>Contact Us</h2>
		</div>
	</section>
	<!-- Page info section end -->


	<!-- Contact section -->
	<section class="contact-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 contact-content">
					<h2 class="contact-title">Diva Beatuy Salon</h2>
					<p><?php echo $aboutUsContent->content;?></p>
					<div class="ci-item">
						<div class="ca-icon">
							<img src="img/icons/map.png" alt="">
						</div>
						<div class="ca-text"><?php echo $settings['address']?></div>
					</div>
					<div class="ci-item">
						<div class="ca-icon">
							<img src="img/icons/phone.png" alt="">
						</div>
						<div class="ca-text"><a href="tel:<?php echo $settings['telephone']?>"><?php echo $settings['telephone'];?></a></div>
					</div>
				</div>
				<div class="col-lg-6">
					<h2 class="contact-title">Get in Touch</h2>
					<?php echo form_open('/Contact/submitTicket', ['class' => 'contact-form', 'method' => 'post']);?>
						<div class="row">
							<div class="col-md-6">
								<?php echo form_input('name', '', ['placeholder' => 'Your Name', 'required' => 'required']);?>
							</div>
							<div class="col-md-6">
								<?php echo form_input('email', '', ['type' => 'email', 'placeholder' => 'Your E-mail', 'required' => 'required']);?>
							</div>
							<div class="col-md-6">
								<?php echo form_dropdown('ticketcategory_id', $ticketcategories, '');?>
							</div>
							<div class="col-md-6">
								<?php echo form_dropdown('ticketpriority_id', $ticketpriorities, '');?>
							</div>
							<div class="col-md-12 margin-top-20px" >
								<?php echo form_textarea('message', '', ['placeholder' => 'Your Message', 'required' => 'required', 'rows' => 5]);?>
								<button class="site-btn">Submit</button>
							</div>
						</div>
					<?php echo form_close();?>
				</div>
			</div>
			<br>
            <iframe width="100%" height="400" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB05x920NL9jTKlpjlOhjz_G2csxqPpxrU&q=<?php echo $settings['address']?>" allowfullscreen></iframe>		
        </div>
	</section>
	<!-- Contact section end -->
	<script src="<?php echo base_url('js/map.js');?>"></script>
	<script src="<?php echo base_url('js/jquery-3.2.1.min.js');?>"></script>
	<script>
		$(document).ready(function(){
			$('select option:first-child').attr('disabled', true);
		});
	</script>
<?php echo $this->endSection() ?>