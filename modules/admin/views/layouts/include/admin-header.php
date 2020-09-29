<?php

use yii\helpers\Url;

?>
<header class="header">
    <nav class="navbar navbar-light bg-light d-flex">
        <a class="navbar-brand" href="<?= Url::home() ?>">Главная</a>

        <ul class="navbar-nav ml-auto">


            <li class="nav-item">
                <a class="nav-link" href="<?= Url::to('/admin') ?>">Главная модерации</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= Url::to('/admin/manage') ?>">Управление пользователями</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= Url::to('/admin/chat') ?>">Управление чатом</a>
            </li>

            <?php if (!Yii::$app->user->isGuest) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to('/logout') ?>">Разлогиниться
                        (<?= Yii::$app->user->identity->username ?>)</a>
                </li>
            <?php endif ?>




        </ul>

    </nav>
</header>