<?php

namespace App\Presentation\Admin\Form;

use App\Domain\Model\Album\Album;
use yii\base\Model;

class UpdateAlbumForm extends Model
{
    public $title;
    public $date;

    private Album $album;

    public function __construct(?Album $album = null, array $config = [])
    {
        if ($album) {
            $this->title = (string)$album->getTitle();
            $this->date = $album->getDate()->format('d.m.Y');

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
            [['title', 'date'], 'required'],
            ['title', 'string', 'max' => 255],
            ['date', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название альбома',
            'date' => 'Дата сьемки',
        ];
    }
}
