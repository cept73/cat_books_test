<?php

namespace common\services;

use common\helpers\UrlHelper;
use common\models\AuthRbac;
use common\models\Book;
use Yii;

class BookService
{
    public static function getActionsList(Book $book): array
    {
        $currentUser = Yii::$app->user;

        $buttonsRights = [
            'view' => AuthRbac::PERMISSION_VIEW_BOOK,
            'edit' => AuthRbac::PERMISSION_EDIT_BOOK,
            'create' => AuthRbac::PERMISSION_CREATE_BOOK,
            'delete' => AuthRbac::PERMISSION_DELETE_BOOK,
            'subscribe' => AuthRbac::PERMISSION_SUBSCRIBE_AUTHOR
        ];

        $buttons = [];
        foreach ($buttonsRights as $buttonAction => $buttonPermission) {
            $isButtonAllowed = ($currentUser->isGuest && in_array($buttonPermission, AuthRbac::PERMISSIONS_FOR_GUEST))
                || $currentUser->can($buttonPermission);

            if ($isButtonAllowed) {
                $buttons[$buttonAction] = UrlHelper::getBookActionUrl($buttonAction, $book);
            }
        }
        return $buttons;
    }
}