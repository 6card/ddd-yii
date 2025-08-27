<?php

namespace App\Domain\Model\User;

class User
{
    private int $id;

    public static function reconstitute(int $id): self
    {
        return new self($id);
    }

    public function getId(): ?int {
        return $this->id;
    }
}
