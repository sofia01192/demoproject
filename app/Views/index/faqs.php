<?php echo $this->extend('master-layout') ?>

<?php echo $this->section('content') ?>
    <!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="<?php echo assetUrl();?>img/page-top-bg/1.jpg" >
		<div class="container text-center">
			<h2>Frequently Asked Questions (FAQs)</h2>
		</div>
	</section>
	<!-- Page info section end -->


	<!-- timetable section -->
	<section class="timetable-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div id="accordion" class="accordion-area about-accordion">
						<?php foreach($faqs as $f){ ?>
						<div class="panel">
							<div class="panel-header" id="<?php echo $f->id;?>">
								<button class="panel-link" data-toggle="collapse" data-target="#c<?php echo $f->id;?>" aria-expanded="false" aria-controls="c<?php echo $f->id;?>"><?php echo $f->question?></button>
							</div>
							<div id="c<?php echo $f->id;?>" class="collapse" aria-labelledby="<?php echo $f->id;?>" data-parent="#accordion">
								<div class="panel-body">
									<?php echo $f->answer?>
								</div>
							</div>
						</div>
						<?php } ?>
						
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<!--  timetable section end -->

<?php echo $this->endSection() ?>