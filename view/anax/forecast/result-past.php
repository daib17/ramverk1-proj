<?php
namespace Anax\View;

/**
* Style chooser.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<h1>Weather Forecast - Past 30 days</h1>

<?php foreach ($res as $day) : ?>
    <div class="forecast-day">
        <p><b><?= date("l M d", $day["daily"]["data"][0]["time"]); ?></b></p>
        <p><?= $day["daily"]["data"][0]["summary"] ?></p>
        <p>Min: <?= $day["daily"]["data"][0]["temperatureLow"] ?> °C /
            Max: <?= $day["daily"]["data"][0]["temperatureHigh"] ?> °C</p>
        <p>Wind: <?= $day["daily"]["data"][0]["windSpeed"] ?> m/s</p>
        <p>Humidity: <?= $day["daily"]["data"][0]["humidity"] * 100 ?>%</p>
    </div>
<?php endforeach; ?>

<br>
Lat: <?= $res[0]["latitude"] ?> /
Lon: <?= $res[0]["longitude"] ?> /
Timezone: <?= $res[0]["timezone"] ?><br>
<div id="map" style="height:300px"></div>

<form class="forecast-form" method="POST" action="<?= url("forecast") ?>">
    <input type="submit" name="back" value="Back">
</form>

<script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
<script type="text/javascript">
var map = new ol.Map({
    target: 'map',
    layers: [
        new ol.layer.Tile({
            source: new ol.source.OSM()
        })
    ],
    view: new ol.View({
        center: ol.proj.fromLonLat([<?= $res[0]["longitude"] ?>, <?= $res[0]["latitude"] ?>]),
        zoom: 6
    })
});
</script>
