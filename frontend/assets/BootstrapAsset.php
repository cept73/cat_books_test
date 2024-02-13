<?php
/** @noinspection SpellCheckingInspection */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class BootstrapAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
    ];

    public $js = [
    ];

    public $depends = [
        \yii\bootstrap5\BootstrapAsset::class
    ];
}
