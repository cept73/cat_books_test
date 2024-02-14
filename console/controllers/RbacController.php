<?php
/** @noinspection PhpUnused */

namespace console\controllers;

use common\models\AuthRbac;
use Exception;
use Yii;
use yii\console\Controller;
use yii\rbac\BaseManager;
use yii\rbac\Role;

class RbacController extends Controller
{

    private BaseManager $authManager;
    private array $permissionsList;

    public function __construct($id, $module, $config = [])
    {
        $this->authManager = Yii::$app->authManager;

        parent::__construct($id, $module, $config);
    }

    /**
     * @throws Exception
     */
    public function actionInit()
    {
        $this->loadPermissions();
        $authorRole = $this->createRoleWithPermissions('author', AuthRbac::PERMISSIONS_FOR_AUTHOR);
        $this->createRoleWithPermissions('guest', AuthRbac::PERMISSIONS_FOR_GUEST);

        $this->authManager->assign($authorRole, 1);
    }

    /**
     * @throws Exception
     */
    private function loadPermissions()
    {
        $this->permissionsList = [];

        $permissionNames = array_unique(
            array_merge(
                AuthRbac::PERMISSIONS_FOR_GUEST,
                AuthRbac::PERMISSIONS_FOR_AUTHOR
            )
        );

        foreach ($permissionNames as $permissionName) {
            $permission = $this->authManager->createPermission($permissionName);
            $permission->description = $permissionName;
            $this->authManager->add($permission);

            $this->permissionsList[$permissionName] = $permission;
        }
    }

    /**
     * @throws \yii\base\Exception
     * @throws Exception
     */
    private function createRoleWithPermissions($roleName, $permissionsNames): Role
    {
        $role = $this->authManager->createRole($roleName);
        $this->authManager->add($role);
        foreach ($permissionsNames as $permissionName) {
            $this->authManager->addChild($role, $this->permissionsList[$permissionName]);
        }

        return $role;
    }
}
