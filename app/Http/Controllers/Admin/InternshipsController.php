<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InternshipsRequest;
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
use Illuminate\Http\Request;

class InternshipsController extends Controller
{
    private $categoryRep, $internshipRep, $userRep, $placeRep;

    public function __construct(CategoryRepositoryInterface $categoryRep,
                                InternshipRepositoryInterface $internshipRep,
                                UserRepositoryInterface $userRep,
                                PlaceRepositoryInterface $placeRep)
    {
        $this->categoryRep = $categoryRep;
        $this->internshipRep = $internshipRep;
        $this->userRep = $userRep;
        $this->placeRep = $placeRep;
    }

    public function paginate(Request $request){
        //create rules array
        $rules = [];

        //add rules
        if($request->input('user'))
            $rules[] = new EqualRule('user_id', $request->input('user'));

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

        return view('admin.internships.paginate', compact('internships'));
    }

    public function index()
    {
        $internships = $this->internshipRep->paginate();
        $users = $this->userRep->getForCombo();
        $categories = $this->categoryRep->getForCombo();

        return view('admin.internships.index', compact('internships', 'users', 'categories'));
    }

    public function create()
    {
        $users = $this->userRep->getForCombo();
        $categories = $this->categoryRep->getForCombo();
        $places = $this->placeRep->getForCombo();

        return view('admin.internships.create', compact('users', 'categories', 'places'));
    }

    public function store(InternshipsRequest $request)
    {
        //create internship
        $data = $request->all();
        $this->internshipRep->create($data);

        return redirect()->route('internships.index');
    }

    public function show($id)
    {
        $internship = $this->internshipRep->getById($id);

        return view('admin.internships.show', compact('internship'));
    }

    public function edit($internship_id)
    {
        $internship = $this->internshipRep->getById($internship_id);

        if(!$internship)
            return abort(404);

        $users = $this->userRep->getForCombo();
        $categories = $this->categoryRep->getForCombo();
        $places = $this->placeRep->getForCombo();

        return view('admin.internships.edit', compact('users', 'categories', 'places',
            'internship'));
    }

    public function update(InternshipsRequest $request, $internship_id)
    {
        //update internship
        $data = $request->all();
        $this->internshipRep->update($internship_id, $data);

        return redirect()->route('internships.index');
    }

    public function destroy($internship_id)
    {
        $this->internshipRep->destroy($internship_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
