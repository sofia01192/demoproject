<?php echo $this->extend('master-layout') ?>

<?php echo $this->section('content') ?>


    <!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="<?php echo assetUrl();?>img/page-top-bg/3.jpg" >
		<div class="container text-center">
			<h2>Add New Branch</h2>
		</div>
	</section>
	<!-- Page info section end -->


<?php 
if(isset($error)):?>
	<?php print_r($error);?>
<?php endif; ?>
<?php 
if(isset($branchErrors)):?>
	<?php
	echo "<br>branches errors<br>";
	 print_r($branchErrors);?>
	
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
							<a href="#" id="select"><span>Select Services  <i class="fa fa-caret-down" aria-hidden="true"></i></span>
							</a>
								<ul id='table' style="display: none;">
									<?php foreach ($services as $key) : ?>
									<li>
										<div class="td" style="padding: 5px 5px 0 5px;font-size: 16;font-style: italic;">
											<input class="cb" name="services[]" type="checkbox" value="<?php echo $key->id ?>" > <?= $key->title ?> &nbsp;</input>


									<!---price-->			
										<input class="table-price" type="text" id="<?= 'price-'.$key->id ?>" name="<?= 'price-'.$key->id ?>" style="display: none; margin-bottom: 5px " placeholder="Price"> &nbsp;</input>
									<!---duration-->
										<input class="table-duration" type="text" id="<?= 'duration-'.$key->id ?>" name="<?= 'duration-'.$key->id ?>" style="display: none;margin-bottom: 5px  " placeholder="Duration"></input>
										</div>
									</li>
									<?php
									endforeach;
									?>
								</ul>
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

			<div class="col-md-12 margin-top-20px" >
					<button class="site-btn">Submit</button>
					
				</div>	
			<?php echo form_close();?>
        </div>
	</section>
	<?php 
		$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		$ip  = '101.50.127.76';
      	
      	//$ip  = '42.201.142.24';
      	//$url = "http://api.ipstack.com/$ip?access_key=a0f9cff437e277d840a3ab983c6aa7f4";
      	$url = "http://ip-api.com/json/$ip";
      	$ch  = curl_init();
      	curl_setopt($ch, CURLOPT_URL, $url);
      	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
     	$data = curl_exec($ch);
      	curl_close($ch);
	    if ($data) {
          	$location = json_decode($data);
          	$lat = $location->lat;
          	$lon = $location->lon;	
          	$sun_info = date_sun_info(time(), $lat, $lon);
      	}
	?>
	<!-- Contact section end -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo base_url('/public/jquery-timepicker/jquery.timepicker.min.js') ?>"></script>
<!--maps--->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB05x920NL9jTKlpjlOhjz_G2csxqPpxrU&libraries=places&callback=initAutocomplete"
         async defer></script>

	<script src="<?php echo base_url('/public/js/map.js');?>"></script>
	<!-- <script src="<?php //echo base_url('/public/js/jquery-3.2.1.min.js');?>"></script>  -->
	

	<script>
		
		$(document).ready(function(){
			

			$('#select').click(function() {
				$('#table').toggle();
			})

			$('body').on('change', 'input[type="checkbox"]', function(cb) {
				//console.log('changed' + $(this).val());
				let id = $(this).val().substring($(this).val().indexOf('-') + 1);
				console.log(id);
				console.log(cb.checked);

				if ($(this).prop("checked") == true) {
					
					$(`input[name="price-${id}"]`).show();
					$(`input[name="duration-${id}"]`).show();
					$(`input[name="duration-${id}"]`).timepicker({

						timeFormat :'H:i:s',
						step : 5,
					});

				}
				else {
					
					$(`input[name="price-${id}"]`).hide();
					$(`input[name="duration-${id}"]`).hide();
				}
				
			});

			$('select option:first-child').attr('disabled', true);

		});   //end document ready   	

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


      .cb {

margin-top: 4px;
	}
	.tb {
		float: left;
	}
#table li {
	list-style: none;
margin-left: 0;
margin-bottom: 0;
    padding: 0px 4px 0px 4px;;

}
#table {
	
    border: 1px solid #ccc;
    min-width: 520px;
    position: absolute;
    overflow: scroll;
    height: 300px;
}
#select {
	width: 520px;
    border-radius: 2px;
    display: block;
    padding: 4px;
    text-decoration: none;
    color: #000;
    border: 1px solid #ccc;
    text-align: center;

}
    
    </style>
<?php echo $this->endSection() ?>