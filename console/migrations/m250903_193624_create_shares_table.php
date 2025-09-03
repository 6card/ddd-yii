<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shares}}`.
 */
class m250903_193624_create_shares_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shares}}', [
            'id' => $this->primaryKey(),
            'album_id' => $this->integer()->notNull(),
            'uuid' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shares}}');
    }
}
