<?php

namespace common\facades;

use common\services\RbacService;
use Yii;
use yii\base\Exception;
use yii\rbac\Role;

class RbacFacade
{
    /**
     * @param string $roleName
     * @param array $rolePermissionsList
     * @param array $allPermissionsList
     * @return Role
     * @throws Exception
     */
    public static function createRoleWithPermissions(string $roleName, array $rolePermissionsList, array $allPermissionsList): Role
    {
        return Yii::createObject(RbacService::class)->createRoleWithPermissions($roleName, $rolePermissionsList, $allPermissionsList);
    }
}
