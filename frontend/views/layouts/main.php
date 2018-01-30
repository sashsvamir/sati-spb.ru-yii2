<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

?>

<? $this->beginContent(Yii::$app->getLayoutPath() . '/index.php'); ?>

<div class="wrap">
    <?
	    NavBar::begin([
	        'brandLabel' => Yii::$app->name,
	        'brandUrl' => Yii::$app->homeUrl,
	        'options' => [
	            'class' => 'navbar-inverse navbar-fixed-top',
	        ],
	    ]);
	    $menuItems = [
	        ['label' => 'Home', 'url' => ['/site/index']],
	        ['label' => 'About', 'url' => ['/site/about']],
	        ['label' => 'Contact', 'url' => ['/site/contact']],
	    ];
	    if (Yii::$app->user->isGuest) {
	        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
	        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
	    } else {
	        $menuItems[] = '<li>'
	            . Html::beginForm(['/site/logout'], 'post')
	            . Html::submitButton(
	                'Logout (' . Yii::$app->user->identity->username . ')',
	                ['class' => 'btn btn-link logout']
	            )
	            . Html::endForm()
	            . '</li>';
	    }
	    echo Nav::widget([
	        'options' => ['class' => 'navbar-nav navbar-right'],
	        'items' => $menuItems,
	    ]);
	    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>

        <?= $content ?>

    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>


<? $this->endContent(); ?>
