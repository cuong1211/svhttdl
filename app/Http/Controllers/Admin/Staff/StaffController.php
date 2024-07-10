<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StaffRequest;
use App\Models\Staff\Department;
use App\Models\Staff\Position;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;
use Illuminate\View\View;


class StaffController extends Controller
{
    /**
     * Display a listing of the staff.
     */
    public function index(Request $request): View
    {
        $staffs = Staff::query()
            ->when(
                $request->search,
                fn ($query) => $query->where('name', 'like', '%' . $request->search . '%')
            )
            ->latest()
            ->get();

        return view('admin.staffs.staff.index', [
            'staffs' => $staffs,
        ]);
    }


    /**
     * Show the form for creating a new staff.
     */
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('admin.staffs.staff.create', compact('departments', 'positions'));
    }

    /**
     * Store a newly created staff in storage.
     */
    public function store(StaffRequest $request)
    {
        $data = $request->validated();

        $staff = Staff::create([
            'name' => $data['name'],
            'content' => $data['content'],
            'department_id' => $data['department_id'],
            'position_id' => $data['position_id'],
        ]);


        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $staff->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('staff_image');
        }

        return redirect()->route('admin.staffs.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Tạo nhân viên thành công',
        ]);
    }


    /**
     * Show the form for editing the specified staff.
     */
    public function edit(Staff $staff)
    {
        $departments = Department::all();
        $positions = Position::all();

        return view('admin.staffs.staff.edit', compact('staff', 'departments', 'positions'));
    }

    /**
     * Update the specified staff in storage.
     */
    public function update(StaffRequest $request, Staff $staff)
    {
        $data = $request->validated();
        $data = (object) $data;
        $staff->update([
            'name' => $data->name,
            'content' => $data->content,
            'department_id' => $data->department_id,
            'position_id' => $data->position_id,
        ]);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $staff->clearMediaCollection('staff_image');
            $staff->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('staff_image');
        }

        return redirect()->route('admin.staffs.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Sửa nhân viên thành công',
        ]);
    }

    /**
     * Remove the specified staff from storage.
     */
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return back()->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Xóa nhân viên thành công',
        ]);
    }
}
