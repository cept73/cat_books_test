<?php

namespace frontend\assets;

use common\traits\AssetFilesModifiedAtTrait;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class BookPageAsset extends AssetBundle
{
    use AssetFilesModifiedAtTrait;

    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = [
    ];

    public $js = [
        'js/book.js'
    ];
}
