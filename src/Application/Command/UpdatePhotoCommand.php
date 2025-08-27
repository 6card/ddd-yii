<?php

namespace App\Application\Command;

class UpdatePhotoCommand
{
    public function __construct(
        public readonly int $id,
        public readonly int $albumId,
        public readonly string $filename,
        public readonly string $url,
    ) {}
}
