<?php

namespace common\facades;

use common\factories\RbacFactory;
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
        $role = (new RbacFactory())->createRoleByName($roleName);
        $permissions = array_intersect_key($allPermissionsList, array_flip($rolePermissionsList));
        (new RbacService())->assignPermissions($role, $permissions);

        return $role;
    }
}
