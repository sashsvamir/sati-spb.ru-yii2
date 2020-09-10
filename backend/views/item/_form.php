<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\Category;
use backend\models\Attach;

/* @var $this yii\web\View */
/* @var $model \backend\models\Item */


$categories = Category::find()
	->select(['category.title', 'category.id'])
	->leftJoin('item', 'item.category_id = category.id')
	->where('item.category_id IS NULL')
	->orWhere(['item.category_id' => $model->category_id])
	->orderBy('category.lft')
	->indexBy('id')
	->column();

$attaches = Attach::find()
	->select('title')
	->indexBy('id')
	->column();
?>





<?php $form = ActiveForm::begin([]) ?>


	<?= $form->errorSummary($model) ?>

	<?= $form->field($model, 'header')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'lider')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'meta_title')->textInput(['maxlength' => true, 'size' => 4]) ?>
	<?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'body')->textarea(['rows' => 31]) ?>
	<?php//= $form->field($model, 'body_raw')->widget(CKEditor::class, CKEditorHelper::getConfig()) ?>
	<?php//= $form->field($model, 'body_raw')->widget(WyciwygCodeWidget::class, [
		// 'uploadUrl' => Url::to(['upload/file-upload']),
		// 'browserUrl' => Url::to(['elfinder/view']),
		// 'options' => ['rows' => 31],
	// ]) ?>

	<?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'urlOldValue')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'visible')->checkbox() ?>

	<?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => '—']) ?>

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

	<?= $form->field($model, 'attach_id')->dropDownList($attaches, ['prompt' => '—']) ?>

	<?= $form->field($model, 'priority')->textInput() ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>


<?php ActiveForm::end(); ?>



