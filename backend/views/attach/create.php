<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \backend\models\Attach */



$this->title = 'Create new Attach';
$this->params['breadcrumbs'][] = ['label' => 'Attach', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Create';
?>


<div class="attach-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
