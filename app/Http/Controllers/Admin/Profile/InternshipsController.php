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
    private $placeRep, $userRep, $categoryRep, $intershipRep;

    public function __construct(PlaceRepositoryInterface $placeRep,
                                UserRepositoryInterface $userRep,
                                CategoryRepositoryInterface $categoryRep,
                                InternshipRepositoryInterface $internshipRep)
    {
        $this->authorizeResource(Internship::class, 'internship');

        $this->userRep = $userRep;
        $this->placeRep = $placeRep;
        $this->categoryRep = $categoryRep;
        $this->intershipRep = $internshipRep;
    }

    public function paginate(){
        $user = Auth::user();
        $internships = $user->internships()->paginate(env('PAGINATE_SIZE', 10));

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
        $this->intershipRep->create($data);

        return redirect()->route('profile.show');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit(Internship $internship)
    {
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
        $this->intershipRep->update($internship_id, $data);

        return redirect()->route('profile.show');
    }

    public function destroy($internship_id)
    {
        $this->intershipRep->destroy($internship_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
