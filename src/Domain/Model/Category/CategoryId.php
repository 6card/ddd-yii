<?php

namespace App\Domain\Model\Category;

final class CategoryId
{
    private readonly int $id;

    public function __construct(int $id)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException('Category id cannot be empty.');
        }

        $this->id = $id;
    }

    public function toString(): string
    {
        return strval($this->id);
    }
}
