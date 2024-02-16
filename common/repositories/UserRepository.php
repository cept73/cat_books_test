<?php

namespace common\repositories;

use common\models\User;

class UserRepository
{
    /**
     * @param string $login
     * @return User|null
     */
    public function getUserByLogin(string $login): ?User
    {
        return User::findOne(['username' => $login]);
    }
}