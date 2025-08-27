<?php

namespace App\Infrastructure\Persistence\ActiveRecord;

use App\Infrastructure\Persistence\Mapper\UserMapper;
use yii\db\ActiveQuery;

/**
 * @property int $id
 */

class UserActiveRecord extends \yii\db\ActiveRecord
{
    public function __construct(private readonly UserMapper $userMapper) {}

    public static function tableName()
    {
        return '{{%users}}';
    }
}
