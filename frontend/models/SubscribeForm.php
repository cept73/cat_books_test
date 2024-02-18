<?php

namespace frontend\models;

use floor12\phone\PhoneValidator;
use Yii;
use yii\base\Model;

/**
 * Subscribe is the model behind the subscribe form.
 */
class SubscribeForm extends Model
{
    public int $author_id;
    public string $phone;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['phone', 'author_id'], 'required'],
            ['author_id', 'integer'],
            ['phone', PhoneValidator::class]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'phone' => Yii::t('app', 'Телефон'),
            'author_id' => Yii::t('app', 'ID автора'),
        ];
    }
}
