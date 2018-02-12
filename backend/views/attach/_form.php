<?php
use common\models\AttachFile;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $model \backend\models\Attach */


?>





<? $form = ActiveForm::begin([]) ?>


	<?= $form->errorSummary($model) ?>

	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<? if (!$model->isNewRecord) : ?>
		<p>
			<?= Html::a('Добавить файл', ['/attach-file/create', 'attach_id' => $model->id], ['class' => 'btn btn-success']) ?>
		</p>

		<?= GridView::widget([
			'dataProvider' => new ActiveDataProvider([
				'query' => $model->getFiles(),
				'pagination' => [
					'pageSize' => 20,
				],
			]),
			'columns' => [
				// 'id',
				[
					'attribute' => 'file',
					'value' => function (AttachFile $model) {
						return $model->filename;
					},
				],
				[
					'attribute' => 'alt',
					'value' => function (AttachFile $model) {
						return StringHelper::truncate($model->alt, 45);
					},
				],
				[
					'attribute' => 'description',
					'value' => function (AttachFile $model) {
						return StringHelper::truncate($model->description, 45);
					},
				],
				[
					'class' => 'yii\grid\ActionColumn',
					'template' => '{update} {delete}',
					'controller' => 'attach-file',
				],
			],
		]) ?>

	<? endif ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>


<? ActiveForm::end(); ?>



