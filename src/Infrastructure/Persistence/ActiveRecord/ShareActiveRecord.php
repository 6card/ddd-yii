<?php

namespace App\Infrastructure\Persistence\ActiveRecord;

use App\Infrastructure\Persistence\Mapper\ShareMapper;

/**
 * @property int $id
 * @property int $album_id
 * @property string $uuid
 */

class ShareActiveRecord extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%shares}}';
    }
}
