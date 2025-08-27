<?php

namespace App\Domain\Repository;

use App\Domain\Model\Category\Category;
use App\Domain\Model\Category\CategoryId;

interface CategoryRepositoryInterface
{
    public function save(Category $category): void;
    public function findById(CategoryId $categoryId): ?Category;
}
