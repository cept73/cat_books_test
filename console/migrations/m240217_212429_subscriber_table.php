<?php
/** @noinspection PhpUnused */

use common\helpers\DbHelper;
use yii\db\Migration;

/**
 * Class m240217_212429_subscriber_table
 */
class m240217_212429_subscriber_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subscriber}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'phone' => $this->string()->notNull(),
        ], DbHelper::dbOptions());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240217_212429_subscriber_table cannot be reverted.\n";

        return false;
    }
}
