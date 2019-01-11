<?php
namespace Anax\View;

/**
* Render tag view.
*/

?>

<h1>Tag list</h1>


<?php if (!$items) : ?>
    <p>There are no tags in the database.</p>
    <?php return; ?>
<?php endif; ?>

<?php foreach ($items as $key => $value) : ?>
    <div class="tag solid">
        <?= $key ?> (<?= count($items[$key]) ?>)
    </div>
    <?php foreach ($items[$key] as $tag) : ?>
        <?php $path = $tag['questionid'] ?>
        <p><a href='<?= url("question/read/$path") ?>'><?= $tag["title"] ?></a></p>
    <?php endforeach; ?>
<?php endforeach; ?>
