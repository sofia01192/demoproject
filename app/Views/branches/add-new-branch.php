<?php echo $this->extend('master-layout') ?>

<?php echo $this->section('content') ?>


    <!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="<?php echo assetUrl();?>img/page-top-bg/3.jpg" >


		<div class="container text-center">
			<h2>Add New Branch</h2>
		</div>
	</section>
	<!-- Page info section end -->


<?php echo $parlourId; 
if(isset($error)):?>
	<?php print_r($error);?>
<?php endif; ?>
<?php echo "<br>branches errors<br>";
if(isset($branchErrors)):?>
	<?php print_r($branchErrors);?>
	
<?php endif; ?>


	<!-- Contact section -->
	<section class="contact-section spad">
		<div class="container">
			<?php echo form_open('add-branch', ['class' => 'contact-form', 'method' => 'post']);?>
			<div class="row branches">
				<div class="col-lg-12 ">
				<?php 	$session = \Config\Services::session();
				$user_id = $session->userData['id']; ?>
					
					<?php echo form_hidden('userid', $user_id);?>
					<?php echo form_hidden('parlour_id', $parlourId);?>
								
				</div>
				<div class="col-lg-12 branch">
					<h2 class="contact-title">Branch Details</h2>
					<div class="row">
						<div class="col-md-6">
							<?php echo form_input('branch_title', '', ['placeholder' => 'Branch Name', 'required' => 'required']);?>
							<?php if(isset($branchErrors)): ?>
								<p class=" small text-danger"><?php echo displayError($branchErrors,'title'); ?></p>
							<?php endif;?>
						</div>
						<div class="col-md-6">
							<?php echo form_input('branch_email', '', ['type' => 'email', 'placeholder' => 'Branch E-mail', 'required' => 'required']);?>
							<?php if(isset($branchErrors)): ?>
								<p class=" small text-danger"><?php echo displayError($branchErrors,'email'); ?></p>
							<?php endif;?>
						</div>
						<div class="col-md-6">
							<?php echo form_input('branch_phone', '', ['type' => 'text', 'placeholder' => 'Branch Contact Phone', 'required' => 'required']);?>
							<?php if(isset($branchErrors)): ?>
								<p class=" small text-danger"><?php echo displayError($branchErrors,'phone'); ?></p>
							<?php endif;?>
						</div>
						<div class="col-md-6">
							<?php echo form_input('branch_contact_person', '', ['type' => 'text', 'placeholder' => 'Branch Contact Person', 'required' => 'required']);?>
							<?php if(isset($branchErrors)): ?>
								<p class=" small text-danger"><?php echo displayError($branchErrors,'contact_person'); ?></p>
							<?php endif;?>
						</div>

						<div class="col-md-6">

					 <select name="services[]" id="service" multiple="multiple">
      				<?php foreach ($services as $key): ?>
      				<option value="<?php echo $key->id ?>"><?php echo $key->title?></option>
     				 <?php endforeach;  ?>
      
     				</select>

     				<?php if(isset($branchErrors)): ?>
								<p class=" small text-danger"><?php echo displayError($branchErrors,'services'); ?></p>
							<?php endif;?>
						</div>

						<div class="col-md-6">
							<?php echo form_input('branch_address', '', ['type' => 'text', 'id' => 'branch_address', 'placeholder' => 'Branch Address', 'required' => 'required']);?>
							<?php if(isset($branchErrors)): ?>
								<p class=" small text-danger"><?php echo displayError($branchErrors,'address'); ?></p>
							<?php endif;?>
						</div>
						<input type="hidden" id="branch_address_lat" name="branch_address_lat" />
						<input type="hidden" id="branch_address_lng" name="branch_address_lng" />
						<div class="col-md-12">
							<div id="map"></div>
						</div>
					</div>					
				</div>
			</div>
			<!-- <div style="margin-top:30px;">
				<a style="float:right;" id="add-branch" href="javascript::void()" class="btn btn-primary">Add New Branch</a>            	
				<div class="clear-fix"></div>
			</div> -->

			<div class="col-md-12 margin-top-20px" >
					<button class="site-btn">Submit</button>
					
				</div>	
			<?php echo form_close();?>
        </div>
	</section>
	<?php 
		$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		$ip  = '101.50.127.76';
      	$url = "http://api.ipstack.com/$ip?access_key=a0f9cff437e277d840a3ab983c6aa7f4";
      	$ch  = curl_init();
      	curl_setopt($ch, CURLOPT_URL, $url);
      	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
     	$data = curl_exec($ch);
      	curl_close($ch);
	    if ($data) {
          	$location = json_decode($data);
          	$lat = $location->latitude;
          	$lon = $location->longitude;	
          	$sun_info = date_sun_info(time(), $lat, $lon);
      	}
	?>
	<!-- Contact section end -->

