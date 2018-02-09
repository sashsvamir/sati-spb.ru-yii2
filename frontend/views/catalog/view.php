<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\ItemAttach\ItemAttach;

/* @var $this yii\web\View */
/* @var $model \common\models\Item */



// Seo headers
$this->title = Html::encode($model->meta_title);
// todo: remove using category desciprion (using item->meta_description instead only)
$this->registerMetaTag(['name' => 'description', 'content' => $model->meta_description ? : $model->category->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->meta_keywords]);



// Create breadcrumbs
// если страница привзана к категории
if ($category = $model->category) {
	// если у категории есть предки
	if ($parents = $category->getParents()->all()) {
		foreach ($parents as $parent) {
			// если к предку привязана страница, укажем ее в хлебн. крошках
			/** @var $item \common\models\Item */
			if ($item = $parent->item) {
				$this->params['breadcrumbs'][] = [
					'label' => $item->category->title,
					'url' => Url::to(['catalog/view', 'url' => $item->url]),
				];
			}
		}
	}
}

// добавим в хлебн. крошки название текущей страницы
// $this->breadcrumbs[] = $model->img->menu_title;
$crumb = $model->category ? $model->category->title : $model->header;
$crumb = strip_tags(str_replace('<br', '. <br', $crumb));
$this->params['breadcrumbs'][] = $crumb;
?>





<div class="item-background" id="item-<?= $model->id ?>"></div>

<div class="article">

	<h1>
		<?= $model->header ?>
		<? if ((Yii::$app->user->id === "admin")) : ?>
			<? // todo: fix link to admin ?>
			<?= ' ' . Html::a("Изменить", ['/admin/item/update/', 'id' => $model->id], [
				'class' => 'admin',
				'style' => 'font-size:.6rem;text-decoration:underline;',
				'title' => 'Редактировать запись',
			]) ?>
		<? endif ?>
	</h1>

	<? if ($model->lider) : ?>
		<h2><?= $model->lider ?></h2>
	<? endif ?>

	<?= $model->body ?>

</div>




<?= ItemAttach::widget([
	'attach' => $model->attach,
]) ?>


