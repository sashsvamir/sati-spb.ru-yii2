<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\Attach */

?>


<?php if (isset($model) && $model->files) : ?>

	<table class="item-files">
		<tbody>

			<?php foreach ($model->files as $file) : ?>
				<tr>
					<td><?= $file->description ?></td>
					<?php $description = strip_tags(str_replace( '<br', ', <br', $file->description)); ?>
					<td><a href="<?= $file->getUrl() ?>" alt="<?= Html::encode($file->alt) ?>" title="<?= $description ?>">Скачать pdf</td>
				</tr>
			<?php endforeach ?>

		</tbody>
	</table>

<?php endif ?>