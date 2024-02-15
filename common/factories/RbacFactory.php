<?php

namespace common\factories;

use Exception;
use Yii;
use yii\rbac\Role;

class RbacFactory
{
    /**
     * @throws \yii\base\Exception
     * @throws Exception
     */
    public function createRoleByName($roleName): Role
    {
        $authManager = Yii::$app->authManager;

        $role = $authManager->createRole($roleName);
        $authManager->add($role);

        return $role;
    }
}
