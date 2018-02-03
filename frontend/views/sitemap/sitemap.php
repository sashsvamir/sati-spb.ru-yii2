<?php

/* @var $this \yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $model array */


$this->title = 'Карта сайта';
$this->registerMetaTag(['name' => 'description', 'content' => 'Быстрая навигация по сайту']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'sati, sitemap']);


$this->params['breadcrumbs'][] = 'Карта сайта';
?>



<div class="sitemap-index">

	<h1>Карта сайта</h1>
	<h2>Быстрая навигация по сайту</h2>


	<ul>
		<? foreach ($model as $data) : ?>
			<li>
				<a href="<?= Url::to(['catalog/view', 'url' => $data['url']]) ?>" title="<?= Html::encode($data['meta_title']) ?>"><?= isset($data['menu_title']) ? Html::encode($data['menu_title']) : $data['header'] ?></a>
			</li>
		<? endforeach ?>
	</ul>


</div>
