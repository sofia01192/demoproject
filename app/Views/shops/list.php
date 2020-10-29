<?php echo $this->extend('master-layout') ?>

<?php echo $this->section('content') ?>
    <!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="<?php echo base_url('img/page-top-bg/3.jpg');?>" >
		<div class="container text-center">
			<h2>Products List</h2>
		</div>
	</section>
	<!-- Page info section end -->


	<!-- Contact section -->
	<section class="contact-section spad">
		<div class="container">
			<center>
				<img src="<?php echo assetUrl();?>img/coming-soon.jpg">
			</center>
        </div>
	</section>
<?php echo $this->endSection() ?>