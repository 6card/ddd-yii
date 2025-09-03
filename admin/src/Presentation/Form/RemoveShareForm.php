<?php

namespace App\Presentation\Admin\Form;

use yii\base\Model;

class RemoveShareForm extends Model
{
    public $id;
    public $albumId;

    public function rules()
    {
        return [
            [['albumId', 'id'], 'required'],
            [['albumId', 'id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'ID' => 'ID share',
            'albumId' => 'ID альбома',
        ];
    }
}
