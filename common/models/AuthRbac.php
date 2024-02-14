<?php

namespace common\models;

class AuthRbac
{
    const PERMISSION_CREATE_BOOK = 'create book';
    const PERMISSION_VIEW_BOOK = 'view book';
    const PERMISSION_EDIT_BOOK = 'edit book';
    const PERMISSION_DELETE_BOOK = 'delete book';
    const PERMISSION_SUBSCRIBE_AUTHOR = 'subscribe author';

    const PERMISSIONS_FOR_GUEST = [
        self::PERMISSION_VIEW_BOOK,
        self::PERMISSION_SUBSCRIBE_AUTHOR
    ];
    const PERMISSIONS_FOR_AUTHOR = [
        self::PERMISSION_CREATE_BOOK,
        self::PERMISSION_VIEW_BOOK,
        self::PERMISSION_EDIT_BOOK,
        self::PERMISSION_DELETE_BOOK,
    ];
}