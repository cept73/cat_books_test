<?php
/** @noinspection PhpUnused */

namespace console\seeder\tables;

use diecoding\seeder\TableSeeder;
use common\models\Author;

/**
 * Handles the creation of seeder `Author::tableName()`.
 */
class AuthorTableSeeder extends TableSeeder
{
    // public $truncateTable = false;
    public $locale = 'ru_RU';

    const COUNT = BookTableSeeder::COUNT * AuthorBookTableSeeder::MAX_AUTHORS_COUNT;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        for ($i = 0; $i < self::COUNT; $i++) {
            $author = new Author();
            $author->setAttributes([
                'first_name' => $this->faker->firstName,
				'middle_name' => strtoupper($this->faker->randomLetter()) . '.',
				'last_name' => $this->faker->lastName,
            ]);

            if (!$author->validate()) {
                $i --;
                continue;
            }

            $this->insert(Author::tableName(), $author->getAttributes());
        }
    }
}