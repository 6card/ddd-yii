<?php

namespace App\Application\Command;

use App\Application\DTO\UploadedFileInfo;

/** @property UploadedFileInfo[] $photosData*/

class CreateAlbumCommand
{
    public function __construct(
        public readonly string $title,
        public readonly \DateTimeImmutable $date,
        public readonly array $photosData = []
    ) {}
}
