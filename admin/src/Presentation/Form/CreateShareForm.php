<?php

namespace App\Presentation\Admin\Form;

use yii\base\Model;

class CreateShareForm extends Model
{
    public $albumId;

    public function rules()
    {
        return [
            [['albumId'], 'required'],
            ['albumId', 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'albumId' => 'ID альбома',
        ];
    }
}
