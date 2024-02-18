<?php

namespace common\factories;

use common\models\Author;
use common\models\UserNotificationQueue;
use common\repositories\UserNotificationQueueRepository;
use common\services\SmsPilotService;
use Exception;
use Yii;

class UserNotificationQueueFactory
{
    public function addAuthorSubscribersPhones(int $authorId, array $phones): void
    {
        foreach ($phones as $phone) {
            $userNotificationQueueTask = new UserNotificationQueue();
            $userNotificationQueueTask->object_class = Author::class;
            $userNotificationQueueTask->object_id = $authorId;
            $userNotificationQueueTask->status = UserNotificationQueue::STATUS_WAITING;
            $userNotificationQueueTask->to_phone = $phone;
            $userNotificationQueueTask->save();
        }
    }
}
