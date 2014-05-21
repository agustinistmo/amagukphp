    <style>
       #map-canvas {
        height: 400px;
        width:100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
function initialize() {
  var myLatlng = new google.maps.LatLng( 20.983239, -89.615507);
  var iconBase= '<?php print MGK_HOME;?>/public/images/marker/';
  
  var mapOptions = {
    zoom: 12,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Hay un bache'
  });

  var marker = new google.maps.Marker({
      position: new google.maps.LatLng( 20.983339, -89.625507),
      map: map,
      title: 'Una rama en el bache',
    	icon: iconBase + '32_01.png'
  });

  var marker = new google.maps.Marker({
      position: new google.maps.LatLng( 20.953339, -89.621507),
      map: map,
      title: 'Hay un garo en la rama en el bache',
      icon: iconBase + '48_03.png'
  });
  
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    <div id="map-canvas"></div>