<?php

namespace common\facades;

use common\helpers\FileHelper;
use Yii;
use yii\base\Exception;

class FileFacade
{
    /**
     * @throws Exception
     * @throws \Exception
     */
    public static function uploadFileTo($uploadedFile, $uploadedPath): string
    {
        $uploadPath = Yii::getAlias($uploadedPath);
        \yii\helpers\FileHelper::createDirectory($uploadPath);
        $fileName = FileHelper::getUniqueFileName($uploadedFile);
        $filePath = $uploadPath . $fileName;
        $uploadedFile->saveAs($filePath);

        return $fileName;
    }
}
