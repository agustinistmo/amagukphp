   <style>
       #map-canvas {
        height: 450px;        
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
function initialize() {
  var myLatlng = new google.maps.LatLng( <?php print $this->usuario->getLatitud();?>,<?php print $this->usuario->getLongitud();?>);
  var iconBase= '<?php print MGK_HOME;?>/public/images/marker/';
  
  var mapOptions = {
    zoom: 12,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Atencion'
  });

<?php foreach ($this->items as $item ):?>  

  var marker = new google.maps.Marker({
      position: new google.maps.LatLng( <?php print $item->getLatitud() ?>,<?php print $item->getLongitud() ?>),
      map: map,
      title: 'aqui',
    	icon: iconBase + '48_02.png'
  });
<?php endforeach;?>
}

google.maps.event.addDomListener(window, 'load', initialize);
    </script>


		
<div class="row">

	<div id="map-canvas" class="col-xs-12"></div>

</div>
	