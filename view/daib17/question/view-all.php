<?php
namespace Anax\View;

/**
* Render question list view.
*/

$session = $this->di->get("session");
$userid = $session->get("userid");

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

?>

<h1>Question list</h1>

<?php if ($userid) : ?>
    <div class="button-div">
        <a class="green-button left" href="<?= url("question/add/$userid") ?>">Add question</a>
    </div>
<?php endif; ?>

<?php if (!$items) : ?>
    <p>There are no questions in the database.</p>
    <?php return; ?>
<?php endif; ?>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>User</th>
        <th>Created</th>
    </tr>
    <?php foreach ($items as $item) : ?>
        <tr>
            <td><?= $item->id ?></td>
            <td><a href=<?= url("question/read/$item->id") ?>><?= $item->title ?></a></td>
            <td><?= $user->getAcronymById($item->userid) ?></td>
            <td><?= $item->created ?></td>
        </tr>
    <?php endforeach; ?>
</table>
