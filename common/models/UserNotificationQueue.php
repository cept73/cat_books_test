<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $object_class
 * @property string $object_id
 * @property string $to_phone
 * @property int $status
 * @property string $response_text
 * @property string $response_code
 */
class UserNotificationQueue extends ActiveRecord
{
    public const STATUS_WAITING = 'waiting';
    public const STATUS_SENT = 'sent';

    public function safeAttributes(): array
    {
        return ['object_class', 'object_id', 'to_phone', 'status'];
    }
}
