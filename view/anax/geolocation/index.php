<?php

namespace Anax\View;

/**
* Style chooser.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?><h1>IP Geolocator</h1>

<p>Enter IP address to locate</p>
<form class="ipvalidator-form" method="POST" action="<?= url("geo") ?>">
    <input type="text" name="ip" value="<?= $ip ?>">
    <br>
    <div class="error"><?= $msg ?></div>
    <input type="submit" name="locateBtn" value="Locate">
</form>

<br><br><h1>IP Geolocator (REST API)</h1>

<p>This Geolocator uses a REST API with route <span class="code">json/geo</span> and returns a response in JSON format. </p>

<form class="ipvalidator-form" method="GET" action="<?= url("json/geo") ?>">
    <input type="text" name="ip" value="<?= $ipJson ?>">
    <br>
    <div class="error"><?= $msgJson ?></div>
    <input type="submit" name="locateBtn" value="Locate">
</form>

<br>

<p><a href="<?= url("json/geo?ip=91.189.94.40&locateBtn=Locate") ?>">Test www.ubuntu.com (91.189.94.40)</a></p>
<p><a href="<?= url("json/geo?ip=172.217.168&locateBtn=Locate") ?>">Test invalid IP address</a></p>
