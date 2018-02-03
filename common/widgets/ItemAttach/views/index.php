<?

use yii\helpers\Html;
use yii\helpers\Url;

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
					<td><a href="/download/<?= $file->attach_id ?>/<?= $file->filename ?>" alt="<?= $file->alt ?>" title="<?= $description ?>">Скачать pdf</td>
				</tr>
			<? endforeach ?>

		</tbody>
	</table>

<? endif ?>