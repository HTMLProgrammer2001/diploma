<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\InternshipsRequest;
use App\InternCategory;
use App\Internship;
use App\Place;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\InternshipRepositoryInterface;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Auth;

class InternshipsController extends Controller
{
    private $placeRep, $userRep, $categoryRep, $internshipRep;

    public function __construct(PlaceRepositoryInterface $placeRep,
                                UserRepositoryInterface $userRep,
                                CategoryRepositoryInterface $categoryRep,
                                InternshipRepositoryInterface $internshipRep)
    {
        //$this->authorizeResource(Internship::class, 'internship');

        $this->userRep = $userRep;
        $this->placeRep = $placeRep;
        $this->categoryRep = $categoryRep;
        $this->internshipRep = $internshipRep;
    }

    public function paginate(){
        $user_id = Auth::user()->id;
        $internships = $this->internshipRep->paginateForUser($user_id);

        return view('admin.internships.paginate', [
            'internships' => $internships,
            'isProfile' => true
        ]);
    }

    public function index()
    {
        return abort(404);
    }

    public function create()
    {
        $curUser = Auth::user();

        $users = $this->userRep->getForCombo();
        $places = $this->placeRep->getForCombo();
        $categories = $this->categoryRep->getForCombo();

        return view('admin.profile.internships.create',
            compact('curUser', 'users', 'places', 'categories'));
    }

    public function store(InternshipsRequest $request)
    {
        $data = $request->all();
        $data['user'] = Auth::user()->id;
        $this->internshipRep->create($data);

        return redirect()->route('profile.show');
    }

    public function show()
    {
        return abort(404);
    }

    public function edit($internship_id)
    {
        $internship = $this->internshipRep->getById($internship_id);

        if(!$internship)
            return abort(404);

        $places = $this->placeRep->getForCombo();
        $categories = $this->categoryRep->getForCombo();
        $users = $this->userRep->getForCombo();

        return view('admin.profile.internships.edit',
            compact('internship', 'places', 'users', 'categories'));
    }

    public function update(InternshipsRequest $request, $internship_id)
    {
        $data = $request->all();
        $data['user'] = Auth::user()->id;
        $this->internshipRep->update($internship_id, $data);

        return redirect()->route('profile.show');
    }

    public function destroy($internship_id)
    {
        $this->internshipRep->destroy($internship_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
