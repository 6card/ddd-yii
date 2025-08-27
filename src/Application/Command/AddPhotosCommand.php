<?php

namespace App\Application\Command;

use App\Application\DTO\UploadedFileInfo;

/** @property UploadedFileInfo[] $photosData*/

class AddPhotosCommand
{
    public function __construct(
        public readonly int $albumId,
        public readonly array $photosData = []
    ) {}
}
