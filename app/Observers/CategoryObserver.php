<?php

namespace App\Observers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Support\Str;

class CategoryObserver
{
    public function __construct(
        public CategoryService $categoryService
    ) {
    }

    public function saving(Category $category): void
    {
        $category->title = Str::ucfirst($category->title);
        $category->slug = Str::slug($category->title);

        $this->categoryService->deleteCachedCategoriesForMenu();
    }

    public function saved(Category $category): void
    {
        $this->categoryService->cachedCategoriesForMenu();
    }

    public function deleted(Category $category): void
    {
        $this->categoryService->deleteCachedCategoriesForMenu();
    }
}
