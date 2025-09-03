<?php

namespace App\Domain\Model\Share;

class ShareUuid
{
    private string $value;
    public function __construct(?string $uuid = null)
    {
        $this->value = $uuid ?? $this->generateUuid();
    }

    private function generateUuid(): string
    {
        return bin2hex(random_bytes(16));
    }

    public function value(): string
    {
        return $this->value;
    }
}
