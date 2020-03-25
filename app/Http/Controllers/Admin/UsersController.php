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
           'commission' => 'nullable|exists:commissions,id',
           'birthday' => 'nullable|date',
           'passport' => 'nullable',
           'code' => 'nullable'
        ]);

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
            'commission' => 'nullable|exists:commissions,id',
            'birthday' => 'nullable|date',
            'passport' => 'nullable',
            'code' => 'nullable',
            'role' => 'required|numeric|between:0, 50'
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
