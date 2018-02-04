<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $model \common\models\Search */
/* @var $items \common\models\Item[] */
/* @var $error string */
/* @var $q string query phrase */
/* @var $dict array */


$this->title = 'Поиск';

// Create breadcrumbs
$this->params['breadcrumbs'][] = 'Поиск';
?>



<div id="search_results">


	<form action="/search" method="GET">
		<input id="search" name="query" type="text" placeholder="Поиск..." autocomplete="off" value="<?= Html::encode(strip_tags($model->query)) ?>" />
		<input type="submit" value="Найти" />
	</form>


	<? if ($model->hasErrors()) : ?>

		<p class="header">
			<?= $model->getFirstError('query') ?>
		</p>

	<? else : ?>

		<?= $this->render('_result', [
			'model' => $model,
		]) ?>

	<? endif ?>

</div>