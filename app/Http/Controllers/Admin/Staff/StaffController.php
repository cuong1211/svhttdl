<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            // 'department_id' => 'required|exists:departments,id',
            // 'position_id' => 'required|exists:positions,id',
        ]);

        $staff = Staff::create($request->only(['name', 'content', 'department_id', 'position_id']));


        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $staff->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('staff_image');
        }

        return redirect()->route('admin.staffs.index')->with('success', 'Staff created successfully.');
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
    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
        ]);

        $staff->update($request->only(['name', 'content']));
        $staff->departments()->sync($request->department_id);
        $staff->positions()->sync($request->position_id);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $staff->clearMediaCollection('staff_image');
            $staff->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('staff_image');
        }

        return redirect()->route('admin.staffs.index')->with('success', 'Staff updated successfully.');
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
            'message' => trans('admin.alert.deleted-success'),
        ]);
    }
}
