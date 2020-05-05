<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Commission;
use App\Department;
use App\Http\Requests\ProfileUpdateRequest;
use App\Rank;
use App\Repositories\Interfaces\CommissionRepositoryInterface;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\Interfaces\InternshipRepositoryInterface;
use App\Repositories\Interfaces\QualificationRepositoryInterface;
use App\Repositories\Interfaces\RankRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    private $departmentRep, $commissionRep, $rankRep, $qualificationRep, $internshipRep;

    public function __construct(DepartmentRepositoryInterface $departmentRep,
                                CommissionRepositoryInterface $commissionRep,
                                RankRepositoryInterface $rankRep,
                                QualificationRepositoryInterface $qualificationRep,
                                InternshipRepositoryInterface $internshipRep)
    {
        $this->departmentRep = $departmentRep;
        $this->commissionRep = $commissionRep;
        $this->rankRep = $rankRep;
        $this->qualificationRep = $qualificationRep;
        $this->internshipRep = $internshipRep;
    }

    public function index(Request $request){
        $user = $request->user();
        $publications = $user->publications()->paginate(env('PAGINATE_SIZE', 10));
        $internships = $user->internships()->paginate(env('PAGINATE_SIZE', 10));
        $qualifications = $user->qualifications()->paginate(env('PAGINATE_SIZE', 10));
        $educations = $user->educations()->paginate(env('PAGINATE_SIZE', 10));
        $honors = $user->honors()->paginate(env('PAGINATE_SIZE', 10));
        $rebukes = $user->rebukes()->paginate(env('PAGINATE_SIZE', 10));

        $isProfile = true;

        $userQualification = $this->qualificationRep->getQualificationNameOf($user->id);
        $internshipHours = $this->internshipRep->getInternshipHoursOf($user->id);
        $nextQualification = $this->qualificationRep->getNextQualificationDateOf($user->id);

        return view('admin.profile.show.index',
            compact('user', 'publications', 'qualifications', 'internships', 'educations', 'honors',
                'rebukes', 'isProfile', 'userQualification', 'internshipHours', 'nextQualification'));
    }

    public function edit(Request $request){
        $user = $request->user();
        $departments = $this->departmentRep->getForCombo();
        $commissions = $this->commissionRep->getForCombo();
        $ranks = $this->rankRep->getForCombo();

        return view('admin.profile.update', compact('user', 'departments', 'commissions',
            'ranks'));
    }

    public function update(ProfileUpdateRequest $request){
        $user = $request->user();

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

        return redirect()->route('profile.show');
    }
}
