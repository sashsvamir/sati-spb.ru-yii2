<?php

use yii\helpers\Html;
use common\widgets\CategoryTree\CategoryTree;

/* @var $this yii\web\View */
/* @var $model \common\models\Item */



// Seo headers
$this->title = $model->meta_title;
$this->registerMetaTag(['name' => 'description', 'content' => $model->meta_description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->meta_keywords]);

?>



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



<?=
	CategoryTree::widget([
		'view' => 'product-tree',
		'htmlOptions' => [
			'id' => 'product-tree',
		],
	]);

?>


<br />
&nbsp;
<br />


<h2 align="center"><?= $model->lider ?></h2>


<?= $model->body ?>

