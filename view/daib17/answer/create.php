<?php
namespace Anax\View;

/**
* Render answer form view.
*/

$session = $this->di->get("session");

// Create urls for navigation
$urlBackToQuestion = url("question/read/$questionid");

?>

<h1>Post answer</h1>

<?= $form ?>

<p>
    <a href="<?= $urlBackToQuestion ?>">Back to question</a>
</p>
