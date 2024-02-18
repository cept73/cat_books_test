<?php

namespace common\helpers;

use Faker\Provider\Person;

class FakerHelper
{
    public static function randomGender()
    {
        $zeroOrOne = rand(0, 1);

        return [
            Person::GENDER_FEMALE,
            Person::GENDER_FEMALE
        ][$zeroOrOne];
    }
}
