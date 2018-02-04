<?php

/* @var $this \yii\web\View */
/* @var $model array */


// !!! BEFORE FIRST TAG '<?xml...' NOT ALLOWED SPACES !!!
?><?= '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">


	<? foreach ($model as $data) : ?>

		<url>

			<loc><?= $data['url'] ?></loc>

			<? if (isset($data['updated_at'])) : ?>
				<lastmod><?= Yii::$app->formatter->asDate($data['updated_at'], 'yyyy-MM-dd') ?></lastmod>
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
