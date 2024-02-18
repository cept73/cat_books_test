<?php

namespace common\services;

use common\helpers\RbacPermissionHelper;
use common\helpers\UrlHelper;
use common\models\Book;

class BookService
{
    public static function getActionsList(Book $book): array
    {
        $buttonsRights = [
            'view' => RbacPermissionHelper::VIEW_BOOK,
            'edit' => RbacPermissionHelper::getChangeBookPermission($book),
            'delete' => RbacPermissionHelper::getChangeBookPermission($book),
        ];

        $buttons = [];
        foreach ($buttonsRights as $buttonAction => $buttonPermission) {
            if (RbacService::isUserCan($buttonPermission)) {
                $buttons[$buttonAction] = UrlHelper::getBookActionUrl($buttonAction, $book);
            }
        }

        return $buttons;
    }
}