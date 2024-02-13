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
}
