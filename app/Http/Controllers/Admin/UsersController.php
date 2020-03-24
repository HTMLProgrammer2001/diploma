<?php

namespace App\Http\Controllers\Admin;

use App\Commission;
use App\Department;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $departments = Department::all();
        $commissions = Commission::all();

        return view('admin.users.create', compact('departments', 'commissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required',
           'surname' => 'required',
           'patronymic' => 'required',
           'email' => 'required|email|unique:users,email',
           'password' => 'required|confirmed|min:8',
           'avatar' => 'nullable|image',
           'department' => 'nullable|exists:departments,id',
           'commission' => 'nullable|exists:commissions,id'
        ]);

        $user = new User();
        $user->fill($request->all());
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));
        $user->save();

        return redirect()->route('users.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        $departments = Department::all();
        $commissions = Commission::all();

        return view('admin.users.edit', compact('departments', 'commissions', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'required',
            'email' => Rule::unique('users')->ignore($user->id),
            'password' => 'nullable|confirmed|min:8',
            'avatar' => 'nullable|image',
            'department' => 'nullable|exists:departments,id',
            'commission' => 'nullable|exists:commissions,id'
        ]);

        $user->fill($request->all());
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));
        $user->save();

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        //
    }
}
