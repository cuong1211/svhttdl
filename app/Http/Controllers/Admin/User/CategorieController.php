<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategorieRequest;
use App\Models\User\Categorie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

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
            ->paginate(10)->appends($request->all());

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
        $data = $request->validated();
        $categorie =  Categorie::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ]);
        if ($categorie) {
            return redirect()->route('admin.roles.index')->with([
                'icon' => 'success',
                'heading' => 'Success',
                'message' => 'Thêm loại tài khoản thành công',
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
        $data = $request->validated();
        $categorie = Categorie::findOrFail($id);

        $categorie->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ]);
        $queryParams = $request->except(array_keys($data));
        return redirect()->route('admin.roles.index', $queryParams)->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Cập nhật loại tài khoản thành công',
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
                'heading' => 'Error',
                'message' => 'Loại tài khoản này ko thể xóa bởi vì đang có tài khoản liên kết.',
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
