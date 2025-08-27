<?php

namespace App\Application\Command;

class ClearCoverCommand
{
    public function __construct(
        public readonly int $id,
    ) {}
}
