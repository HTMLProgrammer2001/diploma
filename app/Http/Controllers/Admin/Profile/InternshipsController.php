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
use App\Repositories\Rules\DateLessRule;
use App\Repositories\Rules\DateMoreRule;
use App\Repositories\Rules\EqualRule;
use App\Repositories\Rules\LessEqualRule;
use App\Repositories\Rules\LikeRule;
use App\Repositories\Rules\MoreEqualRule;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipsController extends Controller
{
    private $placeRep, $userRep, $categoryRep, $internshipRep;

    public function __construct(PlaceRepositoryInterface $placeRep,
                                UserRepositoryInterface $userRep,
                                CategoryRepositoryInterface $categoryRep,
                                InternshipRepositoryInterface $internshipRep)
    {
        $this->authorizeResource(Internship::class, 'internship');

        $this->userRep = $userRep;
        $this->placeRep = $placeRep;
        $this->categoryRep = $categoryRep;
        $this->internshipRep = $internshipRep;
    }

    public function paginate(Request $request){
        //create rules array
        $rules = [];

        //add rules
        $rules[] = new EqualRule('user_id', Auth::user()->id);

        if($request->input('category'))
            $rules[] = new EqualRule('category_id', $request->input('category'));

        if($request->input('title'))
            $rules[] = new LikeRule('title', $request->input('title'));

        if($request->input('start_date'))
            $rules[] = new DateMoreRule('to', $request->input('start_date'));

        if($request->input('end_date'))
            $rules[] = new DateLessRule('to', $request->input('end_date'));

        if($request->input('start_hours'))
            $rules[] = new MoreEqualRule('hours', $request->input('start_hours'));

        if($request->input('end_hours'))
            $rules[] = new LessEqualRule('hours', $request->input('end_hours'));

        $internships = $this->internshipRep->filterPaginate($rules);

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

    public function show(Internship $internship){
        return view('admin.internships.show', compact('internship'));
    }

    public function edit(Internship $internship)
    {
        if(!$internship)
            return abort(404);

        $places = $this->placeRep->getForCombo();
        $categories = $this->categoryRep->getForCombo();
        $users = $this->userRep->getForCombo();

        return view('admin.profile.internships.edit',
            compact('internship', 'places', 'users', 'categories'));
    }

    public function update(InternshipsRequest $request, Internship $internship)
    {
        $data = $request->all();
        $data['user'] = Auth::user()->id;
        $this->internshipRep->update($internship->id, $data);

        return redirect()->route('profile.show');
    }

    public function destroy(Internship $internship)
    {
        $this->internshipRep->destroy($internship->id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
