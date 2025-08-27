<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%photos}}`.
 */
class m250812_233718_create_photos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%photos}}', [
            'id' => $this->primaryKey(),
            'album_id' => $this->integer()->notNull(),
            'filename' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'created_at' => $this->integer(10)->notNull(),
            'updated_at' => $this->integer(10)->notNull(),
        ]);

        $this->addForeignKey(
            'fk-photos-album_id',
            '{{%photos}}',
            'album_id',
            '{{%albums}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-photos-album_id', '{{%photos}}');
        $this->dropTable('{{%photos}}');
    }
}
