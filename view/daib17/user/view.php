<?php

namespace Anax\View;

/**
* Render view user.
*/
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Get questions for userid
$questionArr = $question->findAllWhere("userid = ?", $user->id);

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
            <th>Questions posted</th>
            <th>Date</th>
        </tr>
        <?php if (count($questionArr) > 0) : ?>
            <?php foreach ($questionArr as $q) :?>
                <tr>
                    <td><a href="<?= url("question/read/$q->id") ?>"><?= $q->title ?></a></td>
                    <td class="table-date"><?= $q->created ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else :?>
            <tr><td>-</td><td class="table-date">-</td></tr>
        <?php endif; ?>
    </table>
    <!-- Answers -->
    <table class="user-answers">
        <tr>
            <th>Replies to</th>
            <th>Date</th>
        </tr>
        <?php if (count($answers) > 0) : ?>
            <?php foreach ($answers as $ans) :?>
                <tr>
                    <td><a href="<?= url("question/read/$ans->questionid") ?>"><?= $question->getQuestionById($ans->questionid)->title ?></a></td>
                    <td class="table-date"><?= $ans->created ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else :?>
            <tr><td>-</td><td class="table-date">-</td></tr>
        <?php endif; ?>
    </table>
</div>
