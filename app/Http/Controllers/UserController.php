<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->latest()->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|string|unique:users,employee_id',
            'name'        => 'required|string|max:255',
            'role_id'     => 'required|exists:roles,id',
            'email'       => 'required|email|unique:users,email',
            'joined_date' => 'required|date',
            'password'    => 'required|min:8|confirmed',
        ]);

        User::create([
            'employee_id' => $request->employee_id,
            'name'        => $request->name,
            'role_id'     => $request->role_id,
            'email'       => $request->email,
            'joined_date' => $request->joined_date,
            'password'    => Hash::make($request->password),
            'status'      => 'active',
        ]);

        return redirect('/users')->with('success', 'User Created Successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'role_id'   => 'required|exists:roles,id',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'left_date' => 'nullable|date|after_or_equal:joined_date',
        ]);

        $data = $request->except('password');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect('/users')->with('success', 'User Updated Successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users')->with('success', 'User Deleted Successfully');
    }
}