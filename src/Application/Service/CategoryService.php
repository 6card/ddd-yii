<?php

namespace App\Application\Service;

use App\Application\DTO\CreateCategoryDTO;
use App\Domain\Model\Category\Category;
use App\Domain\Model\Category\CategoryId;
use App\Domain\Model\Category\CategoryTitle;
use App\Domain\Repository\CategoryRepositoryInterface;

class CategoryService
{

    public function __construct(private CategoryRepositoryInterface $categoryRepository)
    {

    }

    public function createCategory(CreateCategoryDTO $dto)
    {
        $categoryId = new CategoryId("random");
        $categoryTitle = new CategoryTitle($dto->getTitle());
        $category = Category::create($categoryId, $categoryTitle);

        $this->categoryRepository->save($category);
    }
}
