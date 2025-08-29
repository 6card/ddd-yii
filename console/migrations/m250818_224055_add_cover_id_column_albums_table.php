<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%albums}}`.
 */
class m250818_224055_add_cover_id_column_albums_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%albums}}', 'cover_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%albums}}', 'cover_id');
    }
}
