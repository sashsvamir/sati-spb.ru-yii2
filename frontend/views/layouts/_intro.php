<?php

/* @var $this \yii\web\View */
/* @var $content string */

$this->registerAssetBundle(\frontend\assets\IntroAsset::className());
?>


<? $this->beginContent(Yii::$app->getLayoutPath() . '/main.php'); ?>


    <!-- Logo -->
    <h1 title="Sati — основан в 1974г." class="logo-sati">
        <a class="logo" href="/catalog">Sati</a>
    </h1>




    <?= $content ?>




    <!-- Footer -->
    <div class="footer">

        <h2>Приводная техника Sati</h2>
        <p class="phones">
            <span class="phone">
                <?= implode('</span><br /><span class="phone">', Yii::$app->params['phones']) ?>
            </span>
        </p>
        <p class="feedback">
            &rArr; <a href="<?= Yii::$app->params['feedback'] ?>">заказ on-line</a>
        </p>

    </div>




    <!-- Logo -->
    <div class="intermehanika-logo"></div>




<? $this->endContent(); ?>
