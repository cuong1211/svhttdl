<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PositionRequest;
use App\Models\Staff\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PositionController extends Controller
{
    public function index(Request $request): View
    {
        $positions = Position::query()
            ->when(
                $request->search,
                fn ($query) => $query->where('name', 'like', '%' . $request->search . '%')
            )
            ->latest()
            ->paginate(10)->appends($request->all());

        return view('admin.staffs.positions.index', [
            'positions' => $positions,
        ]);
    }

    public function create(): View
    {
        $positions = Position::query()
            ->get();

        return view(
            'admin.staffs.positions.create',
            [
                'positions' => $positions,
            ]
        );
    }

    public function store(PositionRequest $request): RedirectResponse
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        $position = Position::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
        if ($position) {
            return redirect()->route('admin.positions.index')->with([
                'icon' => 'success',
                'heading' => 'Thêm mới',
                'message' => 'Thêm mới chức vụ thành công !',
            ]);
        }
    }

    public function edit($id): View
    {
        $position = Position::findOrFail($id);

        return view('admin.staffs.positions.edit', compact('position'));
    }

    public function update(PositionRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();
        $position = Position::findOrFail($id);

        $position->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
        $queryParams = $request->except(array_keys($data));
        return redirect()->route('admin.positions.index', $queryParams)->with([
            'icon' => 'success',
            'heading' => 'Thêm mới',
            'message' => ' Cập nhật chức vụ thành công',
        ]);
    }

    /**
     * Remove the specified Position only if it has no posts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        if ($position->staffs()->exists()) {
            return back()->with([
                'icon' => 'error',
                'heading' => 'Failed',
                'message' => trans('admin.alert.erro.position.deleted'),
            ]);
        }
        $position->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('admin.alert.deleted-success'),
        ]);
    }
}
