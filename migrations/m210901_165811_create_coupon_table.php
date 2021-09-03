<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%coupon}}`.
 */
class m210901_165811_create_coupon_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%coupon}}', [
            'id' => $this->primaryKey(),
            'shop_id' => $this->integer(11)->notNull(),
            'name' => $this->string(180)->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'description' => $this->text(),
            'code' => $this->string(180)->defaultValue(null),
            'status' => $this->smallInteger()->defaultValue(10)->notNull(),
            'start_at' => $this->integer(),
            'end_at' => $this->integer(),
            'url' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            '{{%fk-coupon-shop_id}}',
            '{{%coupon}}',
            'shop_id',
            '{{%shop}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%coupon-task-shop_id}}',
            '{{%coupon}}'
        );

        $this->dropTable('{{%coupon}}');
    }
}
