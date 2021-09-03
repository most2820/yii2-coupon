<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_comment}}`.
 */
class m210831_132130_create_category_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_comment}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category_comment}}');
    }
}
