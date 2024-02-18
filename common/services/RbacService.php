<?php

namespace common\services;

use common\factories\RbacFactory;
use common\helpers\RbacPermissionHelper;
use Yii;
use yii\base\Exception;
use yii\rbac\Role;

class RbacService
{
    /**
     * @throws Exception
     */
    public function createRoleWithPermissions(string $roleName, array $rolePermissionsList, array $allPermissionsList): Role
    {
        $role = (new RbacFactory())->createRoleByName($roleName);
        $permissions = array_intersect_key($allPermissionsList, array_flip($rolePermissionsList));
        $authManager = Yii::$app->authManager;

        foreach ($permissions as $permission) {
            $authManager->addChild($role, $permission);
        }

        return $role;
    }

    /**
     * @throws \Exception
     */
    public function createPermissionToChangeBook($book, $userId): void
    {
        $authManager = Yii::$app->authManager;

        $changeThisBookPermission = RbacPermissionHelper::getChangeBookPermission($book);
        $permissionToChangeThisBook = $authManager->getPermission($changeThisBookPermission)
            ?: $authManager->createPermission($changeThisBookPermission);
        $authManager->add($permissionToChangeThisBook);
        $authManager->assign($permissionToChangeThisBook, $userId);
    }

    public static function isUserCan(string $permission): bool
    {
        $user = Yii::$app->user;

        if (in_array($permission, RbacPermissionHelper::LIST_FOR_GUEST)) {
            return $user->isGuest || $user->can($permission);
        }

        return $user->can($permission);
    }
}