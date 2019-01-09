<?php
namespace Anax\View;

/**
* Render navbar view.
*/

$session = $this->di->get("session");

// Create urls for navigation
$urlGotoRegistration = url("user/register");

?>

<h1>Log in</h1>

<?= $form ?>

<p>
    <a href="<?= $urlGotoRegistration ?>">Register a new user account</a>
</p>
