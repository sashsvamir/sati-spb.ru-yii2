<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\Category */

$this->title = 'Приводная техника';


// Seo headers
if ($model->seo){
	$this->title = $model->seo->title;
	$this->registerMetaTag(['name' => 'description', 'content' => $model->seo->description]);
	$this->registerMetaTag(['name' => 'keywords', 'content' => $model->seo->keywords]);
}

?>


catalog/index


<h1 align="center" style="margin: 1rem auto 4rem;">
	<? // todo: fix link to admin ?>
	<?= $model->header ?>
	<? if (Yii::$app->user->id === "admin") : ?>
		<?= Html::a("Изменить", ['/admin/item/update/', 'id' => $model->id], [
			'class' => 'admin',
			'style' => 'font-size:.6rem;text-decoration:underline;',
		]) ?>
	<? endif ?>
</h1>



<? // todo: register script ?>
<?// $this->registerJsFile('/js/jquery.columnizer.min.js') ?>
<?
	// todo: make widget
	// $this->widget('application.extensions.category-tree.CategoryTreeWidget', [
	// 	'type' => 'product-tree',
	// 	'htmlOptions'=> [
	// 		'id'=>'product-tree',
	// 	],
	// ]);
?>


<br />
&nbsp;
<br />


<h2 align="center"><?= $model->lider ?></h2>


<?= $model->body ?>

