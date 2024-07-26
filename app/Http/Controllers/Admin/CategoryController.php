<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\Staff\Department;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        public CategoryService $categoryService
    ) {
    }

    public function index(Request $request): View
    {
        $categories = Category::query()
            ->when(
                $request->search,
                fn ($query) => $query->where('title', 'like', '%' . $request->search . '%')
            )
            ->with('parent', 'department')
            ->latest()
            ->paginate(10)->appends($request->all());;
        // dd($categories);
        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create(): View
    {
        return view(
            'admin.categories.create',
            [
                'categories' => $this->categoryService->cachedCategoriesForMenu(),
                'departments' => Department::query()->pluck('id', 'name')
            ]
        );
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        // dd($data);
        $category = Category::create([
            'title' => $data['title'],
            'title_en' => $data['title_en'],
            'in_menu' => $data['in_menu'],
            'parent_id' => $data['parent_id'],
            'user_id' => $data['user_id'],
            'department_id' => $data['department_id'],
        ]);

        return redirect()->route('admin.categories.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Thêm mới danh mục thành công',
        ]);
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', [
            'categories' => $this->categoryService->cachedCategoriesForMenu(),
            'selectedCategory' => $category,
            'departments' => Department::query()->pluck('id', 'name')
        ]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();
        $category->update([
            'title' => $data['title'],
            'title_en' => $data['title_en'],
            'order' => $data['order'],
            'in_menu' => $data['in_menu'],
            'parent_id' => $data['parent_id'],
            'user_id' => $data['user_id'],
            'department_id' => $data['department_id'],
        ]);
        $queryParams = $request->except(array_keys($data));
        return redirect()->route('admin.categories.index', $queryParams)->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Cập nhật danh mục thành công',
        ]);
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->children()->exists()) {
            return back()->with([
                'icon' => 'error',
                'heading' => 'Error',
                'message' => 'Danh mục không thể xóa bởi có danh mục khác liên kết với danh mục này',
            ]);
        }
        if ($category->posts()->exists()) {
            return back()->with([
                'icon' => 'error',
                'heading' => 'Error',
                'message' => 'Danh mục không thể xóa bởi có bài viết bên trong danh mục này',
            ]);
        }
        $category->delete();
        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('Xóa thành công'),
        ]);
    }
}
