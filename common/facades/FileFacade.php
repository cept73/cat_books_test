<?php

namespace common\facades;

class FileFacade
{
    public static function getShortFileName($uploadedPath)
    {
        $pathInfo = $uploadedPath ? pathinfo($uploadedPath) : [];

        return $pathInfo['filename'] ?? $uploadedPath;
    }
}
