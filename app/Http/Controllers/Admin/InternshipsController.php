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
use App\Repositories\Rules\SortAssociateRule;
use App\Repositories\Rules\SortRule;
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

    private function createRule(array $data): array {
        $rules = [];

        //add rules
        if($data['user'] ?? false)
            $rules[] = new EqualRule('user_id', $data['user']);

        if($data['category'] ?? false)
            $rules[] = new EqualRule('category_id', $data['category']);

        if($data['title'] ?? false)
            $rules[] = new LikeRule('title', $data['title']);

        if($data['start_date'] ?? false)
            $rules[] = new DateMoreRule('to', $data['start_date']);

        if($data['end_date'] ?? false)
            $rules[] = new DateLessRule('to', $data['end_date']);

        if($data['start_hours'] ?? false)
            $rules[] = new MoreEqualRule('hours', $data['start_hours']);

        if($data['end_hours'] ?? false)
            $rules[] = new LessEqualRule('hours', $data['end_hours']);

        if($data['sortID'] ?? false)
            $rules[] = new SortRule('id', $data['sortID'] == 1 ? 'ASC' : 'DESC');

        if($data['sortUser'] ?? false)
            $rules[] = new SortAssociateRule(['users', 'users.id', '=', 'internships.user_id'], 'internships.*',
                'users.surname', $data['sortUser'] == 1 ? 'ASC' : 'DESC');

        if($data['sortCategory'] ?? false)
            $rules[] = new SortAssociateRule(
                ['internship_categories', 'internship_categories.id', '=', 'internships.category_id'],
                'internships.*', 'internship_categories.name', $data['sortCategory'] == 1 ? 'ASC' : 'DESC');

        if($data['sortName'] ?? false)
            $rules[] = new SortRule('title', $data['sortName'] == 1 ? 'ASC' : 'DESC');

        if($data['sortHours'] ?? false)
            $rules[] = new SortRule('hours', $data['sortHours'] == 1 ? 'ASC' : 'DESC');

        if($data['sortDate'] ?? false)
            $rules[] = new SortRule('to', $data['sortDate'] == 1 ? 'ASC' : 'DESC');

        return $rules;
    }

    public function paginate(Request $request){
        //create rules array
        $rules = $this->createRule($request->input());
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
