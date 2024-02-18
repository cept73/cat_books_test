<?php
/** @noinspection PhpUnused */

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_notification_queue}}`.
 */
class m240218_073746_create_user_notification_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_notification_queue}}', [
            'id' => $this->primaryKey(),
            'object_class' => $this->string(64)->notNull(),
            'object_id' => $this->string(64)->notNull(),
            'to_phone' => $this->string(16)->notNull(),
            'status' => $this->smallInteger()->unsigned(),
            'response_text' => $this->string(),
            'response_code' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_notification_queue}}');
    }
}
