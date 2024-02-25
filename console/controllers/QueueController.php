<?php
/** @noinspection PhpUnused */

namespace console\controllers;

use common\services\UserNotificationQueueService;
use Exception;
use Yii;
use yii\console\Controller;

class QueueController extends Controller
{
    /**
     * Send next waiting notify
     * @throws Exception
     */
    public function actionSendNotify()
    {
        $userNotificationQueue = Yii::createObject(UserNotificationQueueService::class)->sendNext();

        if ($userNotificationQueue === null) {
            return;
        }

        print "Task $userNotificationQueue->id executed: " . json_encode([
            'text' => $userNotificationQueue->response_text,
            'code' => $userNotificationQueue->response_code
        ]) . PHP_EOL;
    }
}
