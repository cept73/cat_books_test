<?php

namespace common\helpers;

use common\models\Book;

class BookHelper
{
    // TODO: Переделать
    public static function buttonsList(Book $book, bool $isLoggedIn)
    {
        return $isLoggedIn ? [
            'view' => \yii\helpers\Url::to('book/view', ['slug' => $book->slug]),
            'edit' => \yii\helpers\Url::to('book/edit', ['slug' => $book->slug]),
            'delete' => \yii\helpers\Url::to('book/delete', ['slug' => $book->slug]),
        ] : [
            'view' => \yii\helpers\Url::to('book/view', ['slug' => $book->slug]),
        ];
    }
}