<?php

namespace Anax\View;

/**
 * View to register a user.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Create urls for navigation
$urlBackToLogin = url("user/login");

?><h1>Registration successful</h1>

<p>User <b><?= $acronym ?></b> has been created.</p>

<p>
    <a href="<?= $urlBackToLogin ?>">Go to login</a>
</p>
