<?php

namespace App\Infrastructure\Persistence\Mapper;

use App\Infrastructure\Persistence\ActiveRecord\AlbumActiveRecord;

class AlbumPersistencePack
{
    public array $photoIdsToDelete = [];

    public function __construct(public readonly AlbumActiveRecord $albumActiveRecord)
    {

    }
}
