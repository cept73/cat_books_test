<?php

namespace console\controllers;

use common\models\User;
use yii\console\Controller;

class UserController extends Controller
{
    /**
     * Activate user by specified name
     */
    public function actionActivate(string $userName)
    {
        $user = User::findOne(['username' => $userName]);
        if (empty($user)) {
            die('User not found' . PHP_EOL);
        }

        $user->status = User::STATUS_ACTIVE;
        $user->save(false, ['status']);

        print "User $userName is activated" . PHP_EOL;
    }
}