<!--- multiselect dropdown ---->	

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>


<script type="text/javascript">
	$(document).ready(function(){
 $('#service').multiselect({
  nonSelectedText: 'Select Branch Services',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px',

 });

 });
</script>


<!--maps--->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB05x920NL9jTKlpjlOhjz_G2csxqPpxrU&libraries=places&callback=initAutocomplete"
         async defer></script>

	<script src="<?php echo base_url('js/map.js');?>"></script>
	<!-- <script src="<?php// echo base_url('js/jquery-3.2.1.min.js');?>"></script> -->
	<script>
		
		$(document).ready(function(){
			$('select option:first-child').attr('disabled', true);
		});      	

		function initAutocomplete() {
			var lat, lon;
		    var map = new google.maps.Map(document.getElementById('map'), {
		      center: {lat: <?php echo $lat?>, lng: <?php echo $lon?>},
		      zoom: 12,
		      mapTypeId: 'roadmap'
		    });

		    // Create the search box and link it to the UI element.
		    var input = document.getElementById('branch_address');
		    var searchBox = new google.maps.places.SearchBox(input);
		    // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

		    // Bias the SearchBox results towards current map's viewport.
		    map.addListener('bounds_changed', function() {
		      searchBox.setBounds(map.getBounds());
		    });

		    var markers = [];
		    // Listen for the event fired when the user selects a prediction and retrieve
		    // more details for that place.
		    searchBox.addListener('places_changed', function() {
		      var places = searchBox.getPlaces();

		      if (places.length == 0) {
		        return;
		      }

		      // Clear out the old markers.
		      markers.forEach(function(marker) {
		        marker.setMap(null);
		      });
		      markers = [];

		      // For each place, get the icon, name and location.
		      var bounds = new google.maps.LatLngBounds();
		      places.forEach(function(place) {
		        if (!place.geometry) {
		          console.log("Returned place contains no geometry");
		          return;
		        }
		        lat = place.geometry.location.lat();
		        lon = place.geometry.location.lng();

		        document.getElementById('branch_address_lat').value = lat;
		        document.getElementById('branch_address_lng').value = lon;
		        var icon = {
		          url: place.icon,
		          size: new google.maps.Size(71, 71),
		          origin: new google.maps.Point(0, 0),
		          anchor: new google.maps.Point(17, 34),
		          scaledSize: new google.maps.Size(25, 25)
		        };

		        // Create a marker for each place.
		        markers.push(new google.maps.Marker({
		          map: map,
		          icon: icon,
		          title: place.name,
		          position: place.geometry.location
		        }));

console.log(place.geometry.location);
		        //lat = place.geometry.location

		        if (place.geometry.viewport) {
		          // Only geocodes have viewport.
		          bounds.union(place.geometry.viewport);
		        } else {
		          bounds.extend(place.geometry.location);
		        }
		      });
		      map.fitBounds(bounds);
		      // map.style.height = '200px';
		    });
		}
	</script>
	<style>
      #map {height: 300px;
      }
      #map #infowindow-content {
        display: inline;
      }
      #infowindow-content .title {
        font-weight: bold;
      }
      #infowindow-content {
        display: none;
      }
      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }
      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }
      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }      
    </style>
<?php echo $this->endSection() ?>