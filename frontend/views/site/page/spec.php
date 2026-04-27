<?php
	/* @var $this \yii\web\View */

	// Seo headers
	$this->title = 'Специальное предложение';
	$this->registerMetaTag(['name' => 'keywords', 'content' => 'специальное предложение приводная техника']);

	// Create breadcrumbs
	$this->params['breadcrumbs'][] = 'Специальное предложение';
?>

<h1>Специальное предложение</h1>
<h2><strong>Специальное предложение</strong>&nbsp;— в продаже со склада на выгодных условиях</h2>


<p>Предлагаем вашему вниманию <a href="https://danfoss-vickers.ru/stock">наш склад</a> различной продукции (тапербуши (втулки), цепи, замки Sati и т.д.), которая имеется в наличии.</p>

<p class="indent-no space-top">
	Что бы заказать продукцию, обращайтесь к нашим специалистам по телефону:
	<!--<br /><b>+7(812)702-70-91,
	<br />+7(812)702-70-92.</b>-->
    <br /><b>+7 (812) 468-85-82</b>
</p>

<p class="indent-no space-top">Также заказать оформить можно оставив свои координаты в <a href="<?= Yii::$app->params['feedback'] ?>">форме запросов</a> на <a href="https://intermehanika-ltd.ru">сайте</a> компании.</p>
