<?php
/** @noinspection PhpUnused */

namespace common\services;

use common\models\AuthorBook;
use common\models\Book;
use common\repositories\AuthorBookRepository;
use yii\web\User;

class AuthorBookService
{
    public function __construct(
        protected AuthorBookRepository $authorBookRepository
    ) {
    }

    public function setAuthor(Book $book, User $user): bool
    {
        if ($this->authorBookRepository->isUserOwns($user, $book)) {
            return true;
        }

        $authorBook = new AuthorBook();
        $authorBook->book_id = $book->id;
        $authorBook->author_id = $user->id;

        return $authorBook->save();
    }
}
