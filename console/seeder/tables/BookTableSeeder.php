<?php
/** @noinspection PhpUnused */

namespace console\seeder\tables;

use common\models\AuthorBook;
use diecoding\seeder\TableSeeder;
use common\models\Book;
use yii\helpers\StringHelper;

/**
 * Handles the creation of seeder `Book::tableName()`.
 */
class BookTableSeeder extends TableSeeder
{
    // public $truncateTable = false;
    public $locale = 'ru_RU';

    const COUNT = 9;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        for ($i = 0; $i < self::COUNT; $i ++) {
            $newBook = new Book();

            $newBook->setAttributes([
                'title' => StringHelper::mb_ucfirst($this->faker->realTextBetween(10, 20)),
                'year_publish' => $this->faker->year,
                'description' => $this->faker->realText(),
                'isbn' => $this->faker->isbn13(),
                'photo_cover' => $this->faker->imageUrl(),
            ]);

            if (!$newBook->validate()) {
                $i --;
                continue;
            }

            $this->insert(Book::tableName(), $newBook->getAttributes());
        }
    }
}
