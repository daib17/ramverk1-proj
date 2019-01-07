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
        <th>Gravatar</th>
        <th>Created</th>
    </tr>
    <?php foreach ($items as $item) : ?>
        <tr>
            <td><?= $item->id ?></td>
            <td><?= $item->acronym ?></td>
            <td><?= $item->name ?></td>
            <td><?= $item->email ?></td>
            <td><?= $item->created ?></td>
            <td><img src="<?= $item->gravatar ?>" alt="gravatar"></td>
        </tr>
    <?php endforeach; ?>
</table>
