<?php

namespace App\Infrastructure\Persistence\Mapper;

use App\Domain\Model\Album\Album;
use App\Domain\Model\Album\AlbumTitle;
use App\Domain\Model\Photo\Photo;
use App\Infrastructure\Persistence\ActiveRecord\AlbumActiveRecord;
use App\Infrastructure\Persistence\ActiveRecord\PhotoActiveRecord;

class AlbumMapper
{
    public function toDomain(AlbumActiveRecord $record): Album
    {
        /** @var Photo[] $photos */
        $photos = [];
        foreach ($record->photos as $photoAr) {
            $photos[] = Photo::reconstitute(
                $photoAr->id,
                $photoAr->filename,
                $photoAr->url,
                (new \DateTimeImmutable)->setTimestamp($photoAr->created_at),
                (new \DateTimeImmutable)->setTimestamp($photoAr->updated_at)
            );
        }

        return Album::reconstitute(
            $record->id,
            new AlbumTitle($record->title),
            (new \DateTimeImmutable)->setTimestamp($record->date),
            $record->cover_id,
            $photos,
            (new \DateTimeImmutable)->setTimestamp($record->created_at),
            (new \DateTimeImmutable)->setTimestamp($record->updated_at)
        );
    }

    public function toActiveRecord(Album $album, AlbumActiveRecord $record): AlbumActiveRecord
    {
        if ($album->getId() > 0) {
            $record->id = $album->getId();
            $record->setIsNewRecord(false);
        }
        $record->title = (string)$album->getTitle();
        $record->date = $album->getDate()->getTimestamp();
        $record->cover_id = $album->getCoverId();
        // $record->created_at = $record->isNewRecord ? $album->getCreatedAt()->getTimestamp() : $record->created_at;
        $record->created_at = $album->getCreatedAt()->getTimestamp();
        $record->updated_at = $album->getUpdatedAt()->getTimestamp();

        $activeRecordPhotos = array_map([$this, 'toPhotoActiveRecord'], $album->getPhotos());
        $record->populateRelation('photos', $activeRecordPhotos);

        return $record;
    }

    private function toPhotoActiveRecord(Photo $photo): PhotoActiveRecord
    {
        $record = new PhotoActiveRecord();

        // Если entity имеет ID (существующая запись)
        if ($photo->getId() > 0) {
            $record->id = $photo->getId();
            $record->setIsNewRecord(false);
        }

        $record->filename = $photo->getFilename();
        $record->url = $photo->getUrl();
        // $record->created_at = $record->isNewRecord ? $photo->getCreatedAt()->getTimestamp() : $record->created_at;
        $record->created_at = $photo->getCreatedAt()->getTimestamp();
        $record->updated_at = $photo->getUpdatedAt()->getTimestamp();
        return $record;
    }
}
