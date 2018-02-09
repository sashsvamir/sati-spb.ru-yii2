<?php

// Rendered on / (intro) page as slider

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View */
/* @var $model \common\models\Item[] */
/* @var $htmlOptions array */

?>


<? if ($model) : ?>

	<?= Html::beginTag('ul', $htmlOptions) ?>
		
		<? foreach ($model as $item) : ?>

			<li class="product-<?= $item->id ?>">
				<a href="<?= Url::to(['catalog/view', 'url' => $item->url]) ?>">
					<img alt="<?= Html::encode($item->image->alt) ?>" src="<?= $item->image->getUrl() ?>" />
					<span class="description"><?= Html::encode($item->image->title) ?></span>
				</a>
			</li>

		<?php endforeach; ?>

	<?= Html::endTag('ul') ?>

<?php endif; ?>