<?php

namespace frontend\assets;

use common\traits\AssetFilesModifiedAtTrait;
use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main frontend application asset bundle.
 */
class ColorModesAsset extends AssetBundle
{
    use AssetFilesModifiedAtTrait;

    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = [
    ];

    public $js = [
        'js/color-modes.js'
    ];

    public $jsOptions = [
        'position' => View::POS_BEGIN
    ];

    public $depends = [
        BootstrapAsset::class,
    ];
}
