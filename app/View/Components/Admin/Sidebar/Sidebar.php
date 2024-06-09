<?php

namespace App\View\Components\Admin\Sidebar;

use App\Services\CategoryService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public function __construct(
        public CategoryService $categoryService
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.sidebar.sidebar', [
            'categories' => $this->categoryService->getCachedCategoriesForMenu(),
        ]);
    }
}
