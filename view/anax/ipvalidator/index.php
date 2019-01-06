<?php

namespace Anax\View;

/**
* Style chooser.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><h1>IP validator</h1>

<p>Enter IP address to validate</p>

<form class="ipvalidator-form" method="POST" action="<?= url("ip") ?>">
    <input type="text" name="ip" value="">
    <input type="submit" name="validate" value="Validate">
</form>

<br><br><h1>IP validator (REST API)</h1>

<p>This IP validator uses a REST API with route <span class="code">api/json</span> and returns a response in JSON format. </p>

<form class="ipvalidator-form" method="GET" action="<?= url("api/json") ?>">
    <input type="text" name="ip" value="">
    <input type="submit" value="Validate">
</form>

<br>
<p><a href="<?= url("api/json?ip=172.217.168.174") ?>">Test IPv4</a></p>
<p><a href="<?= url("api/json?ip=3ffe:1900:4545:3:200:f8ff:fe21:67cf") ?>">Test IPv6</a></p>
<p><a href="<?= url("api/json?ip=172.217.168") ?>">Test invalid IP address</a></p>
