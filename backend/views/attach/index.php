<?php
use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Attach;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AttachSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Attach';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="attach-index">

	<h1><?= Html::encode($this->title) ?></h1>


	<p>
		<?= Html::a('Создать Attach', ['update'], ['class' => 'btn btn-success']) ?>
	</p>


	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => '&nbsp;',
		],
		'columns' => [
			'id',
			'title',

			// show count of attached files
			[
				'label' => 'files',
				'format' => 'raw',
				'value' => function (Attach $model) {
					return '<span class="badge">' . count($model->files) . '</span>';
				}
			],

			['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
		],
	]) ?>




</div>
