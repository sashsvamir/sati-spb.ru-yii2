<?php

// Rendered on /page/* pages as top menu

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model \common\models\Category[] */
/* @var $htmlOptions array */
/* @var $item null|\common\models\Item */

?>





	<? if (!$model) : ?>

		<? if (!Yii::$app->user->isGuest) : ?>
			<p>Категории отсутствуют, <?= Html::a('создать', ['/admin/category/add']) ?> корневую категорию?</p>
		<? endif ?>

	<? else: ?>


		<?
			$depth = 0;
			foreach ($model as $category) {
				
				// пропустим первый уровень
				if ($category->depth === 1) {
					continue;
				}

				if ($category->depth > $depth) {
					echo '<ul class="' . ($depth === 0 ? 'native-columns' : null) . '">';
				} else if ($category->depth === $depth) {
					echo '</li>';
				} else if ($category->depth < $depth) {
					echo '</li>';

					for ($i = $depth - $category->depth; $i; $i--) {
						echo '</ul>';
						echo '</li>';
					}
				}
				echo '<li class="category-level-' . ($category->depth - 1) . ' ' . ($category->isLeaf() ? 'leaf' : 'parent') . ' ' . ($category->item ? 'attached' : 'noattached') . '">';

					echo '<span class="name ' . ($item->id === $category->item->id ? 'active' : null) . '">';
						echo ($category->item->url) ? '<a href="' . Url::to(['catalog/view', 'url' => $category->item->url]) . '">' : '';
							echo Html::encode($category->title);
						echo ($category->item->url) ? '</a>' : '';
					echo '</span>';

				$depth = $category->depth;
			}

			// закрываем тэги списка, $depth-N (N = колич. пропущенных уровней вначале)
			for ($i = $depth - 1; $i; $i--) {
				echo '</li>';
				echo '</ul>';
			}
		?>

<? endif ?>
