<?php
use common\models\AttachFile;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $model \backend\models\AttachFile */


?>





<? $form = ActiveForm::begin([]) ?>


	<?= $form->errorSummary($model) ?>

	<?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

	<p>
		<? if ($model->isNewRecord) : ?>
			<?= $form->field($model, 'file')->fileInput()->hint('pdf') ?>
		<? else : ?>
			<?= Html::a($model->getUrl(), $model->getUrl()) ?>
		<? endif ?>
	</p>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>


<? ActiveForm::end(); ?>



