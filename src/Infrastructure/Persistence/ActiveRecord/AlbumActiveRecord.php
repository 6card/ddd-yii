<?php

namespace App\Infrastructure\Persistence\ActiveRecord;

use yii\db\ActiveQuery;

/**
 * @property int $id
 * @property string $title
 * @property int $date
 * @property ?int $cover_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $updated_at
 * @property PhotoActiveRecord[] $photos
 */

class AlbumActiveRecord extends \yii\db\ActiveRecord
{

    public function getPhotos(): ActiveQuery
    {
        return $this->hasMany(PhotoActiveRecord::class,  ['album_id' => 'id']);
    }

    public static function tableName()
    {
        return '{{%albums}}';
    }
}
