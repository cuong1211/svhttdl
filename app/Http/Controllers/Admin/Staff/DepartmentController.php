<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DepartmentRequest;
use App\Models\Staff\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(Request $request): View
    {
        $departments = Department::query()
            ->when(
                $request->search,
                fn ($query) => $query->where('name', 'like', '%' . $request->search . '%')
            )
            ->latest()
            ->get();

        return view('admin.staffs.departments.index', [
            'departments' => $departments,
        ]);
    }

    public function create(): View
    {
        $departments = Department::query()
            ->get();

        return view(
            'admin.staffs.departments.create',
            [
                'departments' => $departments,
            ]
        );
    }

    public function store(DepartmentRequest $request): RedirectResponse
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        $department = Department::updateOrCreate(
            ['name' => $request->name],
            $data
        );
        if ($department->wasRecentlyCreated) {
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
        $department = Department::findOrFail($id);

        return view('admin.staffs.departments.edit', compact('department'));
    }

    public function update(DepartmentRequest $request, $id): RedirectResponse
    {
        $department = Department::findOrFail($id);

        $department->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.departments.index')->with([
            'icon' => 'info',
            'heading' => 'Updated',
            'message' => 'Cập nhật phòng ban thành công',
        ]);
    }

    /**
     * Remove the specified Department only if it has no posts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);

        // Kiểm tra xem phòng ban có nhân viên nào không
        if ($department->staffs()->exists()) {
            return back()->with([
                'icon' => 'error',
                'heading' => 'Failed',
                'message' => trans('admin.alert.erro.department.deleted'),
            ]);
        }

        // Xóa phòng ban
        $department->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('admin.alert.deleted-success'),
        ]);
    }
}
