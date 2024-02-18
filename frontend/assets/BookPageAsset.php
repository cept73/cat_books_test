<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;
use yii\web\YiiAsset;

/**
 * Main frontend application asset bundle.
 */
class BookPageAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = [
    ];

    public $js = [
        'js/book.js'
    ];
}
