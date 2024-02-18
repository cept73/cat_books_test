<?php

namespace common\services;

use common\helpers\FileHelper;
use Yii;
use yii\base\Exception;

class FileService
{
    /**
     * @throws Exception
     * @throws \Exception
     */
    public function uploadFileTo($uploadedFile, $uploadedPath): string
    {
        $uploadPath = Yii::getAlias($uploadedPath);
        \yii\helpers\FileHelper::createDirectory($uploadPath);
        $fileName = FileHelper::getUniqueFileName($uploadedFile);
        $filePath = $uploadPath . $fileName;
        $uploadedFile->saveAs($filePath);

        return $fileName;
    }
}
