<?php

namespace common\factories;

use common\models\User;

class UserFactory
{
    /**
     * @param $userName
     * @param $password
     * @param $email
     * @return User
     */
    public function createByLoginPasswordEmail($userName, $password, $email): User
    {
        $user = new User();
        $user->username = $userName;
        $user->email = $email;
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        return $user;
    }
}