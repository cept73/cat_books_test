<?php
/** @noinspection PhpUnused */

use common\helpers\DbHelper;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%author_book}}`.
 */
class m240213_173705_create_author_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author_book}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'book_id' => $this->integer()->notNull(),
        ], DbHelper::dbOptions());

        $this->createIndex('idx__author_book__author_id', '{{%author_book}}', 'author_id');

        $this->createIndex('idx__author_book__book_id', '{{%author_book}}', 'book_id');

        $this->addForeignKey(
            'fk__author_book__author_id',
            '{{%author_book}}',
            'author_id',
            '{{%author}}',
            'id'
        );

        $this->addForeignKey(
            'fk__author_book__book_id',
            '{{%author_book}}',
            'book_id',
            '{{%book}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author_book}}');
    }
}
