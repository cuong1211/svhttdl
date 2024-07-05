<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Staff\Department;
use App\Models\User;
use App\Models\User\Categorie;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the User.
     */
    public function index(Request $request)
    {
        $users = User::query()
            ->when(
                $request->search,
                fn ($query) => $query->where('name', 'like', '%' . $request->search . '%')
            )
            ->with('departments', 'categories')
            ->latest()
            ->get();
        // dd($users);
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $departments = Department::query()->get();
        $role = Categorie::query()->get();
        return view('admin.users.create', compact('departments','role'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(UserRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        $user = User::create($data);
        // $user->departments()->attach($request->departments);
        // if ($request->hasFile('image')) {
        //     $imageFile = $request->file('image');
        //     $user->addMedia($imageFile->getRealPath())
        //         ->usingFileName($imageFile->getClientOriginalName())
        //         ->usingName($imageFile->getClientOriginalName())
        //         ->toMediaCollection('user_image');
        // }

        return redirect()->route('admin.users.index')->with('success', 'Tạo tài khoản thành công.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $departments = Department::all();
        // $positions = Position::all();
        $role = Categorie::query()->get();
        return view('admin.users.edit', compact('user', 'departments','role'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        

        // dd($request);
        $data = $request->validated();
        $user->update($data);
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $user->clearMediaCollection('user_image');
            $user->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('user_image');
        }

        return redirect()->route('admin.users.index')->with('success', 'Cập nhập tài khoản thành công.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Xóa tài khoản thành công.');
    }
}
