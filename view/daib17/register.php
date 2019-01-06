<?php

namespace Anax\View;

/**
 * View to register a user.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlGoToLogin = url("user/login");



?><h1>User registration</h1>

<?= $form ?>

<p>
    <a href="<?= $urlGoToLogin ?>">Go to login</a>
</p>
