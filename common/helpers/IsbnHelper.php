<?php

namespace common\helpers;

class IsbnHelper
{
    public static function convertToISBN13(int $number): string
    {
        return substr($number, 0, 3)
            . '-' . substr($number, 3, 1)
            . '-' . substr($number, 4, 2)
            . '-' . substr($number, 6, 6)
            . '-' . substr($number, 12);
    }
}