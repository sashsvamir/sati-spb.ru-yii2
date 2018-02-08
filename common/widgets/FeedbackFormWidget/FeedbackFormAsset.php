<?php
namespace common\widgets\FeedbackFormWidget;

use yii\web\AssetBundle;


class FeedbackFormAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/FeedbackFormWidget/dist';

    public $js = [
        'feedback-form.min.js',
    ];

   public $css = [
       'feedback-form.css',
   ];

    public $depends = [
        'yii\web\JqueryAsset',
        'sashsvamir\tingle\TingleAsset',
    ];

}
