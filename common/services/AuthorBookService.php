<?php

namespace common\services;

use common\models\Author;
use common\models\AuthorBook;
use common\models\Book;
use Throwable;
use Yii;
use yii\db\Exception;
use yii\db\Expression;

class AuthorBookService
{
    /**
     * @param Book $book
     * @return bool
     * @throws Exception
     */
    public function updateAuthors(Book $book): bool
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            AuthorBook::deleteAll(['book_id' => $book->id]);
            if (!empty($book->_authors)) {
                foreach ($book->_authors as $authorId) {
                    $authorBook = new AuthorBook();
                    $authorBook->author_id = $authorId;
                    $authorBook->book_id = $book->id;

                    $authorBook->save();
                }
            }
        } catch (Throwable) {
            $transaction->rollBack();

            return false;
        }

        $transaction->commit();
        return true;
    }

    /**
     * @return array
     */
    public function getReport(): array
    {
         $authorIds = AuthorBook::find()
             ->select(['id', new Expression('COUNT(*) counter')])
             ->orderBy(['counter' => SORT_DESC])
             ->groupBy(['id'])
             ->limit(10)
             ->all();

         $authorsList = [];
         foreach ($authorIds as $authorId) {
             $authorsList[] = Author::findOne($authorId);
         }

         return $authorsList;
    }
}
