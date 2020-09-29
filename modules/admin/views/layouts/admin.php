<?php


use app\assets\AdminAsset;

AdminAsset::register($this)
?>

<?php $this->beginPage() ?>
    <!doctype html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Page</title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <?= $this->render('/layouts/include/admin-header') ?>
   <div class="container">
       <?= $content ?>
   </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>