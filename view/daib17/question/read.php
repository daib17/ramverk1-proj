<?php
namespace Anax\View;

/**
* Render question view.
*/

// Create urls for navigation
$urlBackToQuestions = url("question/");


?>

<h1><?= $question->title ?></h1>

<p><?= $user->acronym ?></p>
<p><img src="<?= $user->gravatar ?>" alt="gravatar"></p>
<p>Member since: <?= $user->created ?></p>

<p><?= $question->created ?></p>
<p><?= $question->body ?></p>

<!-- Comments to question -->
<h4>Comments to question</h4>
<?php foreach ($question->getComments() as $com) : ?>
    <?php $com->setDb($db) ?>
    <p><?= $com->body ?></p>
    <p><?= $com->getUser()->acronym ?></p>
    <p><?= $com->created ?></p>
<?php endforeach; ?>

<!-- Answers -->
<?php foreach ($question->getAnswers() as $answer) : ?>
    <?php $answer->setDb($db) ?>
    <h3>Answer</h3>
    <?php $ansUser = $answer->getUser() ?>
    <p><?= $ansUser->acronym ?></p>
    <p><?= $ansUser->gravatar ?></p>
    <p>Member since: <?= $ansUser->created ?></p>
    <p><?= $answer->created ?></p>
    <p><?= $answer->body ?></p>
    <!-- Comments to answer -->
    <h4>Comments to answer</h4>
    <?php foreach ($answer->getComments() as $com) : ?>
        <?php $com->setDb($db) ?>
        <p><?= $com->body ?></p>
        <p><?= $com->getUser()->acronym ?></p>
        <p><?= $com->created ?></p>
    <?php endforeach; ?>
<?php endforeach; ?>

<p>
    <a href="<?= $urlBackToQuestions ?>">Back to question list</a>
</p>
