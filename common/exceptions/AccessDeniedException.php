<?php

namespace common\exceptions;

use yii\base\UserException;

class AccessDeniedException extends UserException
{
    public $code = 403;

    public $message = 'Доступ запрещен';
}
