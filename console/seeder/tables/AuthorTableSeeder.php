<?php
/** @noinspection PhpUnused */

namespace console\seeder\tables;

use common\helpers\FakerHelper;
use diecoding\seeder\TableSeeder;
use common\models\Author;

/**
 * Handles the creation of seeder `Author::tableName()`.
 */
class AuthorTableSeeder extends TableSeeder
{
    public $locale = 'ru_RU';

    const COUNT = BookTableSeeder::COUNT * AuthorBookTableSeeder::MAX_AUTHORS_COUNT;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        for ($count = 0; $count < self::COUNT; $count++) {
            $author = new Author();
            $gender = FakerHelper::randomGender();

            $author->setAttributes([
                'first_name' => $this->faker->firstName($gender),
				'middle_name' => strtoupper($this->faker->randomLetter()) . '.',
				'last_name' => $this->faker->lastName($gender),
            ]);

            if (!$author->validate()) {
                $count --;
                continue;
            }

            $this->insert(Author::tableName(), $author->getAttributes());
        }
    }
}