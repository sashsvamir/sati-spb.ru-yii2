<?php

/* @var $this \yii\web\View */
/* @var $model array */

use yii\helpers\Url;


// !!! BEFORE FIRST TAG '<?xml...' NOT ALLOWED SPACES !!!
?><?= '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">


	<? foreach ($model as $data) : ?>
		<url>

			<? if (isset($data['url'])) : ?>
				<loc><?= Url::to(['catalog/view', 'url' => $data['url']], true) ?></loc>
			<? else : ?>
				<loc><?= Url::to(['catalog/index'], true) ?></loc>
			<? endif ?>

			<? if (isset($data['updated'])) : ?>
				<lastmod><?= Yii::$app->formatter->asDate($data['updated'], 'yyyy-MM-dd') ?></lastmod>
			<? endif ?>

			<? /*
				<changefreq><?= $category['changefreq'] ?></changefreq>

				if (isset($category->item->priority)) {
					echo '<priority>' . $category->item->priority . '</priority>';
				}
            */ ?>

		</url>
	<? endforeach ?>


</urlset>
