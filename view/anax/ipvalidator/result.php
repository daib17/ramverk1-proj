<?php

namespace Anax\View;

/**
* Style chooser.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?><h1>IP validator</h1>
<p><span class="bold"><?= $ip ?></span><?= $msg ?></p>
<p>Domain: <?= $host ? $host : "-" ?></p>
<form class="ipvalidator-form" method="POST" action="<?= url("ip") ?>">
    <input type="submit" name="back" value="Back">
</form>
