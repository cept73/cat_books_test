<?php

namespace common\services;

use common\models\UserNotificationQueue;
use common\repositories\UserNotificationQueueRepository;
use Exception;
use Yii;

class UserNotificationQueueService
{
    /**
     * @throws Exception
     */
    public function sendNext(): ?UserNotificationQueue
    {
        $userNotificationQueueTask = (new UserNotificationQueueRepository())->nextNewAuthorsBookSubscribedPhoneTask();
        if (empty($userNotificationQueueTask)) {
            return null;
        }

        $message = Yii::t('app', 'New book from: {author}', [
            'author' => $userNotificationQueueTask->object_id
        ]);

        [$response, $code] = (new SmsPilotService())->sendOne($message, $userNotificationQueueTask->to_phone);

        $userNotificationQueueTask->response_text = $response;
        $userNotificationQueueTask->response_code = $code;
        $userNotificationQueueTask->status = UserNotificationQueue::STATUS_SENT;
        $userNotificationQueueTask->save(true, ['response_text', 'response_code', 'status']);

        return $userNotificationQueueTask;
    }
}
