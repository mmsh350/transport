 <?php 
      if(isset($_POST['track']))
      {
          $lat1 = $_POST['lat1'];
          $lon1 = $_POST['lon1'];
          $lat2 = $_POST['lat2'];
          $lon2 = $_POST['lon2'];
      }else{
           header('Location:http://localhost/transport/pro/admin.php?page=track');
      }
      
      ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapbox Distance Example</title>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.css' rel='stylesheet' />
    <style>
        body { margin: 0; padding: 0; }
        #map { position: absolute; top: 0; bottom: 0; width: 100%; }
        #info { position: absolute; top: 10px; left: 10px; background: white; padding: 10px; z-index: 1; }
    </style>
</head>
<body>
   
      <input  type="hidden" id="dlat1" value="<?php echo $lat1; ?>">
      <input  type="hidden" id="dlon1" value="<?php echo $lon1; ?>">
      <input  type="hidden" id="clat2" value="<?php echo $lat2; ?>">
      <input  type="hidden" id="clon2" value="<?php echo $lon2; ?>">

    <div id="info"></div>
    <div id="map"></div>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoibW1zaDM1MDAiLCJhIjoiY2x4OWg1Ym10MnN3NjJtc2QyODFwazliZSJ9.xeYCm80fZSDKv9ARg3ZHZg'; // Replace with your Mapbox access token
 
        const lat1 = parseFloat(document.getElementById('dlat1').value); // Latitude of the first location
        const lon1 = parseFloat(document.getElementById('dlon1').value); // Longitude of the first location
        const lat2 = parseFloat(document.getElementById('clat2').value); // Latitude of the second location
        const lon2 = parseFloat(document.getElementById('clon2').value); // Longitude of the second location
        
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [(lon1 + lon2) / 2, (lat1 + lat2) / 2],
            zoom: 3
        });

        const marker1 = new mapboxgl.Marker()
            .setLngLat([lon1, lat1])
            .addTo(map);

        const marker2 = new mapboxgl.Marker()
            .setLngLat([lon2, lat2])
            .addTo(map);

        // Fetch the distance from the server (you can implement this with a PHP endpoint)
        async function fetchDistance() {
            const response = await fetch(`get_distance.php?lat1=${lat1}&lon1=${lon1}&lat2=${lat2}&lon2=${lon2}`);
            const data = await response.json();
            return data.distance;
        }

        async function updateInfo() {
            const distance = await fetchDistance();
            document.getElementById('info').innerText = `Distance: ${distance.toFixed(2)} km`;
        }

        map.on('load', () => {
            map.addSource('route', {
                'type': 'geojson',
                'data': {
                    'type': 'Feature',
                    'properties': {},
                    'geometry': {
                        'type': 'LineString',
                        'coordinates': [
                            [lon1, lat1],
                            [lon2, lat2]
                        ]
                    }
                }
            });

             map.addLayer({
                'id': 'route',
                'type': 'line',
                'source': 'route',
                'layout': {
                    'line-join': 'round',
                    'line-cap': 'round'
                },
                'paint': {
                    'line-color': '#0000FF', // Blue color
                    'line-width': 4,
                    'line-dasharray': [2, 2] // Dotted line
                }
            });

            updateInfo();
        });
    </script>
</body>
</html>
