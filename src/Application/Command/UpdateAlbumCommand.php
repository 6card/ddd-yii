<?php

namespace App\Application\Command;

class UpdateAlbumCommand
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly \DateTimeImmutable $date,
    ) {}
}
