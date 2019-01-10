<?php
namespace Anax\View;

/**
* Render user list.
*/

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

?>

<h1>User list</h1>

<?php if (!$items) : ?>
    <p>There are no users in the database.</p>
    <?php return; ?>
<?php endif; ?>

<table>
    <tr>
        <th>Id</th>
        <th>Acronym</th>
        <th>Name</th>
        <th>Email</th>
        <th>Created</th>
        <th>Posts</th>
        <th>Gravatar</th>
    </tr>
    <?php foreach ($items as $item) : ?>
        <tr style="border-top: 1px solid black">
            <td><?= $item->id ?></td>
            <td><a href="<?= url("user/view/$item->id") ?>"><?= $item->acronym ?></a></td>
            <td><?= $item->name ?></td>
            <td><?= $item->email ?></td>
            <td><?= $item->created ?></td>
            <td><?= $item->posts ?></td>
            <td><img src="<?= $item->gravatar ?>" alt="gravatar"></td>
        </tr>
    <?php endforeach; ?>
</table>
