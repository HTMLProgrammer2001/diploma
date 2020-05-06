<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Repositories\Interfaces\CommissionRepositoryInterface;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\Interfaces\EducationRepositoryInterface;
use App\Repositories\Interfaces\HonorRepositoryInterface;
use App\Repositories\Interfaces\InternshipRepositoryInterface;
use App\Repositories\Interfaces\PublicationRepositoryInterface;
use App\Repositories\Interfaces\QualificationRepositoryInterface;
use App\Repositories\Interfaces\RankRepositoryInterface;
use App\Repositories\Interfaces\RebukeRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\AvatarServiceInterface;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    private $commissionRep, $departmentRep, $rankRep, $userRep, $qualificationRep, $internshipRep,
            $avatarService, $rebukeRep, $honorRep, $educationRep, $publicationRep;

    public function __construct(CommissionRepositoryInterface $commissionRep,
                                DepartmentRepositoryInterface $departmentRep,
                                RankRepositoryInterface $rankRep,
                                UserRepositoryInterface $userRep,
                                QualificationRepositoryInterface $qualificationRep,
                                InternshipRepositoryInterface $internshipRep,
                                RebukeRepositoryInterface $rebukeRep,
                                HonorRepositoryInterface $honorRepository,
                                PublicationRepositoryInterface $publicationRep,
                                EducationRepositoryInterface $educationRepository,
                                AvatarServiceInterface $avatarService)
    {
        $this->commissionRep = $commissionRep;
        $this->departmentRep = $departmentRep;
        $this->rankRep = $rankRep;
        $this->userRep = $userRep;
        $this->qualificationRep = $qualificationRep;
        $this->internshipRep = $internshipRep;
        $this->rebukeRep = $rebukeRep;
        $this->honorRep = $honorRepository;
        $this->educationRep = $educationRepository;
        $this->publicationRep = $publicationRep;
        $this->avatarService = $avatarService;
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
        $data = $request->all();
        $data['avatar'] = $request->file('avatar');
        $this->userRep->create($data);

        return redirect()->route('users.index');
    }

    public function show($user_id)
    {
        $user = $this->userRep->getById($user_id);

        if(!$user)
            return abort(404);

        $publications = $this->publicationRep->paginateForUser($user_id);
        $internships = $this->internshipRep->paginateForUser($user_id);
        $qualifications = $this->qualificationRep->paginateForUser($user_id);
        $rebukes = $this->rebukeRep->paginateForUser($user_id);
        $honors = $this->honorRep->paginateForUser($user_id);
        $educations = $this->educationRep->paginateForUser($user_id);

        $isProfile = false;

        $userQualification = $this->qualificationRep->getQualificationNameOf($user->id);
        $internshipHours = $this->internshipRep->getInternshipHoursOf($user->id);
        $nextQualification = $this->qualificationRep->getNextQualificationDateOf($user->id);

        return view('admin.profile.show.index',
            compact('user', 'publications', 'internships', 'qualifications', 'rebukes', 'honors',
                'educations', 'isProfile', 'userQualification', 'internshipHours', 'nextQualification'));
    }

    public function edit($user_id)
    {
        $user = $this->userRep->getById($user_id);

        if(!$user)
            return abort(404);

        $departments = $this->departmentRep->getForCombo();
        $commissions = $this->commissionRep->getForCombo();
        $ranks = $this->rankRep->getForCombo();
        $roles = $this->userRep->getRoles();
        $pedagogicals = $this->userRep->getPedagogicalTitles();

        return view('admin.users.edit', compact('departments', 'commissions', 'user',
            'ranks', 'roles', 'pedagogicals'));
    }

    public function update(UserRequest $request, $user_id)
    {
        $data = $request->all();
        $data['avatar'] = $request->file('avatar');
        $this->userRep->update($user_id, $data);

        return redirect()->route('users.index');
    }

    public function destroy($user_id)
    {
        $this->userRep->destroy($user_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
