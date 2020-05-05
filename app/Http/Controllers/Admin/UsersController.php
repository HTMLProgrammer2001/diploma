<?php

namespace App\Http\Controllers\Admin;

use App\Commission;
use App\Department;
use App\Http\Requests\UserRequest;
use App\Rank;
use App\Repositories\CommissionRepository;
use App\Repositories\Interfaces\CommissionRepositoryInterface;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\Interfaces\InternshipRepositoryInterface;
use App\Repositories\Interfaces\QualificationRepositoryInterface;
use App\Repositories\Interfaces\RankRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    private $commissionRep, $departmentRep, $rankRep, $userRep, $qualificationRep, $internshipRep;

    public function __construct(CommissionRepositoryInterface $commissionRep,
                                DepartmentRepositoryInterface $departmentRep,
                                RankRepositoryInterface $rankRep,
                                UserRepositoryInterface $userRep,
                                QualificationRepositoryInterface $qualificationRep,
                                InternshipRepositoryInterface $internshipRep)
    {
        $this->commissionRep = $commissionRep;
        $this->departmentRep = $departmentRep;
        $this->rankRep = $rankRep;
        $this->userRep = $userRep;
        $this->qualificationRep = $qualificationRep;
        $this->internshipRep = $internshipRep;
    }

    public function paginate(){
        $users = $this->userRep->paginate();

        return view('admin.users.paginate', compact('users'));
    }

    public function index()
    {
        $users = $this->userRep->paginate();
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $departments = $this->departmentRep->getForCombo();
        $commissions = $this->commissionRep->getForCombo();
        $ranks = $this->rankRep->getForCombo();

        return view('admin.users.create', compact('departments', 'commissions', 'ranks'));
    }

    public function store(UserRequest $request)
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
        $rebukes = $user->rebukes()->paginate(env('PAGINATE_SIZE', 10));
        $honors = $user->honors()->paginate(env('PAGINATE_SIZE', 10));
        $educations = $user->educations()->paginate(env('PAGINATE_SIZE', 10));

        $isProfile = false;

        $userQualification = $this->qualificationRep->getQualificationNameOf($user->id);
        $internshipHours = $this->internshipRep->getInternshipHoursOf($user->id);
        $nextQualification = $this->qualificationRep->getNextQualificationDateOf($user->id);

        return view('admin.profile.show.index',
            compact('user', 'publications', 'internships', 'qualifications', 'rebukes', 'honors',
                'educations', 'isProfile', 'userQualification', 'internshipHours', 'nextQualification'));
    }

    public function edit(User $user)
    {
        $departments = $this->departmentRep->getForCombo();
        $commissions = $this->commissionRep->getForCombo();
        $ranks = $this->rankRep->getForCombo();
        $roles = $this->userRep->getRoles();
        $pedagogicals = $this->userRep->getPedagogicalTitles();

        return view('admin.users.edit', compact('departments', 'commissions', 'user',
            'ranks', 'roles', 'pedagogicals'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->all());

        //generate secret values
        $user->generatePassword($request->get('password'));
        $user->cryptPassport($request->get('passport'));
        $user->cryptCode($request->get('code'));

        //relationships
        $user->setDepartment($request->get('department'));
        $user->setCommission($request->get('commission'));
        $user->setRank($request->get('rank'));

        //avatar
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
