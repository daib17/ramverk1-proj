<?php

namespace Anax\View;

/**
* Style chooser.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?><h1>Weather Forecast (JSON format)</h1>

<div><?= json_encode($res) ?></div>

<form class="forecast-form" method="POST" action="<?= url("json/forecast") ?>">
    <input type="submit" name="back" value="Back">
</form>
