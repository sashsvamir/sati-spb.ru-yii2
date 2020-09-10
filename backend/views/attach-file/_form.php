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





<?php $form = ActiveForm::begin([]) ?>


	<?= $form->errorSummary($model) ?>

	<?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

	<p>
		<?php if ($model->isNewRecord) : ?>
			<?= $form->field($model, 'file')->fileInput()->hint('pdf') ?>
		<?php else : ?>
			<?= Html::a($model->getUrl(), $model->getUrl()) ?>
		<?php endif ?>
	</p>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>


<?php ActiveForm::end(); ?>



