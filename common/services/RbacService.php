<?php

namespace common\services;

use Yii;
use yii\base\Exception;
use yii\rbac\Item;

class RbacService
{
    /**
     * @param Item $role
     * @param Item[] $permissions
     * @throws Exception
     */
    public function assignPermissions(Item $role, array $permissions): void
    {
        $authManager = Yii::$app->authManager;

        foreach ($permissions as $permission) {
            $authManager->addChild($role, $permission);
        }
    }
}