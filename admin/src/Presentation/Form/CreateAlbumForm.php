<?php

namespace App\Presentation\Admin\Form;

use yii\base\Model;

class CreateAlbumForm extends Model
{
    public $title;
    public $date;
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;


    public function rules()
    {
        return [
            [['title', 'date'], 'required'],
            ['title', 'string', 'max' => 255],
            ['date', 'string'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название альбома',
            'date' => 'Дата сьемки',
            'imageFiles' => 'Фотографии для загрузки',
        ];
    }
}
