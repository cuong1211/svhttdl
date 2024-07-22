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
            ->paginate(10)->appends($request->all());

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
        $data = $request->validated();
        $department = Department::create([
            'name' => $data['name'],
            'type' => $data['type'], // Add this line
            'description' => $data['description'],
        ]);
        if ($department) {
            return redirect()->route('admin.departments.index')->with([
                'icon' => 'success',
                'heading' => 'Success',
                'message' => 'Thêm mới phòng ban thành công',
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
            'type' => $request->type, // Add this line
            'description' => $request->description,
        ]);

        return redirect()->route('admin.departments.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
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
        if ($department->users()->exists()) {
            return back()->with([
                'icon' => 'error',
                'heading' => 'Failed',
                'message' => 'Phòng ban này đang liên kết đến một tài khoản',
            ]);
        }
        if ($department->categories()->exists()) {
            return back()->with([
                'icon' => 'error',
                'heading' => 'Failed',
                'message' => 'Phòng ban này đang liên kết đến một danh mục',
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
