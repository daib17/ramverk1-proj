<?php
namespace Anax\View;

/**
* Render navbar view.
*/

$session = $this->di->get("session");

$acronym = $session->get("acronym");
$userId = $session->get("userId");


?>

<div class="rm-navbar ">
    <ul class="my-navbar rm-default rm-desktop">
        <li><a href="<?= url("") ?>" title="Home">Home</a></li>
        <li><a href="<?= url("questions") ?>" title="Questions">Questions</a></li>
        <li><a href="<?= url("tags") ?>" title="Tags">Tags</a></li>
        <li><a href="<?= url("about") ?>" title="About">About</a></li>

        <?php if ($session->has("acronym")) : ?>
            <li><a class="rm-submenu-button" href=""></a><a href=""><i class="fa fa-user-circle"></i><?= $acronym ?></a>
                <ul>
                    <li><a href="<?= url("user/list") ?>" title="All users">All users</a></li>

                    <li><a href="<?= url("user/update/$userId") ?>" title="Update">Update account</a></li>

                    <li><a href="<?= url("user/logout") ?>" title="Log out">Log out</a></li>
                </ul>
            </li>
        <?php else : ?>
            <li><a class="rm-submenu-button" href=""></a><a href=""><i class="fa fa-user-circle"></i></a>
                <ul>
                    <li><a href="<?= url("user/list") ?>" title="All users">All users</a></li>

                    <li><a href="<?= url("user/register") ?>" title="Register">Register</a></li>

                    <li><a href="<?= url("user/login") ?>" title="Log in">Log in</a></li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</div>
