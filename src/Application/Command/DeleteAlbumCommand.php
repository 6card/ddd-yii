<?php

namespace App\Application\Command;

class DeleteAlbumCommand
{
    public function __construct(
        public readonly int $id,
    ) {}
}
