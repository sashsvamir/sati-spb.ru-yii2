<?php

/* @var $this yii\web\View */

$this->registerAssetBundle(\frontend\assets\IntroAsset::className());


$this->title = 'Sati – Приводная техника';
$this->registerMetaTag(['name' => 'description', 'content' => 'Комплексная поставка импортных оригинальных комплектующих к промышленному оборудованию от ведущих мировых производителей на многочисленные предприятия по всей России как в сфере деревообработки, машиностроения, металлургии, нефтехимии, так и пищевой промышленности и других отраслей.']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'Sati, приводная техника']);
?>

<!-- Logo -->
<h1 title="Sati — основан в 1974г." class="logo-sati">
	<a class="logo" href="/catalog">Sati</a>
</h1>




<!-- Slider -->
<div id="slider">
	<div class="container">
		<?
			// $this->widget('application.extensions.ItemsMenu.ItemsMenu', [
			// 	'htmlOptions' => [
			// 		'class' => 'items',
			// 	],
			// ]);
		?>
	</div>
	<div class="shadow-left"></div>
	<div class="shadow-right"></div>
</div>
<div class="shadow"></div>




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
