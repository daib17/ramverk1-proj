<?php

namespace Anax\View;

/**
* Render view user.
*/
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Get questions, answers and comments for userid
$questionArr = $question->findAllWhere("userid = ?", $user->id);
$answerArr = $answer->findAllWhere("userid = ?", $user->id);
$commentArr = $comment->findAllWhere("userid = ?", $user->id);

?>

<h1><?= $user->acronym ?></h1>

<!-- Profile -->
<div class="card-user-profile">
    <div class="part-1">
        <p><img src="<?= $user->gravatar ?>" alt="gravatar"></p>

    </div>
    <div class="part-2">
        <p><?= $user->name ?></p>
        <p><?= $user->email ?></p>
    </div>
    <div class="part-3">
        <p>Member since: <?= date("d-m-Y", strtotime($user->created)) ?></p>
        <p>Posts: <?= $user->posts ?></p>
    </div>
</div>


<div class="user-tables">
    <!-- Questions -->
    <table class="user-questions">
        <tr>
            <th>Posted questions</th>
            <th>Date</th>
        </tr>
        <?php if (count($questionArr) > 0) : ?>
            <?php foreach ($questionArr as $q) :?>
                <tr>
                    <td><a href="<?= url("question/read/$q->id") ?>"><?= $q->title ?></a></td>
                    <td class="table-date"><?= date("d-m-Y H:m:s", strtotime($q->created)) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else :?>
            <tr><td>-</td><td class="table-date">-</td></tr>
        <?php endif; ?>
    </table>
    <!-- Answers -->
    <table class="user-answers">
        <tr>
            <th>Answered to</th>
            <th>Date</th>
        </tr>
        <?php if (count($answerArr) > 0) : ?>
            <?php foreach ($answerArr as $ans) :?>
                <tr>
                    <td><a href="<?= url("question/read/$ans->questionid") ?>"><?= $question->getQuestionById($ans->questionid)->title ?></a></td>
                    <td class="table-date"><?= date("d-m-Y H:m:s", strtotime($ans->created)) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else :?>
            <tr><td>-</td><td class="table-date">-</td></tr>
        <?php endif; ?>
    </table>
    <!-- Comments -->
    <table class="user-comments">
        <tr>
            <th>Commented in</th>
            <th>Date</th>
        </tr>
        <?php if (count($commentArr) > 0) : ?>
            <?php foreach ($commentArr as $com) :?>
                <?php
                    $questionid = ($com->questionid) ?
                        $com->questionid :
                        $answer->getQuestionId($com->answerid);
                    $title = $question->getQuestionById($questionid)->title;
                ?>
                <tr>
                    <td><a href="<?= url("question/read/$questionid") ?>"><?= $title ?></a></td>
                    <td class="table-date"><?= date("d-m-Y H:m:s", strtotime($com->created)) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else :?>
            <tr><td>-</td><td class="table-date">-</td></tr>
        <?php endif; ?>
    </table>
</div>
