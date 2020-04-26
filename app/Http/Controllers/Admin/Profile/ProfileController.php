<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Commission;
use App\Department;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index(Request $request){
        $user = $request->user();
        $publications = $user->publications()->paginate(env('PAGINATE_SIZE', 10));
        $internships = $user->internships()->paginate(env('PAGINATE_SIZE', 10));
        $qualifications = $user->qualifications()->paginate(env('PAGINATE_SIZE', 10));

        return view('admin.profile.show', compact('user', 'publications', 'qualifications', 'internships'));
    }

    public function edit(Request $request){
        $user = $request->user();
        $departments = Department::all();
        $commissions = Commission::all();

        return view('admin.profile.update', compact('user', 'departments', 'commissions'));
    }

    public function update(ProfileUpdateRequest $request){
        $user = $request->user();

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
        $user->save();

        return redirect()->route('profile.show');
    }
}
