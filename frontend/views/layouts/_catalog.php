<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\Breadcrumbs;
use common\widgets\CategoryTree\CategoryTree;


$this->registerAssetBundle(\frontend\assets\CatalogAsset::class);

?>

<?php $this->beginContent(Yii::$app->getLayoutPath() . '/main.php'); ?>



	<div id="menu">
		<ul>
			<li class="logo"><a href="/">Sati</a></li>
			<li class="products<?= Yii::$app->controller->id === 'catalog' ? ' active' : null ?>"><a href="/catalog">Приводная техника</a></li>
			<li class="contacts dropdown"><a href="/page/contacts">Контакты</a></li>
			<li class="feedback"><a href="<?= Yii::$app->params['feedback'] ?>">Запрос товара</a></li>
			<li class="search unfocused">
				<form action="/search" method="GET">
					<input id="search" name="query" type="text" placeholder="Поиск..." autocomplete="off" />
					<input type="submit" value="Найти" />
				</form>
			</li>
		</ul>
	</div>


	<?php if (Yii::$app->controller->id !== 'catalog') : // выводить появляющееся меню продуктов если не открыт продукт (/catalog/view) или его список (/catalog/index) ?>

		<div id="products-list">
			<div class="products-list-content">
				<?= CategoryTree::widget([
					'view' => 'index',
				]) ?>
			</div>
		</div>

	<?php endif ?>



	<div id="contacts-info">
		<p class="header">Официальный представитель в России:</p>
		<p class="phones"><span class="phone">+7&nbsp;(812)&nbsp;702-70-91</span><br><span class="phone">+7&nbsp;(812)&nbsp;702-70-92</span></p>
		<p class="feedback">⇒ <a href="<?= Yii::$app->params['feedback'] ?>">заказ on-line</a></p>
	</div>







	<div id="wrap">

		<div class="content">

			<?php if (Yii::$app->controller->id === 'catalog' && Yii::$app->controller->action->id === 'view') {
				// если открыт продукт
				echo CategoryTree::widget([
					'view' => 'fast-menu',
					'htmlOptions' => [
						'id' => 'fast-menu',
					],
				]);
			} ?>

			<?php if (isset($this->params['breadcrumbs'])) {
				echo Breadcrumbs::widget([
					'encodeLabels' => false,
					'links' => $this->params['breadcrumbs'],
				]);
			} ?>

			<?= $content ?>

		</div>

		<div class="clearfix"></div>

	</div>



	<div id="footer">

		<div class="copyright">
			<p>Общество с ограниченно ответственностью &laquo;Интермеханика Лтд&raquo; &copy; 2012 г.</p>
		</div>

		<div class="column contacts">
			<h4>Контакты</h4>
			<ul>
				<li class="phones">Тел.: <span class="phone"><?= implode('</span><br /><span class="phone">', Yii::$app->params['phones']) ?></span></li>
				<li>E-mail: <a href="mailto:info@intermehanika.ru">info@intermehanika.ru</a></li>
				<li>Site: <a href="https://intermehanika.ru">intermehanika.ru</a></li>
			</ul>
		</div>

		<div class="column">
			<h4>Ссылки</h4>
			<ul>
				<li><a href="/page/about">О компании</a></li>
				<li><a href="/catalog">Продукция</a></li>
				<!--<li><a href="http://www.intermehanika-ltd.ru/site/page?view=vacancy">Вакансии</a></li>-->
				<li><a href="/page/contacts">Контакты</a></li>
				<li><a href="/page/spec">Спец. предложение</a></li>
				<li><a href="/sitemap">Карта сайта</a></li>
				<?php //= (YII_DEBUG) ? '<li><a href="/admin/site">' . (Yii::$app->user->isGuest ? 'Вход' : 'Управление') . '</a></li>' : null ?>
			</ul>
		</div>

	</div>



<?php $this->endContent(); ?>
