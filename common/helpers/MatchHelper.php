<?php

namespace common\helpers;

class MatchHelper
{
    public static function onlyAlpha(): string
    {
        return '/^[a-zA-Zа-яА-Я]+$/';
    }
}
