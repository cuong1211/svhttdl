<?php

namespace App\View\Components\Admin\Sidebar;

use App\Services\CategoryService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category as Catemodel;

class Sidebar extends Component
{
    public function __construct(
        public CategoryService $categoryService
    ) {
    }

    public function render(): View|Closure|string
    {
        $user_department = auth()->user()->department_id;
        $menu = Catemodel::query()->where('department_id', $user_department)
            ->with('children')
            ->where('in_menu', true)
            ->orderBy('order')->get();
        return view('components.admin.sidebar.sidebar', [
            'categories' => $this->categoryService->getCachedCategoriesForMenu(),
            'menu' => $menu,
        ]);
    }
}
