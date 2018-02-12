<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \backend\models\AttachFile */



$this->title = 'Create new AttachFile';
$this->params['breadcrumbs'][] = ['label' => 'Attach', 'url' => ['/attach/index']];
$this->params['breadcrumbs'][] = ['label' => 'Attach #' . $model->attach_id, 'url' => ['/attach/update', 'id' => $model->attach_id]];
$this->params['breadcrumbs'][] = 'Create';
?>


<div class="attach-file-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
