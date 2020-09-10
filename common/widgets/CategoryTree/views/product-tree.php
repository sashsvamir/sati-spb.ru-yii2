<?php

// Rendered only on /catalog page

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model \common\models\Category[] */
/* @var $htmlOptions array */
/* @var $item null|\common\models\Item */

?>


<?= Html::beginTag('div', $htmlOptions) ?>


	<?php if (!$model) : ?>

		<?php if (!Yii::$app->user->isGuest) : ?>
			<p>Категории отсутствуют, <?= Html::a('создать', ['/admin/category/add']) ?> корневую категорию?</p>
		<?php endif ?>

	<?php else: ?>


		<?php
			$depth = 0;
			foreach ($model as $category) {

				// пропустим первый уровень
				if ($category->depth === 1) {
					continue;
				}

				if ($category->depth > $depth) {
					echo '<ul class="' . ($category->depth === 2 ? 'native-columns' : null ) . '">';
				} else if ($category->depth === $depth) {
					echo '</li>';
				} else if ($category->depth < $depth) {
					echo '</li>';

					for ($i = $depth - $category->depth; $i; $i--) {
						echo '</ul>';
						echo '</li>';
					}
				}
				echo '<li>';

					echo '<a href="' . Url::to(['catalog/view', 'url' => $category->item->url]) . '">';
						echo ($category->depth === 2) ? '<img src="/img/category-medium/' . $category->image->filename . '" valign="middle" width="62" height="62" />' : null;
						echo '<span class="name">' . Html::encode($category->title) . '</span>';
					echo '</a>';

				$depth = $category->depth;
			}

			// закрываем тэги списка, $depth-N (N = колич. пропущенных уровней вначале)
			for ($i = $depth - 1; $i; $i--) {
				echo '</li>';
				echo '</ul>';
			}
		?>

	<?php endif ?>


<?= Html::endTag('div') ?>