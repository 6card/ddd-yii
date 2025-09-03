<?php

namespace App\Infrastructure\Persistence\Repository;

use App\Domain\Model\Share\Share;
use App\Domain\Repository\ShareRepositoryInterface;
use App\Infrastructure\Persistence\ActiveRecord\ShareActiveRecord;
use App\Infrastructure\Persistence\Mapper\ShareMapper;

class ShareRepository implements ShareRepositoryInterface
{
    public function __construct(private readonly ShareMapper $shareMapper) {}

    public function findById(int $id): ?Share
    {
        $record = ShareActiveRecord::findOne($id);
        if (!$record) {
            return null;
        }
        return $this->shareMapper->toDomain($record);
    }

    /** @return Share[] */
    public function findByAlbumId(int $albumId): array
    {
        $records = ShareActiveRecord::findAll(['album_id' => $albumId]);
        if (empty($records)) {
            return [];
        }
        return array_map([$this->shareMapper, 'toDomain'], $records);
    }

    public function findByUuid(string $uuid): ?Share
    {
        $record = ShareActiveRecord::findOne(['uuid' => $uuid]);
        if (!$record) {
            return null;
        }
        return $this->shareMapper->toDomain($record);
    }

    public function save(Share $share): Share
    {
        $record = $share->getId() ? ShareActiveRecord::findOne(['id' => $share->getId()]) : new ShareActiveRecord();
        if ($record === null) {
            throw new \RuntimeException('Share record not found for saving.');
        }

        $record = $this->shareMapper->toActiveRecord($share, $record); // Затем обновляем запись

        if (!$record->save()) {
            throw new \RuntimeException('Failed to save share record: ' . json_encode($record->getErrors()));
        }

        return $this->shareMapper->toDomain($record);
    }

    public function remove(Share $share): void
    {
        $record = ShareActiveRecord::findOne($share->getId());
        if ($record === null) {
            // Продукт уже не существует, ничего делать не нужно
            throw new \RuntimeException("Share link with ID {$share->getId()} not found for removal.");
        }

        if (!$record->delete()) {
            throw new \RuntimeException('Failed to remove album: ' . json_encode($record->getErrors()));
        }
    }
}
