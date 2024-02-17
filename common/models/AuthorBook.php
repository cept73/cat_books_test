<?php

namespace common\models;

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
            $subscribers = Subscriber::findAll(['author_id' => $this->author_id]);

            // TODO: post to subscribers
        }

        parent::afterSave($insert, $changedAttributes);
    }
}