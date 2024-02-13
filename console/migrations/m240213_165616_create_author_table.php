<?php
/** @noinspection PhpUnused */

use common\helpers\DbHelper;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m240213_165616_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'middle_name' => $this->string(),
            'last_name' => $this->string(),
        ], DbHelper::dbOptions());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author}}');
    }
}
