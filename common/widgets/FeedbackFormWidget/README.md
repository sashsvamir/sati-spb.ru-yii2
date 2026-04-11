# Feedback Widget

Модуль загружает форму запросов с другого сайта.




Dependency
-------------

Для модального окна с формой запросов необходим sashsvamir/TingleAsset, установка:
`composer.json`:
```json
"repositories": [
	{"type": "vcs", "url": "https://github.com/sashsvamir/yii2-tingle"}
]
```
```
$ composer require sashsvamir/yii2-tingle:"dev-master"
```





Using
--------

Необходимо указать ссылку по которой будет загружаться содержимое для фрейма, параметры `urlProd` и `urlDev`, можно указать один параметр или оба, тогда будет использоваться ссылка в зависимости от окружения.
Можно указать `referer` который будет подставлен как `get` параметр в ссылку.
 
```php
<?= FeedbackFormWidget::widget([
	'urlProd' => 'https://intermehanika-ltd.ru/feedback/frame/index',
	'urlDev' => 'http://shop/feedback/frame/index',
	'referer' => 'sati',
]) ?>
```



