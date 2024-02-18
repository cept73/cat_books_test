<?php

namespace common\helpers;

class MatchHelper
{
    public static function onlyAlpha(): string
    {
        return '/^[a-zA-Zа-яА-Я]+$/';
    }

    public static function bookTitle(): string
    {
        return '/^[a-zA-Zа-яА-Я,! ]+$/';
    }
}
