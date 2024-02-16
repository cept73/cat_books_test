<?php
/** @noinspection PhpUnused */

use common\helpers\DbHelper;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m240213_165742_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(256),
            'title' => $this->string(512),
            'year_publish' => $this->integer()->unsigned(),
            'description' => $this->text(),
            'isbn' => $this->string(18)->unique(),
            'photo_cover' => $this->string(512),
        ], DbHelper::dbOptions());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
}
