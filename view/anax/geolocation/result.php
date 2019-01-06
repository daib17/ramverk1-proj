<?php

namespace Anax\View;

/**
* Style chooser.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?><h1>IP Geolocation</h1>
<p>IP: <?= $ip ?></p>
<p>IP Type: <?= $res["type"] ?></p>
<p>City: <?= $res["city"] ? $res["city"] : "n/a" ?></p>
<p>Country: <?= $res["country_name"] ? $res["country_name"] : "n/a" ?></p>
<p>Latitude: <?= $res["latitude"] ?> | Longitude: <?= $res["longitude"]?></p>
<form class="ipvalidator-form" method="POST" action="<?= url("geo") ?>">
    <input type="submit" name="back" value="Back">
</form>
