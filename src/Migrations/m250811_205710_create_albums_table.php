<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%albums}}`.
 */
class m250811_205710_create_albums_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%albums}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'date' => $this->integer(10)->notNull(),
            'created_at' => $this->integer(10)->notNull(),
            'updated_at' => $this->integer(10)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%albums}}');
    }
}
