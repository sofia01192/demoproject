<?php echo $this->extend('master-layout'); ?>

<?php echo $this->section('content'); ?>
<link rel="stylesheet" href="<?php echo assetUrl();?>css/bootstrap.min.css"/> 
    <!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="<?php echo assetUrl()?>img/page-top-bg/3.jpg" >
		<div class="container text-center">
			<h2>Nearby Parlours List</h2>
		</div>
	</section>
	<!-- Page info section end -->
<section class="contact-section spad">
		<div class="container">
			<center>

				<div class="table">
<table>
	<thead>
		<tr>
			<th>S.no</th>
      <th>Title</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Contact Person</th>
      <th>Address</th>
      
      <th>Services</th>
      <th>distance</th>
 		
		</tr>
	</thead>
	<tbody>
    <?php if(count($nearbyParlours)) : 
        $count = 1;
 foreach ($nearbyParlours as $art) : ?>
<tr>
      
      <td><?php echo $count++; ?></td>
      <td><?php echo $art->title; ?></td>
      <td><?php echo $art->phone; ?></td>
      <td><?php echo $art->email; ?></td>
      <td><?php echo $art->contact_person; ?></td>
      <td><?php echo $art->address; ?></td>
      
      <td><?php echo $art->services; ?></td>
       <td><?php echo $art->distance; ?></td>

</tr>

  <?php endforeach; ?>

  <?php 
      else : ?>
        <tr>
          <td colspan="3">No data Available</td>
        </tr>

    <?php endif; ?>
  

  </tbody>
</table>
</div>


						<div class="col-md-12">
							<div id="map"></div>
						</div>

			
  </center>
</div>      
</section>
<?php 
		$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		$ip  = '42.201.142.24';
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
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB05x920NL9jTKlpjlOhjz_G2csxqPpxrU&libraries=places&callback=initAutocomplete"
         async defer></script>

	
	<script src="<?php echo base_url('/public/js/jquery-3.2.1.min.js');?>"></script>
	<script>
		function initAutocomplete() {
		    var map = new google.maps.Map(document.getElementById('map'), {
		      center: {lat: <?php echo $lat?>, lng: <?php echo $lon?>},
		      zoom: 13,
		      mapTypeId: 'roadmap'
		    });

		    $iconUrl =  "<?php echo base_url('/public/img/icons/delivery.png') ?>";
  // // The marker, positioned at user location
			var Usericon = {
				              url : $iconUrl,
				              size: new google.maps.Size(71, 71),
				              origin: new google.maps.Point(0, 0),
				              anchor: new google.maps.Point(17, 34),
				              scaledSize: new google.maps.Size(70, 70)
            };
		    var myPos = {lat: <?php echo $lat?>, lng: <?php echo $lon?>};
		    var marker = new google.maps.Marker({
		      position: myPos, 
		      map: map,
		       icon:Usericon,
		      title:'My Location',
		      });

		   //marker = [];

			var nearestParlours = [];
			nearestParlours = <?php echo json_encode($nearbyParlours)?>;
			console.log(nearestParlours);

			nearestParlours.forEach(function(places,index){

				console.log('places name is', index, '--', places['title']);
				latitud = places['latitude'];
				console.log('places lat is', index, '--', latitud);
				lngitud = places['longitude'];
				console.log('places lng is', index, '--', lngitud);
				titleOfmarker = places['title']; 
				//console.log(titleOfmarker);
				 var pos = { lat: parseFloat(latitud), lng: parseFloat(lngitud) };
			var marker = new google.maps.Marker({
		      position: pos, 
		      map: map,
		       
		      title:titleOfmarker,
		      animation: google.maps.Animation.BOUNCE,
		      });
				// marker.push(new google.maps.Marker({
				// 	map: map,
				// 	title: titleOfmarker,
				// 	position: { lat: parseFloat(latitud), lng: parseFloat(lngitud)},
				// }));

			});
		}//end of method

	</script>
<style type="text/css">
	#map {height: 600px;
		margin-top: 100;


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

<?php echo $this->endSection(); ?>