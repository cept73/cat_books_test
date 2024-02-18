<?php
/** @noinspection PhpUnused */

use common\helpers\DbHelper;
use yii\db\Migration;

/**
 * Class m240217_212429_create_subscriber_table
 */
class m240217_212429_create_subscriber_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subscriber}}', [
            'id' => $this->primaryKey(),
            'object_class' => $this->string(64)->notNull(),
            'object_id' => $this->string(64)->notNull(),
            'to_phone' => $this->string(16)->notNull(),
        ], DbHelper::dbOptions());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240217_212429_create_subscriber_table cannot be reverted.\n";

        return false;
    }
}
