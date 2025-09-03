<?php

namespace App\Infrastructure\Persistence\ActiveRecord;

use App\Infrastructure\Persistence\Mapper\UserMapper;

/**
 * @property int $id
 * @property int $email
 * @property int $password_hash
 */

class UserActiveRecord extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%users}}';
    }
}
