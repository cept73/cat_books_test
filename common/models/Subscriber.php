<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $object_class
 * @property string $object_id
 * @property string $to_phone
 */
class Subscriber extends ActiveRecord
{
    public function safeAttributes(): array
    {
        return ['object_class', 'object_id', 'to_phone'];
    }
}
