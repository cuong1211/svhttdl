<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
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
            ->with('parent')
            ->latest()
            ->paginate(10);
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
            ]
        );
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        // dd($data);
        $category = Category::create($request->all());

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
        ]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Cập nhật danh mục thành công',
        ]);
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->posts()->exists()) {
            return back()->with([
                'icon' => 'error',
                'heading' => 'Lỗi:',
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
