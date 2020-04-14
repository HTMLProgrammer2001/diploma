<?php

namespace App\Http\Controllers\Admin;

use App\Commission;
use App\Department;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use App\Http\Controllers\Controller;
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

    public function store(UserCreateRequest $request)
    {
        //create user
        $user = new User();
        $user->fill($request->all());

        //generate secret values
        $user->generatePassword($request->get('password'));
        $user->cryptPassport($request->get('passport'));
        $user->cryptCode($request->get('code'));

        //relationships
        $user->setDepartment($request->get('department'));
        $user->setCommission($request->get('commission'));

        $user->uploadAvatar($request->file('avatar'));
        $user->save();

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('admin.profile.show', compact('user'));
    }

    public function edit(User $user)
    {
        $departments = Department::all();
        $commissions = Commission::all();

        return view('admin.users.edit', compact('departments', 'commissions', 'user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->validate($request, [
            'email' => Rule::unique('users')->ignore($user->id)
        ]);

        $user->fill($request->all());

        //generate secret values
        $user->generatePassword($request->get('password'));
        $user->cryptPassport($request->get('passport'));
        $user->cryptCode($request->get('code'));

        //relationships
        $user->setDepartment($request->get('department'));
        $user->setCommission($request->get('commission'));

        $user->uploadAvatar($request->file('avatar'));

        $user->role = $request->get('role');
        $user->save();

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->remove();

        return redirect()->route('users.index');
    }
}
