<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View */
/* @var $model \common\models\Search */
/* @var $items \common\models\Item[] */
/* @var $error string */
/* @var $q string */
/* @var $dict array */

?>

<? if ($model->models) : ?>

	<p class="header">По запросу "<b><?= Html::encode($model->query) ?></b>" найдены следующие результаты:</p>

	<ul>
		<? foreach ($model->models as $data) : ?>
			<?
				$img = $data->category->image->filename;
				$text_part = $model->text_part($data->body_purified, $model->dict);
			?>

			<li class="result">

				<a href="<?= Url::to(['catalog/view', 'url' => $data->url]) ?>">
					<img src="/img/category/<?= $img ? $img : 'empty.png' ?>">
					<?= $data->header ?>
					<?= $model->bold(strip_tags($data->header), $model->dict) ?>
				</a>

				<span class="text">
					<?= $model->bold($text_part, $model->dict) ?>
				</span>

			</li>
		<? endforeach ?>
	</ul>

<? else : ?>

	<p class="header">По запросу "<b><?= Html::encode($model->query) ?></b>" ничего не найдено.</p>

<? endif ?>
