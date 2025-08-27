<?php

namespace App\Application\Command;

class SetCoverCommand
{
    public function __construct(
        public readonly int $id,
        public readonly int $albumId,
    ) {}
}
