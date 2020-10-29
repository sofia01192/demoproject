<!DOCTYPE html>
<html>
<head>
   <title>Simple Map</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB05x920NL9jTKlpjlOhjz_G2csxqPpxrU&libraries=&v=weekly"
      defer
    ></script> 
    

    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      
          /* Set the size of the div element that contains the map */
      #map {
        height: 600px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>




<script>
var lat,long ;

navigator.geolocation.getCurrentPosition(showPosition);

// function getLocation() {

//   if (navigator.geolocation) {
//     //document.write('geolocation acess');
//     navigator.geolocation.getCurrentPosition(showPosition);
//   } else { 
//      document.write("Geolocation is not supported by this browser.");
//   }
// }

function showPosition(position) {
  console.log('showPosition method running');
  lat = position.coords.latitude ;
  long =  position.coords.longitude;
  //document.write('your current position is: ' + lat +"," + long);
  initMap(position.coords.latitude,position.coords.longitude);

}

function initMap(lat,long) {
  // The location of Uluru
  var uluru = {lat: arguments[0], lng: arguments[1]};
  console.log(uluru);
  //document.write('latitude: ',arguments[0],'\nlongitude: ',arguments[1]);
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 15, center: uluru});
  $iconUrl =  "<?php echo base_url('/public/img/icons/delivery.png') ?>";
  //document.write($url);
  // // The marker, positioned at Uluru
var Usericon = {
              url : $iconUrl,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(70, 70)
            };

    var marker = new google.maps.Marker({
      position: uluru, 
      map: map,
      icon: Usericon,
      title:'My Location',
      });
marker = [];
var nearestParlours = [];
nearestParlours = <?php echo json_encode($nearbyParlours)?>;
//console.log('nearest: ',nearestParlours);
//console.log(typeof nearestParlours);

nearestParlours.forEach(function(places,index){

  // console.log('place id is', index, '--', places['id']);
   console.log('places name is', index, '--', places['title']);
  latitud = places['latitude'];
 console.log('places lat is', index, '--', latitud);
  lngitud = places['longitude'];
  console.log('places lng is', index, '--', lngitud);
  titleOfmarker = places['title']; 

// var pos = {latitud , lngitud };
// //var uluru = {lat: -25.344, lng: 131.036};
// var numlat = parseFloat(pos.latitud);
// var numlng = parseFloat(pos.lngitud);
// console.log(typeof num);
// console.log(numlat);
// console.log(numlng);

marker.push(new google.maps.Marker({
 map: map,
title: titleOfmarker,
animation: google.maps.Animation.BOUNCE,
position: { lat: parseFloat(latitud), lng: parseFloat(lngitud) ,
 }
}));

});


}
</script>
<!-- 
<script type="text/javascript">
var base_url = $('#baseurl').val();

// var dateValue = $('#mydate').val();

$.ajax({
    url: base_url + "/test/showNearby",  // define here controller then function name
    method: 'POST',
    data: { latitude: lat,
            longitude: long },    // pass here your date variable into controller
    success:function(result) {
        alert(long); // alert your date variable value here
    }
});


//SELECT id, ( 3959 * acos( cos( radians(37) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(-122) ) + sin( radians(37) ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < 25 ORDER BY distance LIMIT 0 , 20;


</script>  -->

<script type="text/javascript">
var nearestParlours = [];
nearestParlours = <?php echo json_encode($nearbyParlours)?>;
console.log('nearest: ',nearestParlours);
</script>

</head>
<body>


 <div id="map"></div>
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

      </center>
        </div>

</section>
<!-- <?php// print_r($parlours); ?> -->


</body>
</html>
