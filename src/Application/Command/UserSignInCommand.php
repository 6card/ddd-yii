<?php

namespace App\Application\Command;

class UserSignInCommand
{
    public function __construct(
        public readonly string $email,
        public readonly string $password
    ) {}
}
