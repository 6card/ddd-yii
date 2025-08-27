<?php

namespace App\Presentation\Web\Form;

use App\Domain\Model\Album\Album;
use yii\base\Model;

class AddPhotosForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    private Album $album;

    public function __construct(?Album $album = null, array $config = [])
    {
        if ($album) {
            $this->album = $album;
        }
        parent::__construct($config);
    }

    public function getId(): ?int
    {
        if ($this->album !== null) {
            return $this->album->getId();
        }

        return null;
    }


    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    public function attributeLabels()
    {
        return [
            'imageFiles' => 'Фотографии для загрузки',
        ];
    }
}
