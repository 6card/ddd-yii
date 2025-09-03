<?php

namespace App\Application\Command;

class RemoveShareCommand
{
    public function __construct(
        public readonly int $id,
        public readonly int $albumId,
    ) {}
}
