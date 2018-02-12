<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Item';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="item-index">

	<h1><?= Html::encode($this->title) ?></h1>


	<p>
		<?= Html::a('Создать Item', ['update'], ['class' => 'btn btn-success']) ?>
	</p>


	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => '&nbsp;',
		],
		'columns' => [
			//['class' => 'yii\grid\SerialColumn'],

			//'id',
			// 'header',
			[
				'attribute' => 'header',
				'format' => 'raw',
				'value' => function ($model) {
					$name = StringHelper::truncate($model->header, 45);
					$url = ['update', 'id' => $model->id];
					return Html::a($name, $url);
				},
			],
			'category.title',
			//'body:ntext',
			//'meta_title',
			//'meta_description',
			// 'meta_keywords',
			//'visible',
			[
				'attribute' => 'visible',
				'filter' => ['1' => 'Да', '0' => 'Нет'],
				'value' => function($model) {
					return ($model->visible) ? "Да" : "-";
				}
			],
			'url',
			'updated:date',

			['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
		],
	]) ?>




</div>
