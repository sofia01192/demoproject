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
			<?php echo form_open('pass', ['class' => 'contact-form', 'method' => 'post']);?>
			<div class="row branches">
				<div class="col-lg-6 ">
					<div class="row">
						
				
						<select name="services[]" id="services" multiple="multiple">
							
							<?php foreach ($services as $key): ?>
							<option value="<?php echo $key->id ?>" ><?php echo $key->title?></option>	
							<?php endforeach;  ?>

						</select>

					<select name="shirts" multiple="multiple">
                		<option value="small">Small Shirt</option>
                		<option value="med">Medium Shirt</option>
                		<option value="large" selected="selected">Large Shirt</option>
                		<option value="xlarge">Extra Large Shirt</option>
        
       			 </select>
				<!---next column--->
				

				<div class="col-md-12 margin-top-20px" >
					<button class="site-btn" type="submit">Submit</button>
					<a href="<?php echo base_url('login');?>" class="btn btn-primary">Log-In</a>
				</div>	

				
			</div>
			
			<?php echo form_close();?>
        </div>
	</section>

<script>
$(document).ready(function(){
 $('#framework').multiselect({
  nonSelectedText: 'Select Framework',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });
});
 
</script>
<?php echo $this->endSection(); ?>