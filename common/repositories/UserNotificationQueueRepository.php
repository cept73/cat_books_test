<?php

namespace common\repositories;

use common\models\Author;
use common\models\UserNotificationQueue;

class UserNotificationQueueRepository
{
    public function nextNewAuthorsBookSubscribedPhoneTask(): ?UserNotificationQueue
    {
        /** @var ?UserNotificationQueue $nextTask */
        $nextTask = UserNotificationQueue::find()
            ->where(['status' => UserNotificationQueue::STATUS_WAITING, 'object_class' => Author::class])
            ->one();

        return $nextTask;
    }
}
