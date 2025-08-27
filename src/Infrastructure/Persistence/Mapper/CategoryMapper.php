<?php

namespace App\Infrastructure\Persistence\Mapper;

use App\Domain\Model\Category\Category;
use App\Domain\Model\Category\CategoryId;
use App\Domain\Model\Category\CategoryTitle;
use App\Infrastructure\Persistence\ActiveRecord\CategoryAr;

class CategoryMapper
{
    public function toDomain(CategoryAr $categoryAr): Category
    {
        $categoryId = new CategoryId($categoryAr->id);
        $categoryTitle = new CategoryTitle($categoryAr->title);
        return new Category($categoryId, $categoryTitle);
    }

    public function toActiveRecord(Category $category): CategoryAr
    {
        $record = CategoryAr::findOne(['id' => $category->getId()]) ?: new CategoryAr();
        $record->id = $category->getId();
        $record->user_id = $category->getTitle();
        return $record;
    }
}
