<?php
header('Content-Type: application/json');

function getDistanceFromMapbox($lat1, $lon1, $lat2, $lon2, $accessToken) {
    $url = "https://api.mapbox.com/directions/v5/mapbox/driving/{$lon1},{$lat1};{$lon2},{$lat2}?access_token={$accessToken}&geometries=geojson";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo json_encode(['error' => curl_error($ch)]);
        curl_close($ch);
        exit;
    }

    curl_close($ch);
    $data = json_decode($response, true);

    if (isset($data['routes'][0]['distance'])) {
        $distanceMeters = $data['routes'][0]['distance'];
        $distanceKm = $distanceMeters / 1000;
        return $distanceKm;
    } else {
        return null;
    }
}

$lat1 = isset($_GET['lat1']) ? (float)$_GET['lat1'] : null;
$lon1 = isset($_GET['lon1']) ? (float)$_GET['lon1'] : null;
$lat2 = isset($_GET['lat2']) ? (float)$_GET['lat2'] : null;
$lon2 = isset($_GET['lon2']) ? (float)$_GET['lon2'] : null;
$accessToken = 'pk.eyJ1IjoibW1zaDM1MDAiLCJhIjoiY2x4OWg1Ym10MnN3NjJtc2QyODFwazliZSJ9.xeYCm80fZSDKv9ARg3ZHZg'; // Replace with your Mapbox access token

if ($lat1 !== null && $lon1 !== null && $lat2 !== null && $lon2 !== null) {
    $distance = getDistanceFromMapbox($lat1, $lon1, $lat2, $lon2, $accessToken);
    if ($distance !== null) {
        echo json_encode(['distance' => $distance]);
    } else {
        echo json_encode(['error' => 'Unable to calculate distance']);
    }
} else {
    echo json_encode(['error' => 'Invalid parameters']);
}
?>
