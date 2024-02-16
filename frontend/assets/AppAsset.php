<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;
use yii\web\YiiAsset;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = [
        'css/album-theme.css',
        'css/site.css',
    ];

    public $js = [
    ];

    public $depends = [
        ColorModesAsset::class,
        YiiAsset::class,
        BootstrapAsset::class,
    ];
}
