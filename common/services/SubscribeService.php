<?php

namespace common\services;

use common\models\Author;
use common\models\Subscriber;
use frontend\models\SubscribeForm;

class SubscribeService
{
    public static function subscribeByForm(SubscribeForm $subscribeForm): ?bool
    {
        $subscriberAttributes = [
            'object_class' => Author::class,
            'object_id' => $subscribeForm->author_id,
            'to_phone' => $subscribeForm->phone,
        ];

        if (Subscriber::find()->where($subscriberAttributes)->exists()) {
            return null;
        }

        $subscriber = new Subscriber();
        $subscriber->setAttributes($subscriberAttributes);

        return $subscriber->save();
    }
}
