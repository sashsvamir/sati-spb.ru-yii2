<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View */
/* @var $model \common\models\Search */

?>

<?php if ($model->models) : ?>

	<p class="header">По запросу "<b><?= Html::encode($model->query) ?></b>" найдены следующие результаты:</p>

	<ul>
		<?php foreach ($model->models as $data) : ?>
			<?php
/** @var \common\models\Item $data */
				$image = $data->category->image ? $data->category->image->getUrl() : '/img/category/empty.png';
				$text_part = $model->text_part($data->body_purified, $model->dict);
			?>

			<li class="result">

				<a href="<?= Url::to(['catalog/view', 'url' => $data->url]) ?>">
					<img src="<?= $image ?>">
					<?= $data->header ?>
					<?= $model->bold(strip_tags($data->header), $model->dict) ?>
				</a>

				<span class="text">
					<?= $model->bold($text_part, $model->dict) ?>
				</span>

			</li>
		<?php endforeach ?>
	</ul>

<?php else : ?>

	<p class="header">По запросу "<b><?= Html::encode($model->query) ?></b>" ничего не найдено.</p>

<?php endif ?>
