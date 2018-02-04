<?php

/* @var $this yii\web\View */

use common\widgets\ItemSlider\ItemSlider;


$this->title = 'Sati – Приводная техника';
$this->registerMetaTag(['name' => 'description', 'content' => 'Комплексная поставка импортных оригинальных комплектующих к промышленному оборудованию от ведущих мировых производителей на многочисленные предприятия по всей России как в сфере деревообработки, машиностроения, металлургии, нефтехимии, так и пищевой промышленности и других отраслей.']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'Sati, приводная техника']);
?>



<!-- Slider -->
<div id="slider">
	<div class="container">
		<?= ItemSlider::widget([
			'htmlOptions' => [
				'class' => 'items',
			],
		]) ?>
	</div>
	<div class="shadow-left"></div>
	<div class="shadow-right"></div>
</div>
<div class="shadow"></div>
