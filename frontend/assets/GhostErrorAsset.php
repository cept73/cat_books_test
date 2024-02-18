<?php

namespace frontend\assets;

use common\traits\AssetFilesModifiedAtTrait;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class GhostErrorAsset extends AssetBundle
{
    use AssetFilesModifiedAtTrait;

    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = [
        'css/error-ghost.css',
    ];

    public $js = [
        'css/error-ghost.js',
    ];

    public $depends = [
        // YiiAsset::class,
        // BootstrapAsset::class,
    ];
}
