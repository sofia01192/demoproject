<!DOCTYPE html>
<html>
<head>
	 <title>Simple Map</title>
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
        height: 400px;  /* The height is 400 pixels */
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
  lat = position.coords.latitude 
  long =  position.coords.longitude;
  initMap(position.coords.latitude,position.coords.longitude);
 // console.log(lat,long);
}

function initMap(lat,long) {
  // The location of Uluru
  var uluru = {lat: arguments[0], lng: arguments[1]};
  console.log(uluru);
  //document.write('latitude: ',arguments[0],'\nlongitude: ',arguments[1]);
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 18, center: uluru});
  // // The marker, positioned at Uluru
   var marker = new google.maps.Marker({position: uluru, map: map,title:'hello',animation: google.maps.Animation.BOUNCE,});

}

// function initMap() {
//   //getLocation();
//   // The location of Uluru
//   var uluru = {lat, long};
//   // The map, centered at Uluru
//   var map = new google.maps.Map(
//       document.getElementById('map'), {zoom: 18, center: uluru});
//   // The marker, positioned at Uluru
//   var marker = new google.maps.Marker({position: uluru, map: map,title:'hello',animation: google.maps.Animation.BOUNCE,});

// }

var markerslist = [
    {
        "id": "1",
        "lat": "4.66455174",
        "lng": "-74.07867091",
        "name": "Bogot\u00e1"
    }, 
    {
        "id": "2",
        "lat": "6.24478548",
        "lng": "-75.57050110",
        "name": "Medell\u00edn"
    }, 
    {
        "id": "3",
        "lat": "7.06125013",
        "lng": "-73.84928550",
        "name": "Barrancabermeja"
    }, 
    {
        "id": "4",
        "lat": "7.88475514",
        "lng": "-72.49432589",
        "name": "C\u00facuta"
    }, 
    {
        "id": "5",
        "lat": "3.48835279",
        "lng": "-76.51532198",
        "name": "Cali"
    }, 
    {
        "id": "6",
        "lat": "4.13510880",
        "lng": "-73.63690401",
        "name": "Villavicencio"
    }, 
    {
        "id": "7",
        "lat": "6.55526689",
        "lng": "-73.13373892",
        "name": "San Gil"
    }
];

console.log('type of: ',typeof markerslist);
var displayMarks = function(places,index){

  console.log('place id is', index, '--', places['id']);
  console.log('places name is', index, '--', places['name']);
  latitud = places['lat'];
 console.log('places lat is', index, '--', latitud);
  lngitud = places['lng'];
  console.log('places lng is', index, '--', lngitud);
  titleOfmarker = places['name']; 

marker.push(new google.maps.Marker({
         map: map,
         title: titleOfmarker,
         position: { lat: parseFloat(latitud), lng: parseFloat(lngitud)},
        }));
  

}

  //title = places['name'];

//   var marker = new google.maps.Marker(
//     {
//       position: {places['lat'],places['lng']} , 
//       map: map ,
//       title:places['name'],
//       animation: google.maps.Animation.BOUNCE
//     }
//     );

// }
markerslist.forEach(displayMarks);

</script> 

</head>
<body>

<!-- <p id="demo">Click the button to get your coordinates.</p>

<button onclick="getElementById('demo').innerHTML='changes content' ">show</button>
<button onclick="this.innerHTML=Date()">Try It</button>  -->
<!-- <button onclick="getLocation()">get location</button> -->

 <div id="map"></div>

<!-- <p id="demo"></p> -->


</body>
</html>
