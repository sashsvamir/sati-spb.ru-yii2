<?php

/* @var $this yii\web\View */

use yii\helpers\Html;


$this->title = 'Admin area';
?>
<div class="site-index">

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Информация</h3>
		</div>
		<div class="panel-body">
			Структура сайта представляет собой набор категорий.
			<br>
			К категориям привязаны страницы, которые содержат информацию выводимую при просмотре категории!
			<br>
			К страницам можно прикрепить attach сущность.
			<br>
			Attach сущность содержит загруженные и прикрепленные к ней pdf документы. Такие pdf д-ты выводятся списком при просмотре страницы категории.
			<br>
			Еще есть картинки (image сущность). Они прикрепляются и к категориям и страницам.
		</div>
	</div>


    <div class="body-content">

        <div class="row">

	        <div class="col-lg-3">
                <h2>Category</h2>

                <p>Категории сайта.</p>

                <p><?= Html::a('category', ['/category/index'], ['class' => 'btn btn-default']) ?></p>
            </div>

	        <div class="col-lg-3">
                <h2>Item</h2>

                <p>Страницы которые привязываются к категориям.</p>

		        <p><?= Html::a('item', ['/item/index'], ['class' => 'btn btn-default']) ?></p>
            </div>

	        <div class="col-lg-3">
                <h2>Image</h2>

                <p>картинки.</p>

		        <p><?= Html::a('image', ['/image/index'], ['class' => 'btn btn-default disabled']) ?></p>
            </div>

	        <div class="col-lg-3">
                <h2>Attach</h2>

                <p>pdf документы.</p>

		        <p><?= Html::a('attach', ['/attach/index'], ['class' => 'btn btn-default']) ?></p>
            </div>

        </div>

    </div>
</div>
