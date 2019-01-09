<?php
namespace Anax\View;

/**
* Render question list view.
*/

$session = $this->di->get("session");

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

?>

<h1>Question list</h1>

<?php if ($session->get("userId")) : ?>
    <p><a href="#">Add Question</a></p>
<?php endif; ?>

<?php if (!$items) : ?>
    <p>There are no questions in the database.</p>
    <?php return; ?>
<?php endif; ?>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Body</th>
        <th>Tags</th>
        <th>Userid</th>
        <th>Created</th>
    </tr>
    <?php foreach ($items as $item) : ?>
        <tr>
            <td><?= $item->id ?></td>
            <td><a href=<?= url("question/read/$item->id") ?>><?= $item->title ?></a></td>
            <td><?= $item->body ?></td>
            <td><?= $item->tags ?></td>
            <td><?= $item->userid ?></td>
            <td><?= $item->created ?></td>
        </tr>
    <?php endforeach; ?>
</table>
