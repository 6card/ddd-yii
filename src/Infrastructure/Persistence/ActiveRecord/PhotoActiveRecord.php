<?php

namespace App\Infrastructure\Persistence\ActiveRecord;

/**
 * @property int $id
 * @property int $album_id
 * @property string $filename
 * @property string $url
 * @property int $created_at
 * @property int $updated_at
 * @property Album $album
 */

class PhotoActiveRecord extends \yii\db\ActiveRecord
{
    public function getAlbum()
    {
        return $this->hasOne(AlbumActiveRecord::class, ['id' => 'album_id']);
    }

    public static function tableName()
    {
        return '{{%photos}}';
    }
}
