<?php

namespace App\Infrastructure\Persistence\Mapper;

use App\Domain\Model\Share\Share;
use App\Domain\Model\Share\ShareUuid;
use App\Infrastructure\Persistence\ActiveRecord\ShareActiveRecord;

class ShareMapper
{
    public function toDomain(ShareActiveRecord $record): Share
    {
        return Share::reconstitute(
            $record->id,
            $record->album_id,
            new ShareUuid($record->uuid)
        );
    }

    public function toActiveRecord(Share $share, ShareActiveRecord $record): ShareActiveRecord
    {
        $record->id = $share->getId();
        $record->album_id = $share->getAlbumId();
        $record->uuid = $share->getUuid()->value();
        return $record;
    }
}
