<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategorieRequest;
use App\Models\User\Categorie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategorieController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Categorie::query()
            ->when(
                $request->search,
                fn ($query) => $query->where('name', 'like', '%' . $request->search . '%')
            )
            ->latest()
            ->get();

        return view('admin.users.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create(): View
    {
        $categories = Categorie::query()
            ->get();

        return view(
            'admin.users.categories.create',
            [
                'categories' => $categories,
            ]
        );
    }

    public function store(CategorieRequest $request): RedirectResponse
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        $Categorie = Categorie::updateOrCreate(
            ['name' => $request->name],
            $data
        );
        if ($categorie->wasRecentlyCreated) {
            return back()->with([
                'icon' => 'success',
                'heading' => 'Success',
                'message' => 'Thêm mới phòng ban thành công',
            ]);
        } else {
            return back()->with([
                'icon' => 'info',
                'heading' => 'Updated',
                'message' => 'Cập nhật phòng ban thành công',
            ]);
        }
    }

    public function edit($id): View
    {
        $categorie = Categorie::findOrFail($id);

        return view('admin.users.categories.edit', compact('categorie'));
    }

    public function update(CategorieRequest $request, $id): RedirectResponse
    {
        $categorie = Categorie::findOrFail($id);

        $categorie->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with([
            'icon' => 'info',
            'heading' => 'Updated',
            'message' => 'Cập nhật phòng ban thành công',
        ]);
    }

    /**
     * Remove the specified categorie only if it has no posts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        if ($categorie->users()->exists()) {
            return back()->with([
                'icon' => 'error',
                'heading' => 'Failed',
                'message' => 'categorie cannot be deleted because it has posts associated with it.',
            ]);
        }
        $categorie->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('Xóa thành công'),
        ]);
    }
}
