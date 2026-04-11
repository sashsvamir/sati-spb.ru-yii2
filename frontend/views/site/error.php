<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        Сожалеем, но произошла ошибка: <b><?= nl2br(Html::encode($message)) ?></b>
    </div>

	<br>

	<p>Если не удается найти необходимый материал, попробуйте связаться с нами по любому из доступных каналов связи, мы постараемся вам помочь:</p>
	<ul>
		<li><a href="<?= Yii::$app->params['feedback'] ?>">Фома для связи</a></li>
		<li class="phones"><span class="phone"><?= implode('</span><br /><span class="phone">', Yii::$app->params['phones']) ?></span></li>
		<li>E-mail: <a href="mailto:info@intermehanika-ltd.ru">info@intermehanika-ltd.ru</a></li>
	</ul>

</div>
