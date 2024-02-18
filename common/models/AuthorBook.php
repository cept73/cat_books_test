<?php

namespace common\models;

use common\factories\UserNotificationQueueFactory;
use common\repositories\SubscriberRepository;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $author_id
 * @property string $book_id
 */
class AuthorBook extends ActiveRecord
{
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $subscribersPhones = (new SubscriberRepository())->getPhonesSubscribedToAuthorId($this->author_id);
            if (!empty($subscribersPhones)) {
                (new UserNotificationQueueFactory())->addAuthorSubscribersPhones($this->author_id, $subscribersPhones);
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }
}
