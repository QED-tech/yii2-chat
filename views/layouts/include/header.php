<?php

use yii\helpers\Url;

?>
<header class="header">
    <nav class="navbar navbar-light bg-light d-flex">
        <a class="navbar-brand" href="<?= Url::home() ?>">Главная</a>

        <ul class="navbar-nav ml-auto">

            <?php if (Yii::$app->user->isGuest) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to('signup') ?>">Регистрация</a>
                </li>
            <?php endif ?>


            <?php if (!Yii::$app->user->isGuest) : ?>

                <li class="nav-item">
                    <a class="nav-link" id="username" data-username="<?= Yii::$app->user->identity->username ?>" href="<?= Url::to('user/logout') ?>">
                        Разлогиниться (<?= Yii::$app->user->identity->username ?>)
                    </a>
                </li>
            <?php endif ?>

        </ul>

    </nav>
</header>