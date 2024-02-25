<?php

namespace common\models;

use common\factories\UserNotificationQueueFactory;
use common\repositories\SubscriberRepository;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $author_id
 * @property string $book_id
 */
class AuthorBook extends ActiveRecord
{
    /**
     * @throws InvalidConfigException
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $subscribersPhones = Yii::createObject(SubscriberRepository::class)->getPhonesSubscribedToAuthorId($this->author_id);
            if (!empty($subscribersPhones)) {
                Yii::createObject(UserNotificationQueueFactory::class)->createAuthorSubscribersPhones($this->author_id, $subscribersPhones);
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }
}
