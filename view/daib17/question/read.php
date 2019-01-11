<?php
namespace Anax\View;

use Anax\TextFilter\TextFilter;

/**
* Render question view.
*/

$session = $this->di->get("session");

// Create urls for navigation
// $urlBackToQuestions = url("question/");

// Markdown filter
$filter = new TextFilter();

// Get tags as array of strings
$tagArr = $question->getTags();

?>

<h1><?= $question->title ?></h1>

<!-- Tags -->
<?php if ($tagArr != null) : ?>
    <?php foreach ($tagArr as $tag) : ?>
        <div class="tag">
            <a href="<?= url("tag") ?>"><?= $tag ?></a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Post answer button -->
<?php if ($session->get("userid")) : ?>
    <div class="button-div">
        <a class="green-button right" href="<?= url("answer/add/$question->id") ?>">Post answer</a>
    </div>
<?php endif; ?>

<!-- Question -->
<div class="card-question">
    <div class="card-user">
        <p><?= $user->acronym ?></p>
        <p><img src="<?= $user->gravatar ?>" alt="gravatar"></p>
        <p>Member:</p>
        <p><?= date("d-m-Y", strtotime($user->created)) ?></p>
    </div>
    <div class="card-message">
        <p class="card-message-date"><?= date("d-m-Y H:m:s", strtotime($question->created)) ?></p>
        <div class="card-message-body">
            <?= $filter->parse($question->body, ["markdown"])->text ?>
        </div>
    </div>
</div>

<div class="card-comment">
    <table>
        <?php foreach ($question->getComments() as $com) : ?>
            <?php $com->setDb($db) ?>
            <tr>
                <td class="comment-col-1">
                    <?= $filter->parse($com->body, ["markdown"])->text ?>
                </td>
                <td class="comment-col-2">
                    <p><?= $com->getUser()->acronym ?></p>
                </td>
                <td class="comment-col-3">
                    <p><?= date("d-m-Y H:m:s", strtotime($com->created)) ?></p>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php if ($session->get("userid")) : ?>
        <a href="<?= url("comment/addtoquestion/$question->id") ?>"><p class="card-comment-add">Add comment</p></a>
    <?php endif; ?>
</div>

<!-- Answers -->
<?php foreach ($question->getAnswers() as $answer) : ?>
    <?php $answer->setDb($db) ?>
    <div class="card-answer">
        <div class="card-user">
            <?php $ansUser = $answer->getUser() ?>
            <p><?= $ansUser->acronym ?></p>
            <p><img src="<?= $ansUser->gravatar ?>" alt="gravatar"></p>
            <p>Member:</p>
            <p><?= date("d-m-Y", strtotime($ansUser->created)) ?></p>
        </div>
        <div class="card-message">
            <p class="card-message-date"><?= date("d-m-Y H:m:s", strtotime($answer->created)) ?></p>
            <div class="card-message-body">
                <?= $filter->parse($answer->body, ["markdown"])->text ?>
            </div>
        </div>
    </div>

    <div class="card-comment">
        <table>
            <?php foreach ($answer->getComments() as $com) : ?>
                <?php $com->setDb($db) ?>
                <tr>
                    <td class="comment-col-1">
                        <?= $filter->parse($com->body, ["markdown"])->text ?>
                    </td>
                    <td class="comment-col-2">
                        <p><?= $com->getUser()->acronym ?></p>
                    </td>
                    <td class="comment-col-3">
                        <p><?= date("d-m-Y H:m:s", strtotime($com->created)) ?></p>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php if ($session->get("userid")) : ?>
            <a href="<?= url("comment/addtoanswer/$question->id/$answer->id") ?>"><p class="card-comment-add">Add comment</p></a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<!-- <p class="clearfix">
    <a href="<?= $urlBackToQuestions ?>">Back to question list</a>
</p> -->
