<?php
namespace Anax\View;

/**
* Render tag view.
*/

?>

<h1>Tags</h1>

<?php foreach($items as $key => $value) : ?>
    <p><b><?= $key ?> x <?= count($items[$key]) ?></b></p>
    <?php foreach($items[$key] as $tag) : ?>
        <?php $path = $tag["questionid"] ?>
        <p><a href="<?= url('question/read/$path') ?>"><?= $tag["title"] ?></a></p>
    <?php endforeach; ?>
<?php endforeach; ?>
