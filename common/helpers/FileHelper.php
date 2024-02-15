<?php

namespace common\helpers;

use Exception;
use yii\web\UploadedFile;

class FileHelper
{
    /**
     * @throws Exception
     */
    public static function getUniqueFileName(UploadedFile $file): string
    {
        $random = substr(bin2hex(random_bytes(10)), 0, 10);

        return $random . '_' . $file->baseName . '.' . $file->extension;
    }
}