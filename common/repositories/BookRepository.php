<?php

namespace common\repositories;

use common\models\Book;

class BookRepository
{
    /**
     * @return Book[]
     */
    public function getActiveBooks(): array
    {
        return Book::find()->all();
    }

    public function getBookById(int $id): ?Book
    {
        /** @var ?Book $book */
        $book = Book::findOne(['id' => $id]);

        return $book;
    }
}
