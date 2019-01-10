<?php
namespace Anax\View;

/**
* Render question form view.
*/

$session = $this->di->get("session");

// Create urls for navigation
$urlGotoQuestions = url("question");

?>

<h1>Add question</h1>

<?= $form ?>

<p>
    <a href="<?= $urlGotoQuestions ?>">Back to question list</a>
</p>
