<?php
namespace Anax\View;

/**
* Style chooser.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<h1>Weather Forecast - This week</h1>

<div class="forecast-now">
    <p><b>Right now</b></p>
    <p><?= $res["currently"]["summary"] ?></p>
    <p><?= $res["currently"]["temperature"] ?> °C</p>
    <p>Wind: <?= $res["currently"]["windSpeed"] ?> m/s</p>
    <p>Humidity: <?= $res["currently"]["humidity"] * 100 ?>%</p>
</div>

<?php foreach ($res["daily"]["data"] as $day) : ?>
    <div class="forecast-day">
        <p><b><?= date("l M d", $day["time"]); ?></b></p>
        <p><?= $day["summary"] ?></p>
        <p>Min: <?= $day["temperatureLow"] ?> °C / Max: <?= $day["temperatureHigh"] ?> °C</p>
        <p>Wind: <?= $day["windSpeed"] ?> m/s</p>
        <p>Humidity: <?= $day["humidity"] * 100 ?>%</p>
    </div>
<?php endforeach; ?>

<br>
Lat: <?= $res["latitude"] ?> /
Lon: <?= $res["longitude"] ?> /
Timezone: <?= $res["timezone"] ?><br>
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
        center: ol.proj.fromLonLat([<?= $res["longitude"] ?>, <?= $res["latitude"] ?>]),
        zoom: 6
    })
});
</script>
