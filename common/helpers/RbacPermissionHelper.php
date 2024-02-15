<?php

namespace common\helpers;

class RbacPermissionHelper
{
    const CREATE_BOOK = 'create book';
    const VIEW_BOOK = 'view book';
    const EDIT_BOOK = 'edit book';
    const DELETE_BOOK = 'delete book';
    const SUBSCRIBE_AUTHOR = 'subscribe author';

    const LIST_FOR_GUEST = [
        self::VIEW_BOOK,
        self::SUBSCRIBE_AUTHOR
    ];

    const LIST_FOR_AUTHOR = [
        self::CREATE_BOOK,
        self::VIEW_BOOK,
        self::EDIT_BOOK,
        self::DELETE_BOOK,
    ];
}