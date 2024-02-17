<?php

namespace common\facades;

use common\services\RbacService;
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
        return (new RbacService())->createRoleWithPermissions($roleName, $rolePermissionsList, $allPermissionsList);
    }
}
