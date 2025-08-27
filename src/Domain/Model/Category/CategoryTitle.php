<?php

namespace App\Domain\Model\Category;

final class CategoryTitle
{
    private readonly string $title;

    public function __construct(string $title)
    {
        if (empty($title)) {
            throw new \InvalidArgumentException('Category title cannot be empty.');
        }
        if (mb_strlen($title) > 255) {
            throw new \InvalidArgumentException('Category title cannot exceed 255 characters.');
        }
        $this->title = $title;
    }

    public function __toString(): string
    {
        return $this->title;
    }
}
