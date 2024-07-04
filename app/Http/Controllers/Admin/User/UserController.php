<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
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
            ->latest()
            ->get();
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'departments' => 'required|in:departments,id',
            'role' => 'required|in:categories,id',
        ]);

        $user = User::create($request->only(['name', 'content']));
        $user->departments()->attach($request->departments);
        $user->positions()->attach($request->positions);
        // if ($request->hasFile('image')) {
        //     $imageFile = $request->file('image');
        //     $user->addMedia($imageFile->getRealPath())
        //         ->usingFileName($imageFile->getClientOriginalName())
        //         ->usingName($imageFile->getClientOriginalName())
        //         ->toMediaCollection('user_image');
        // }

        return redirect()->route('admin.users.index')->with('success', 'user created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        // $departments = Department::all();
        // $positions = Position::all();

        return view('admin.users.user.edit', compact('user', 'departments', 'positions'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'departments' => 'required|array',
            'departments.*' => 'exists:departments,id',
        ]);

        $user->update($request->only(['name', 'content']));
        $user->departments()->sync($request->departments);
        $user->positions()->sync($request->positions);
        // dd($user);
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $user->clearMediaCollection('user_image');
            $user->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('user_image');
        }

        return redirect()->route('admin.users.index')->with('success', 'user updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->departments()->detach();
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'user deleted successfully.');
    }
}
