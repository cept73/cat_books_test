<?php

namespace common\helpers;

use common\models\Book;

class RbacPermissionHelper
{
    const CREATE_BOOK = 'create book';
    const VIEW_BOOK = 'view book';
    const CHANGE_BOOK = 'change book {bookId}';
    const SUBSCRIBE_AUTHOR = 'subscribe author';

    const LIST_FOR_GUEST = [
        self::VIEW_BOOK,
        self::SUBSCRIBE_AUTHOR
    ];

    const LIST_FOR_AUTHOR = [
        self::VIEW_BOOK,
        self::CHANGE_BOOK,
        self::CREATE_BOOK,
    ];

    public static function getChangeBookPermission(Book $book): string
    {
        return strtr(self::CHANGE_BOOK, ['{bookId}' => $book->id]);
    }
}