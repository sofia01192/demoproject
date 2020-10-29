<?php echo $this->extend('master-layout') ?>

<?php echo $this->section('content') ?>
    <!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="<?php echo assetUrl()?>img/page-top-bg/1.jpg" >
		<div class="container text-center">
			<h2>About Us</h2>
		</div>
	</section>
	<!-- Page info section end -->


	<!-- about section -->
	<section class="about-section spad">
		<div class="container">
			<div class="row about-box">
				<div class="col-md-6 about-img">
					<img src="<?php echo assetUrl()?>img/about-1.jpg" alt="">
				</div>
				<div class="col-md-6">
					<div class="about-content">
						<h2>Welcome to My Beauty Parlour</h2>
						<p><?php echo $aboutUsContent->content?></p>
					</div>
				</div>
			</div>
			<div class="row about-box">
				<div class="col-md-6 about-img col-push">
					<img src="<?php echo assetUrl()?>img/about-2.jpg" alt="">
				</div>
				<div class="col-md-6 col-pull">
					<div class="about-content">
						<h2>Inspire</h2>
						<p><?php echo $whyUsContent->content?></p>
						<a href="<?php echo base_url('explore-nearest');?>" class="site-btn">Explore Your Nearest Parlour</a>
					</div>
				</div>
			</div>
			<div class="row about-box">
				<div class="col-md-6 about-img">
					<img src="<?php echo assetUrl()?>img/our-approach.jpg" alt="" width="550">
				</div>
				<div class="col-md-6 ">
					<div class="about-content">
						<h2>Our Approach</h2>
						<p><?php echo $ourApproach->content?></p>
					</div>
				</div>
			</div>
			<div class="row about-box">
				<div class="col-md-6 about-img col-push">
					<img src="<?php echo assetUrl()?>img/about-4.jpeg" alt="">
				</div>
				<div class="col-md-6 col-pull">
					<div class="about-content">
						<h2>Our Story</h2>
						<p><?php echo $ourStory->content?></p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- about section end -->


	<!-- Team section -->
	<section class="team-section">
		<div class="section-title text-white">
			<div class="container">
				<h2>Our Team</h2>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4 col-sm-6 p-0">
					<div class="team-member">
						<img src="<?php echo assetUrl()?>team/naeem-iqbal.jpg" alt="">
						<div class="tm-info">
							<h2>Naeem Iqbal</h2>
							<p>C E O</p>
							<a href="https://www.linkedin.com/in/iqbalnaeem/" target="_blank">+</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-sm-6 p-0">
					<div class="team-member">
						<img src="<?php echo assetUrl()?>team/sohail-sajid.jpg" alt="">
						<div class="tm-info">
							<h2>Sohail Sajid</h2>
							<p>C I O</p>
							<a href="https://www.linkedin.com/in/sohail-sajid-a608592b/" target="_blank">+</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-sm-6 p-0">
					<div class="team-member">
						<img src="<?php echo assetUrl()?>team/naveed-ramzan.jpg" alt="">
						<div class="tm-info">
							<h2>Naveed Ramzan</h2>
							<p>C T O</p>
							<a href="https://www.linkedin.com/in/naveedramzan/" target="_blank">+</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Team section end -->


	<!--  Newsletter section -->
	<section class="newsletter-section set-bg hide" data-setbg="<?php echo assetUrl()?>img/newsletter-bg.jpg">
		<div class="container">
			<div class="section-title text-white m-0">
					<h2>Stay in touch</h2>
				</div>	
			<form class="newsletter-form">
				<div class="row">
					<div class="col-lg-5">
						<input type="text" placeholder="Your Name">
					</div>
					<div class="col-lg-5">
						<input type="text" placeholder="Your Name">
					</div>
					<div class="col-lg-2">
						<button class="site-btn">Subscribe Now!</button>
					</div>
					<div class="col-lg-12">
						<input type="checkbox" name="one" id="cb-one">
						<label for="cb-one">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere </label>
						<input type="checkbox" name="two" id="cb-two" checked>
						<label for="cb-two">Faucibus orci luctus et ultrices posuere</label>
					</div>
				</div>
			</form>
		</div>
	</section>
	<!--  Newsletter section end -->
<?php echo $this->endSection() ?>