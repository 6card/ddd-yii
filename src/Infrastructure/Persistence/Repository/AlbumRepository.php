<?php

namespace App\Infrastructure\Persistence\Repository;

use App\Domain\Model\Album\Album;
use App\Infrastructure\Persistence\ActiveRecord\AlbumActiveRecord;
use App\Infrastructure\Persistence\ActiveRecord\PhotoActiveRecord;
use App\Infrastructure\Persistence\Mapper\AlbumMapper;

class AlbumRepository implements \App\Domain\Repository\AlbumRepositoryInterface
{
    public function __construct(private readonly AlbumMapper $albumMapper)
    {
    }

    // public function get(int $id): Album
    // {
    //     if(!$album = $this->findById($id)) {
    //         throw new NotFoundException('Album not found.');
    //     }
    //     return $album;
    // }

    public function save(Album $album): Album
    {
        $record = $album->getId() ? AlbumActiveRecord::find()->where(['id' => $album->getId()])->with('photos')->one() : new AlbumActiveRecord();
        if ($record === null) {
            throw new \RuntimeException('Album record not found for saving.');
        }

        $existingActiveRecordPhotoIds = array_map(fn($p) => $p->id, $record->photos); // Сначала записываем текущие сохраненные фото
        $record = $this->albumMapper->toActiveRecord($album, $record); // Затем обновляем запись

        if (!$record->save()) {
            throw new \RuntimeException('Failed to save album record: ' . json_encode($record->getErrors()));
        }

        if ($album->getId() === null) {
            $album->setId($record->id); // Обновляем ID доменной модели после сохнанения
        }

        $currentPhotoIds = []; // сюда сохраняем ID всех фотографий в альбоме
        foreach ($record->photos as $recordPhoto) {

            if ($recordPhoto->isNewRecord) {
                // $recordPhoto->album_id = $record->id;
                $recordPhoto->link('album', $record);
            } else if (!$recordPhoto->save()) {
                throw new \RuntimeException('Failed to save photo record: ' . json_encode($record->getErrors()));
            }

            $currentPhotoIds[] = $recordPhoto->id;
        }
        $photosToDeleteIds = array_diff($existingActiveRecordPhotoIds, $currentPhotoIds); // выясняем какие фоторграфии удалены
        if (!empty($photosToDeleteIds)) {
            PhotoActiveRecord::deleteAll(['id' => $photosToDeleteIds, 'album_id' => $album->getId()]);
        }

        return $this->albumMapper->toDomain($record);
    }

    public function findById(int $id): ?Album
    {
        $record = AlbumActiveRecord::find($id)->where(['id' => $id])->with('photos')->one();
        if (!$record) {
            return null;
        }
        return $this->albumMapper->toDomain($record);
    }

    public function remove(Album $album): void
    {
        if ($album->getId() === null) {
            throw new \RuntimeException('Cannot remove a album without an ID.');
        }

        $record = AlbumActiveRecord::findOne($album->getId());
        if ($record === null) {
            // Продукт уже не существует, ничего делать не нужно
            throw new \RuntimeException("Album with ID {$album->getId()} not found for removal.");
        }

        if (!$record->delete()) {
            throw new \RuntimeException('Failed to remove album: ' . json_encode($record->getErrors()));
        }
    }

    public function findAll(): array
    {
        $records = AlbumActiveRecord::find()->with('photos')->all();
        return array_map([$this->albumMapper, 'toDomain'], $records);
    }
}
