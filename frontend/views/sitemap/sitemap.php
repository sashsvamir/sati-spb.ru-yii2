<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
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
		<?php foreach ($model as $data) : ?>
			<li>
				<a href="<?= $data['url'] ?>" title="<?= Html::encode($data['meta_title']) ?>"><?= isset($data['sitemap_title']) ? $data['sitemap_title'] : $data['header'] ?></a>
			</li>
		<?php endforeach ?>
	</ul>


</div>
