<?php

namespace Anax\View;

/**
* Style chooser.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?><h1>IP validator (REST API)</h1>

<div><?= json_encode($json) ?></div>

<form class="ipvalidator-form" method="POST" action="<?= url("ip") ?>">
    <input type="submit" name="back" value="Back">
</form>
