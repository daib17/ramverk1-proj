<?php

namespace Anax\View;

/**
* Style chooser.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<h1>Weather Forecast (JSON)</h1>
<form class="forecast-form" method="POST" action="<?= url("json/forecast") ?>">
    <h3>Enter Latitude/Longitud OR IP address</h3>
    <label>Latitude</label><br>
    <input type="text" name="lat" value="<?= $lat ?>"><br><br>
    <label>Longitude</label><br>
    <input type="text" name="lon" value="<?= $lon ?>"><br><br>
    <label>IP address</label><br>
    <input type="text" name="ip" value="<?= $ip ?>"><br><br>
    <input type="radio" name="period" value="0" checked> This week
    <input type="radio" name="period" value="1"> Past 30 days
    <br><br>
    <div class="error"><?= $msg ?></div>
    <input type="submit" name="submitBtn" value="Submit">
</form>
