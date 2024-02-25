<?php
/** @noinspection PhpUnused */

namespace console\controllers;

use common\factories\UserFactory;
use common\models\User;
use common\repositories\UserRepository;
use Yii;
use yii\base\InvalidConfigException;
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

    /**
     * Create active user by login password email
     * @throws InvalidConfigException
     */
    public function actionCreate(string $login, string $password, string $email)
    {
        if (Yii::createObject(UserRepository::class)->getUserByLogin($login) !== null) {
            print "User $login already exists" . PHP_EOL;
            return;
        }

        $user = Yii::createObject(UserFactory::class)->createByLoginPasswordEmail($login, $password, $email);
        $user->status = User::STATUS_ACTIVE;

        if (!$user->save()) {
            die($user->errors);
        }

        print "User $login is created and activated" . PHP_EOL;
    }
}
