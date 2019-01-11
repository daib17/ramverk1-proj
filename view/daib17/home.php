<?php
namespace Anax\View;

/**
* Render home view.
*/

$session = $this->di->get("session");


?>

<h1>Welcome to All About MotoGP!</h1>

<p><b>All About MotoGP</b> is a friendly community site dedicated to the world of MotoGP and other motorbike racing competitions.</p>
<p>Our aim is provide a place with relaxed atmosphere where to share our passion for the sport.</p>
<p>You can begin by checking our latest posts!</p>

<div class="home-div">
    <div class="latest-questions">
        <table>
            <tr>
                <th>Lastest questions</th>
            </tr>
            <?php foreach ($questions as $q) :?>
                <tr>
                    <td><a href="<?= url("question/read/$q->id") ?>"><?= $q->title ?></a></td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$questions) :?>
                <tr><td>-</td></tr>
            <?php endif; ?>
        </table>
    </div>
    <div class="popular-tags">
        <table>
            <tr>
                <th>Popular tags</th>
            </tr>
            <?php foreach ($tags as $tag) :?>
                <tr>
                    <td><a href="<?= url("tag") ?>"><?= $tag->name ?></a></td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$tags) :?>
                <tr><td>-</td></tr>
            <?php endif; ?>
        </table>
    </div>
    <div class="active-users">
        <table>
            <tr>
                <th>Users</th>
                <th>Posts</th>
            </tr>
            <?php foreach ($users as $user) :?>
                <tr>
                    <td><a href="<?= url("user/view/$user->id") ?>"><?= $user->acronym ?></a></td>
                    <td><?= $user->posts ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$users) :?>
                <tr><td>-</td><td></td></tr>
            <?php endif; ?>
        </table>
    </div>
</div>
