<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */



// Seo headers
if ($model->seo) {
	$this->title = $model->seo->title;
	$this->registerMetaTag(['name' => 'description', 'content' => $model->seo->description]);
	$this->registerMetaTag(['name' => 'keywords', 'content' => $model->seo->keywords]);
}



// Create breadcrumbs
// если страница привзана к категории
if ($ancestors = $model->category) {
	// если у категории есть предки
	if($ancestors = $ancestors->ancestors()->findAll()){
		foreach ($ancestors as $ancestor) {
			// если к предку привязана страница, укажем ее в хлебн. крошках
			if($parent = $ancestor->item)
				$this->params['breadcrumbs'][$parent->category->title] = Url::to(['/catalog/' . $parent->link->link]);
		}
	}
}

// добавим в хлебн. крошки название текущей страницы
// $this->breadcrumbs[] = $model->img->menu_title;
$this->params['breadcrumbs'][] = $model->category ? $model->category->title : $model->header;
?>





<div class="item-background" id="item-<?= $model->id ?>"></div>

<div class="article">

	<h1>
		<?= $model->header ?>
		<? if ((Yii::$app->user->id === "admin")) : ?>
			<? // todo: fix link to admin ?>
			<?= ' ' . Html::a("Изменить", ['/admin/item/update/', 'id' => $model->id], [
				'class' => 'admin',
				'style' => 'font-size:.6rem;text-decoration:underline;',
				'title' => 'Редактировать запись',
			]) ?>
		<? endif ?>
	</h1>

	<? if ($model->lider) : ?>
		<h2><?= $model->lider ?></h2>
	<? endif ?>

	<?= $model->body ?>

</div>


<?
// todo: make widget
// $this->widget('application.extensions.ItemsInfo.ItemsInfo', [
// 	'infofile_id' => $model->info_id,
// ]);
?><!-- info files list -->

