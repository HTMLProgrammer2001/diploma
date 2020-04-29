<?php

namespace App\Http\Controllers\Admin;

use App\Commission;
use App\Department;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Rank;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function paginate(){
        $users = User::paginate(env('PAGINATE_SIZE', 10));

        return view('admin.users.paginate', compact('users'));
    }

    public function index()
    {
        $users = User::paginate(env('PAGINATE_SIZE', 10));
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $departments = Department::all();
        $commissions = Commission::all();
        $ranks = Rank::all();

        return view('admin.users.create', compact('departments', 'commissions', 'ranks'));
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
        $user->setRank($request->get('rank'));

        $user->uploadAvatar($request->file('avatar'));
        $user->save();

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        $publications = $user->publications()->paginate(env('PAGINATE_SIZE', 10));
        $internships = $user->internships()->paginate(env('PAGINATE_SIZE', 10));
        $qualifications = $user->qualifications()->paginate(env('PAGINATE_SIZE', 10));

        return view('admin.profile.show.index',
            compact('user', 'publications', 'internships', 'qualifications'));
    }

    public function edit(User $user)
    {
        $departments = Department::all();
        $commissions = Commission::all();
        $ranks = Rank::all();

        return view('admin.users.edit', compact('departments', 'commissions', 'user', 'ranks'));
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
        $user->setRank($request->get('rank'));

        $user->uploadAvatar($request->file('avatar'));

        $user->role = $request->get('role');
        $user->save();

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->remove();

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
