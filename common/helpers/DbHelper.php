<?php

namespace common\helpers;

class DbHelper
{
    public static function dbOptions(): string
    {
        return 'ENGINE=InnoDB CHARSET=utf8mb4';
    }
}