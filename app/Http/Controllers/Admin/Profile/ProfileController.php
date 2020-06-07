<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Commission;
use App\Department;
use App\Education;
use App\Http\Requests\ProfileUpdateRequest;
use App\Rank;
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
use App\Services\Storage\Interfaces\AvatarServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    private $departmentRep, $commissionRep, $rankRep, $qualificationRep, $internshipRep, $userRep,
            $publicationRep, $educationRep, $honorRep, $rebukeRep, $categoryRep;

    public function __construct(DepartmentRepositoryInterface $departmentRep,
                                CommissionRepositoryInterface $commissionRep,
                                RankRepositoryInterface $rankRep,
                                QualificationRepositoryInterface $qualificationRep,
                                InternshipRepositoryInterface $internshipRep,
                                PublicationRepositoryInterface $publicationRep,
                                EducationRepositoryInterface $educationRep,
                                HonorRepositoryInterface $honorRep,
                                RebukeRepositoryInterface $rebukeRep,
                                UserRepositoryInterface $userRep,
                                CategoryRepositoryInterface $categoryRep)
    {
        $this->departmentRep = $departmentRep;
        $this->commissionRep = $commissionRep;
        $this->rankRep = $rankRep;
        $this->qualificationRep = $qualificationRep;
        $this->internshipRep = $internshipRep;
        $this->userRep = $userRep;
        $this->publicationRep = $publicationRep;
        $this->educationRep = $educationRep;
        $this->honorRep = $honorRep;
        $this->rebukeRep = $rebukeRep;
        $this->categoryRep = $categoryRep;
    }

    public function index(Request $request){
        $user = $request->user();
        $publications = $this->publicationRep->paginateForUser($user->id);
        $internships = $this->internshipRep->paginateForUser($user->id);
        $qualifications = $this->qualificationRep->paginateForUser($user->id);
        $educations = $this->educationRep->paginateForUser($user->id);
        $honors = $this->honorRep->paginateForUser($user->id);
        $rebukes = $this->rebukeRep->paginateForUser($user->id);
        $categories = $this->categoryRep->getForCombo();

        $isProfile = true;

        $userQualification = $this->qualificationRep->getQualificationNameOf($user->id);
        $internshipHours = $this->internshipRep->getInternshipHoursOf(
            $this->internshipRep->getInternshipsFor($user->id)
        );
        $nextQualification = $this->qualificationRep->getNextQualificationDateOf($user->id);
        $qCategories = $this->qualificationRep->getQualificationNames();
        $qNames = Education::QUALIFICATIONS;

        return view('admin.profile.show.index',
            compact('user', 'publications', 'qualifications', 'internships', 'educations', 'honors',
                'rebukes', 'categories', 'qCategories', 'qNames', 'isProfile', 'userQualification',
                'internshipHours', 'nextQualification'));
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
        $user_id = $request->user()->id;

        $data = $request->all();
        $data['avatar'] = $request->file('avatar');
        $this->userRep->update($user_id, $data);

        return redirect()->route('profile.show');
    }
}
