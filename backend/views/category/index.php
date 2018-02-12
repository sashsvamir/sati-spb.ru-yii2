<?php

/* @var $this yii\web\View */

use \voskobovich\tree\manager\widgets\nestable\Nestable;


$this->title = 'Category';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">


	<?= Nestable::widget([
		'modelClass' => 'backend\models\Category',
		'nameAttribute' => 'title',
	]) ?>

</div>
