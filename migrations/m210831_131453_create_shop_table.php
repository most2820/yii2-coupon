<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop}}`.
 */
class m210831_131453_create_shop_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(180)->notNull(),
            'image' => $this->string()->defaultValue(null),
            'url' => $this->string()->defaultValue(null),
            'description' => $this->text()->defaultValue(null),
            'status' => $this->smallInteger()->defaultValue(10)->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop}}');
    }
}
