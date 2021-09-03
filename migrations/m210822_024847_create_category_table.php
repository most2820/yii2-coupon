<?php

declare(strict_types=1);

use yii\db\Migration;

class m210822_024847_create_category_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'status' => $this->smallInteger()->defaultValue(0)->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
