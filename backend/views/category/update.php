<?php
use backend\models\Item;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model \backend\models\Category */

$this->title = 'Update Category #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';


$items = Item::find()
	->select(['header'])
	->andWhere('category_id IS NULL')
	->orWhere(['category_id' => $model->id])
	->orderBy('id')
	->indexBy('id')
	->column();
?>


<div class="category-update">


	<?php $form = ActiveForm::begin([]) ?>


		<?= $form->field($model, 'title') ?>
		<?= $form->field($model, 'description') ?>
		<?= $form->field($model, 'visible')->checkbox() ?>

		<?= $form->field($model, 'itemId')->dropDownList($items, ['prompt' => '—'/*, 'value' => $model->item ? $model->item->id : null*/]) ?>
		<div class="form-group help-block">
			<?php if ($model->item) : ?>
				<?= $model->item ? Html::a('Редактировать', ['/item/update', 'id' => $model->item->id]) : null ?>
			<?php else : ?>
				<?= $model->id ? Html::a('Создать', ['/item/update'], ['target' => '_blank']) : null ?>
			<?php endif ?>
		</div>

		<!-- Image -->
		<?= $form->beginField($model, 'image') ?>
			<label class="control-label" for="category-image>"><?= $model->getAttributeLabel('image') ?></label>
			<div class="form-group help-block">
				<?php if ($model->image) : ?>
						<?= Html::img($model->image->getUrl(), ['style' => 'vertical-align:top;align:left;']) ?>
						<?= Html::a('Редактировать', ['/image/update', 'id' => $model->image->id]) ?><br>
				<?php else : ?>
					<?= $model->id ? Html::a('Создать', ['/image/create'], ['target' => '_blank']) : null ?>
				<?php endif ?>
			</div>
		<?= $form->endField() ?>
		<!-- /Image -->

		<div class="form-group controls">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'type' => 'submit']) ?>
			<?php //= Html::submitButton('Удалить', ['class' => 'btn btn-danger', 'type' => 'delete']) ?>
		</div>


	<?php ActiveForm::end() ?>


</div>


