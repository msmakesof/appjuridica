<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Geolocalización de IP">
    <title>Geolocalización de IP en Google Maps</title>
<style type="text/css">
html,body{margin:0;padding:0;width:100%;height:100%;font-family:Trebuchet MS,verdana,arial}
#texto{text-align:center;padding:8%}
</style>
<?php
$IP = '';
  if (getenv('HTTP_CLIENT_IP')) {
    $IP =getenv('HTTP_CLIENT_IP');
  } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
    $IP =getenv('HTTP_X_FORWARDED_FOR');
  } elseif (getenv('HTTP_X_FORWARDED')) {
    $IP =getenv('HTTP_X_FORWARDED');
  } elseif (getenv('HTTP_X_CLUSTER_CLIENT_IP')) {
    $IP =getenv('HTTP_X_CLUSTER_CLIENT_IP');
  } elseif (getenv('HTTP_FORWARDED_FOR')) {
    $IP =getenv('HTTP_FORWARDED_FOR');
  } elseif (getenv('HTTP_FORWARDED')) {
    $IP = getenv('HTTP_FORWARDED');
  } else {
    $IP = $_SERVER['REMOTE_ADDR'];
  }
$meta = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$IP));
?>
<script>
var map, geocoder;
function inicio() {
  var lat = document.getElementById('lat').value;
  var lng = document.getElementById('lng').value;
  var latlng = new google.maps.LatLng(lat, lng);
  var mapOptions = {
    zoom: 16,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('mapa'), mapOptions);
  geocoder = new google.maps.Geocoder();
  // Función completa de Geocoding
  geocoder.geocode({
    'latLng': latlng
  }, function (results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      document.getElementById('lat').innerHTML = results[0].geometry.location.lat().toFixed(6);
      document.getElementById('lng').innerHTML = results[0].geometry.location.lng().toFixed(6);
      map.setCenter(results[0].geometry.location);
      document.getElementById('direccion').innerHTML = results[0].formatted_address;
      var marker = new google.maps.Marker({
        map: map,
        position: results[0].geometry.location
      });
      infowindow = new google.maps.InfoWindow({
        content: results[0].formatted_address + '<br> Latitud: ' + results[0].geometry.location.lat().toFixed(6) + '<br> Longitud: ' + results[0].geometry.location.lng().toFixed(6)
      });
      infowindow.open(map, marker)
    }
	// Se detallan los diferentes tipos de error
	else {
      alert('Geocode no tuvo éxito por la siguiente razón: ' + status)
    }
  })
};
google.maps.event.addDomListener(window, 'load', inicio);
</script>
  </head>
  <body>
	<section id="texto">
	  <h3>Geolocalización de IP en Google Maps</h3>
	  <h3><a href="http://www.geoplugin.com/geolocation/" target="_new">IP Geolocation</a> por <a href="http://www.geoplugin.com/" target="_new">geoPlugin</a></h3>
	  geoPlugin utiliza la base de datos GeoLite de MaxMind disponible en <a href="http://www.maxmind.com" target="_blank">http://www.maxmind.com</a>.
	  <br>
	  El uso de los servicios geoPlugin haciendo uso de los datos de geolocalización está bajo condición de aceptación de la licencia <a rel="nofollow" title="http://creativecommons.org/licenses/by-sa/3.0/" target="_new" href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Reconocimiento-Compartir bajo la misma licencia 3.0 Unported</a>.
	  <br>
      <br>
      IP: <span style="color:#FF00AA;"><?php echo $IP; ?></span>
      <br>
      Latitud: <span style="color:#FF00AA;"><?php echo $meta['geoplugin_latitude']; ?></span>
	  <input id="lat" type="hidden" value="<?php echo $meta['geoplugin_latitude']; ?>">
      <br>
      Longitud: <span style="color:#FF00AA;"><?php echo $meta['geoplugin_longitude']; ?></span>
	  <input id="lng" type="hidden" value="<?php echo $meta['geoplugin_longitude']; ?>">
      <br>
      Ciudad: <span style="color:#FF00AA;"><?php echo $meta['geoplugin_city']; ?></span>
      <br>
      Región: <span style="color:#FF00AA;"><?php echo $meta['geoplugin_region']; ?></span>
      <br>
      País: <span style="color:#FF00AA;"><?php echo $meta['geoplugin_countryName']; ?></span>
      <br>
      Código País: <span style="color:#FF00AA;"><?php echo $meta['geoplugin_countryCode']; ?></span>
      <br>
      Código Continente: <span style="color:#FF00AA;"><?php echo $meta['geoplugin_continentCode']; ?></span>
    </section>
    <div id="mapa"></div>
  </body>
</html>