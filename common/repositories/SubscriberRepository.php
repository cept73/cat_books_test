<?php

namespace common\repositories;

use common\models\Author;
use common\models\Subscriber;

class SubscriberRepository
{
    public function getPhonesSubscribedToAuthorId(int $authorId): array
    {
        return Subscriber::find()->select(['to_phone'])->where([
            'object_class' => Author::class,
            'object_id' => $authorId,
        ])->column();
    }
}
