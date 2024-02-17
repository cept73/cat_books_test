<?php

namespace common\repositories;

use common\models\Author;
use common\models\Book;
use yii\db\Expression;

class AuthorRepository
{
    /**
     * @return Book[]
     */
    public function getAuthorsList(): array
    {
        return Author::find()
            ->select([new Expression("CONCAT(last_name, ' ', first_name) full_name"), 'id'])
            ->orderBy(['last_name' => SORT_DESC])
            ->indexBy('id')
            ->column();
    }
}
