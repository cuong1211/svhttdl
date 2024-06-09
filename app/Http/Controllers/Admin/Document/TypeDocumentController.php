<?php

namespace App\Http\Controllers\Admin\Document;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Document\TypeDocumentRequest;
use App\Models\Document\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TypeDocumentController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.documents.types.index', [
            'types' => Type::query()
                ->when(
                    $request->search,
                    fn ($query) => $query->where('title', 'like', '%' . $request->search . '%')
                )
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create(): View
    {
        $types = Type::query()
            ->get();

        return view(
            'admin.documents.types.create',
            [
                'types' => $types,
            ]
        );
    }
    public function store(TypeDocumentRequest $request): RedirectResponse
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        $type = Type::updateOrCreate(
            ['name' => $request->name],
            $data
        );
        if ($type->wasRecentlyCreated) {
            return back()->with([
                'icon' => 'success',
                'heading' => 'Thêm mới',
                'message' => trans('admin.alert.success'),
            ]);
        } else {
            return back()->with([
                'icon' => 'info',
                'heading' => 'Updated',
                'message' => trans('admin.alert.update'),
            ]);
        }
    }

    /**
     * @return RedirectResponse
     */
    public function edit($id): View
    {
        $type = Type::findOrFail($id);

        return view('admin.documents.types.edit', compact('type'));
    }

    public function update(TypeDocumentRequest $request, $id): RedirectResponse
    {
        $type = Type::findOrFail($id);

        $type->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.types.index')->with([
            'icon' => 'info',
            'heading' => 'Cập nhật',
            'message' => trans('admin.alert.update'),
        ]);
    }

    /**
     * Remove the specified type only if it has no posts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $type = Type::findOrFail($id);
        if ($type->documents()->exists()) {
            return back()->with([
                'icon' => 'error',
                'heading' => 'Lỗi',
                'message' => trans('admin.alert.erro.type.deleted'),
            ]);
        }
        $type->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('admin.alert.deleted-success'),
        ]);
    }
}
