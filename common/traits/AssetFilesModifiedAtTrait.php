<?php

namespace common\traits;

use Yii;

trait AssetFilesModifiedAtTrait
{
    public function __construct($config = [])
    {
        foreach (['css', 'js'] as $type) {
            foreach ($this->$type as &$file) {
                $fileName = Yii::getAlias($this->basePath . '/' . $file);
                if ($modifiedAt = filemtime($fileName)) {
                    $modifiedAtHex = dechex($modifiedAt);
                    $file = "$file?m=$modifiedAtHex";
                }
            }
        }

        /** @noinspection PhpMultipleClassDeclarationsInspection */
        parent::__construct($config);
    }
}