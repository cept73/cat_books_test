<?php

namespace common\services;

use common\helpers\RbacPermissionHelper;
use common\helpers\UrlHelper;
use common\models\Book;
use Yii;

class BookService
{
    public static function getActionsList(Book $book): array
    {
        $currentUser = Yii::$app->user;

        $buttonsRights = [
            'view' => RbacPermissionHelper::VIEW_BOOK,
            'edit' => RbacPermissionHelper::getChangeBookPermission($book),
            'delete' => RbacPermissionHelper::getChangeBookPermission($book),
            'subscribe' => RbacPermissionHelper::SUBSCRIBE_AUTHOR
        ];

        $buttons = [];
        foreach ($buttonsRights as $buttonAction => $buttonPermission) {
            $isButtonAllowed = $currentUser->can($buttonPermission)
                || ($currentUser->isGuest && in_array($buttonPermission, RbacPermissionHelper::LIST_FOR_GUEST));

            if ($isButtonAllowed) {
                $buttons[$buttonAction] = UrlHelper::getBookActionUrl($buttonAction, $book);
            }
        }

        return $buttons;
    }
}