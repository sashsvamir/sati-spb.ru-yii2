<?

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\Attach */

?>


<? if ($model->files) : ?>

	<table class="item-files">
		<tbody>

			<? foreach ($model->files as $file) : ?>
				<tr>
					<td><?= $file->description ?></td>
					<? $description = strip_tags(str_replace( '<br', ', <br', $file->description)); ?>
					<td><a href="<?= $file->getUrl() ?>" alt="<?= Html::encode($file->alt) ?>" title="<?= $description ?>">Скачать pdf</td>
				</tr>
			<? endforeach ?>

		</tbody>
	</table>

<? endif ?>