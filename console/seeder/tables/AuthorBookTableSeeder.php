<?php
/** @noinspection PhpUnused */

namespace console\seeder\tables;

use diecoding\seeder\TableSeeder;
use common\models\AuthorBook;
use common\models\Author;
use common\models\Book;

/**
 * Handles the creation of seeder `AuthorBook::tableName()`.
 */
class AuthorBookTableSeeder extends TableSeeder
{
    // public $truncateTable = false;
    // public $locale = 'en_US';

    const MAX_AUTHORS_COUNT = 3;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $booksIds = Book::find()->select('id')->column();
        $authorsIds = Author::find()->select('id')->column();

        foreach ($booksIds as $bookId) {
            for ($i = rand(1, self::MAX_AUTHORS_COUNT); $i > 0; $i --) {
                $authorToBook = new AuthorBook();
                $authorToBook->book_id = $bookId;
                $authorToBook->author_id = $this->faker->randomElement($authorsIds);

                if (!$authorToBook->validate()) {
                    $i ++;
                    continue;
                }

                $this->insert(AuthorBook::tableName(), $authorToBook->getAttributes());
            }
        }
    }
}
