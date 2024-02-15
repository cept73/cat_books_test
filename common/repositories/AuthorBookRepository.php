<?php

namespace common\repositories;

use common\models\AuthorBook;
use common\models\Book;

class AuthorBookRepository
{
    public function isUserOwns($user, Book $book): bool
    {
        return AuthorBook::find()
            ->where(['author_id' => $user->id, 'book_id' => $book->id])
            ->exists();
    }
}