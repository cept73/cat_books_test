<?php
/** @noinspection PhpUnused */

namespace console\seeder\tables;

use diecoding\seeder\TableSeeder;
use common\models\Book;
use yii\helpers\StringHelper;

/**
 * Handles the creation of seeder `Book::tableName()`.
 */
class BookTableSeeder extends TableSeeder
{
    public $locale = 'ru_RU';

    const COUNT = 9;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        for ($count = 0; $count < self::COUNT; $count ++) {
            $newBook = new Book();

            $title = StringHelper::mb_ucfirst($this->faker->realTextBetween(10, 20));
            $title = mb_substr($title, 0, -1);

            $newBook->setAttributes([
                'title' => $title,
                'year_publish' => $this->faker->year,
                'description' => $this->faker->realText(300),
                'isbn' => $this->faker->isbn13(),
                'photo_cover' => $this->faker->imageUrl(320, 200),
            ]);

            if (!$newBook->validate()) {
                $count --;
                continue;
            }

            $this->insert(Book::tableName(), $newBook->getAttributes());
        }
    }
}
