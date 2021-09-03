<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_assignment}}`.
 */
class m210831_132117_create_category_assignment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_assignment}}', [
            'shop_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            '{{%fk-category_assignment-shop_id}}',
            '{{%category_assignment}}',
            'shop_id',
            '{{%shop}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%fk-category_assignment-category_id}}',
            '{{%category_assignment}}',
            'category_id',
            '{{%category}}',
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
            '{{%category_assignment-task-game_id}}',
            '{{%category_assignment}}'
        );

        $this->dropForeignKey(
            '{{%category_assignment-task-genre_id}}',
            '{{%category_assignment}}'
        );

        $this->dropTable('{{%category_assignment}}');
    }
}
