<?php

// Rendered on /catalog/* pages as top menu

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model \common\models\Category[] */
/* @var $htmlOptions array */
/* @var $item null|\common\models\Item */

?>


<?= Html::beginTag('div', $htmlOptions) ?>


	<? if (!$model) : ?>

		<? if (!Yii::$app->user->isGuest) : ?>
			<p>Категории отсутствуют, <?= Html::a('создать', ['/admin/category/add']) ?> корневую категорию?</p>
		<? endif ?>

	<? else: ?>


		<?
			$parents = null;
			if ($item !== null && $item->category) {
				// берем родительские категории текущей страницы
				/** @var \common\models\Category[] $parents */
				$parents = $item->category->getParents()->visible()->all();
				// добавляем к родительским категориям текущую категорию
				$parents[] = $item->category;
			}


			// определим категории только если страница привязана к какой-то категории
			if ($parents) {
				// берем заглавную категорию
				$current_root = $parents[1];
				// берем соседние категории
				/** @var \common\models\Category[] $neighbours */
				$neighbours = $current_root->getDescendants()->visible()->all();
			}

			// оставим в массиве только категории уровня 2
			$model = array_filter($model, function($cat) {
				return ($cat->depth === 2);
			});


			$depth = 0;

			foreach ($model as $category) {

				// пропустим первый уровень
				if ($category->depth === 1) {
					continue;
				}

				if ($category->depth > $depth) {
					echo '<ul class="native-columns">';
				} else if ($category->depth === $depth) {
					echo '</li>';
				} else if ($category->depth < $depth) {
					echo '</li>';

					for ($i = $depth-$category->depth; $i; $i--) {
						echo '</ul>';
						echo '</li>';
					}
				}

				echo '<li class="' . ($item->category->id === $category->id  || $category->id === $current_root->id ? 'active' : null) . '">';

					echo '<a href="' . Url::to(['catalog/view', 'url' => $category->item->url]) . '">';
						echo Html::img($category->image->getUrl(), ['valign' => 'middle', 'width' => '46', 'height' => '46']);
						echo '<span>' . Html::encode($category->title) . '</span>';
					echo '</a>';

				$depth = $category->depth;
			}

			// закрываем тэги списка, $depth-N (N = колич. пропущенных уровней вначале)
			for ($i = $depth - 1; $i; $i--) {
				echo '</li>';
				echo '</ul>';
			}
		?>

	<? endif ?>

	<?
		// если имеются соседние категории 
		if ($neighbours) {
			echo '<ul class="subcategories">';
				echo '<lh><a href="' . $current_root->item->url . '" title="' . Html::encode($current_root->item->header) . '">' . Html::encode($current_root->title) . '</a></lh>';
				foreach ($neighbours as $neighbour) {
					echo '<li class="subcategory ' . ($item->category->id === $neighbour->id ? 'active' : null) . '">' . Html::a(Html::encode($neighbour->title), ['catalog/view', 'url' => $neighbour->item->url ? : '#']) . '</li>';
				}
				echo '<div class="clearfix"></div>';
			echo '</ul>';
		}
		// foreach ($neighbours as $neighbour) {
		// 	echo Html::encode($neighbour->title);
		// }
	?>


<?= Html::endTag('div') ?>
