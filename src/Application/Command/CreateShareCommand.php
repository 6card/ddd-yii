<?php

namespace App\Application\Command;

class CreateShareCommand
{
    public function __construct(
        public readonly int $albumId,
    ) {}
}
