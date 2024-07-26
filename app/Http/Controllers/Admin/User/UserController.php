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
            ->paginate(10)->appends($request->all());
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
        return view('admin.users.create', compact('departments', 'role'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        return redirect()->route('admin.users.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Thêm tài khoản thành công',
        ]);
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $departments = Department::all();
        // $positions = Position::all();
        $role = Categorie::query()->get();
        return view('admin.users.edit', compact('user', 'departments', 'role'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UserRequest $request, User $user)
    {


        // dd($request);
        $data = $request->validated();
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'state' => $data['state'],
            'department_id' => $data['department_id'],
            'category_id' => $data['category_id'],
            'display_name' => $data['display_name'],
            'password' => bcrypt($data['password']),
        ]);
        $queryParams = $request->except(array_keys($data));
        return redirect()->route('admin.users.index', $queryParams)->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Cập nhật tài khoản thành công',
        ]);
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Xóa tài khoản thành công',
        ]);
    }
}
