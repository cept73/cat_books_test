<?php
/** @noinspection PhpUnused */

namespace console\controllers;

use common\facades\RbacFacade;
use common\helpers\RbacPermissionHelper;
use common\models\User;
use Exception;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * @throws Exception
     */
    public function actionInit()
    {
        $authManager = Yii::$app->authManager;

        $permissionNames = array_unique(
            array_merge(RbacPermissionHelper::LIST_FOR_GUEST, RbacPermissionHelper::LIST_FOR_AUTHOR)
        );

        $permissionsList = [];
        foreach ($permissionNames as $permissionName) {
            $permission = $authManager->createPermission($permissionName);
            $permission->description = $permissionName;
            $authManager->add($permission);

            $permissionsList[$permissionName] = $permission;
        }

        $authorRole = RbacFacade::createRoleWithPermissions('author',  RbacPermissionHelper::LIST_FOR_AUTHOR, $permissionsList);
        RbacFacade::createRoleWithPermissions('guest',  RbacPermissionHelper::LIST_FOR_GUEST, $permissionsList);

        if ($authorRole = Yii::$app->authManager->getRole('author')) {
            $userId = User::findOne(['username' => 'admin'])?->id;

            if (!Yii::$app->authManager->checkAccess($userId, $authorRole->name)) {
                $authManager->assign($authorRole, $userId);
            }
        }
    }
}
