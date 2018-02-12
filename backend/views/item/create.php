<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \backend\models\Item */



$this->title = 'Create new Item';
$this->params['breadcrumbs'][] = ['label' => 'Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Create';
?>


<div class="item-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
