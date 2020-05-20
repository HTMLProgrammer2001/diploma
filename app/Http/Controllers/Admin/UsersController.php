<?php

namespace App\Http\Controllers\Admin;

use App\Education;
use App\Http\Requests\UserRequest;
use App\Imports\UsersImport;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
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
use App\Http\Controllers\Controller;
use App\Repositories\Rules\EqualRule;
use App\Repositories\Rules\HasAssociateRule;
use App\Repositories\Rules\LikeRule;
use App\Repositories\Rules\RawRule;
use App\Repositories\Rules\SortRule;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    private $commissionRep, $departmentRep, $rankRep, $userRep, $qualificationRep, $internshipRep,
            $rebukeRep, $honorRep, $educationRep, $publicationRep, $categoryRep;

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
                                CategoryRepositoryInterface $categoryRep)
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
        $this->categoryRep = $categoryRep;
    }

    private function createRule(array $data): array {
        $rules = [];

        if($data['name'] ?? false)
            $rules[] = new RawRule('CONCAT_WS(" ", `name`, `surname`, `patronymic`) like ?',
                '%' . $data['name'] . '%');

        if($data['email'] ?? false)
            $rules[] = new LikeRule('email', $data['email']);

        if($data['commission'] ?? false)
            $rules[] = new EqualRule('commission_id', $data['commission']);

        if($data['department'] ?? false)
            $rules[] = new EqualRule('department_id', $data['department']);

        if($data['rank'] ?? false)
            $rules[] = new EqualRule('rank_id', $data['rank']);

        if($data['pedagogical'] ?? false)
            $rules[] = new LikeRule('pedagogical_title', $data['pedagogical']);

        if($data['category'] ?? false)
            $rules[] = new RawRule('(SELECT qualifications.name from qualifications 
                where qualifications.user_id = users.id order by date desc limit 0,1) = ?', $data['category']);

        if($data['sortID'] ?? false)
            $rules[] = new SortRule('id', $data['sortID'] == 1 ? 'ASC' : 'DESC');

        if($data['sortName'] ?? false)
            $rules[] = new SortRule('name', $data['sortName'] == 1 ? 'ASC' : 'DESC');

        if($data['sortEmail'] ?? false)
            $rules[] = new SortRule('email', $data['sortEmail'] == 1 ? 'ASC' : 'DESC');

        return $rules;
    }

    public function paginate(Request $request){
        //create rules
        $rules = $this->createRule($request->input());
        $users = $this->userRep->filterPaginate($rules);

        return view('admin.users.paginate', compact('users'));
    }

    public function index()
    {
        $users = $this->userRep->paginate();
        $pedagogicals = $this->userRep->getPedagogicalTitles();
        $commissions = $this->commissionRep->getForCombo();
        $departments = $this->departmentRep->getForCombo();
        $ranks = $this->rankRep->getForCombo();
        $categories = $this->qualificationRep->getQualificationNames();

        return view('admin.users.index', compact('users', 'pedagogicals', 'commissions',
            'departments', 'ranks', 'categories'));
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
        $categories = $this->categoryRep->getForCombo();

        $isProfile = false;

        $userQualification = $this->qualificationRep->getQualificationNameOf($user->id);
        $internshipHours = $this->internshipRep->getInternshipHoursOf($user->id);
        $nextQualification = $this->qualificationRep->getNextQualificationDateOf($user->id);
        $qCategories = $this->qualificationRep->getQualificationNames();
        $qNames = Education::QUALIFICATIONS;

        return view('admin.profile.show.index',
            compact('user', 'publications', 'internships', 'qualifications', 'rebukes', 'honors',
                'educations', 'isProfile', 'userQualification', 'internshipHours', 'nextQualification', 'categories',
                'qCategories', 'qNames'));
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
