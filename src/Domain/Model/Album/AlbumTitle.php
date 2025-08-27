<?php

namespace App\Domain\Model\Album;

final class AlbumTitle
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new \DomainException('Album title cannot be empty.');
        }
        if (strlen($value) > 255) {
            throw new \DomainException('Album title cannot exceed 255 characters.');
        }
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(AlbumTitle $other): bool
    {
        return $this->value === $other->value;
    }
}
