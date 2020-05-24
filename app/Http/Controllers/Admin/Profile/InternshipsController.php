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
use App\Repositories\Rules\SortAssociateRule;
use App\Repositories\Rules\SortRule;
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

    private function createRule(array $data): array {
        //create rules array
        $rules = [];

        //add rules
        $rules[] = new EqualRule('user_id', Auth::user()->id);

        if($data['category'] ?? false)
            $rules[] = new EqualRule('category_id', $data['category']);

        if($data['title'] ?? false)
            $rules[] = new LikeRule('title', $data['title']);

        if($data['start_date'] ?? false)
            $rules[] = new DateMoreRule('to', from_locale_date($data['start_date']));

        if($data['end_date'] ?? false)
            $rules[] = new DateLessRule('to', from_locale_date($data['end_date']));

        if($data['start_hours'] ?? false)
            $rules[] = new MoreEqualRule('hours', $data['start_hours']);

        if($data['end_hours'] ?? false)
            $rules[] = new LessEqualRule('hours', $data['end_hours']);

        if($data['sortID'] ?? false)
            $rules[] = new SortRule('id', $data['sortID'] == 1 ? 'ASC' : 'DESC');

        if($data['sortCategory'] ?? false)
            $rules[] = new SortAssociateRule(
                ['internship_categories', 'internship_categories.id', '=', 'internships.category_id'],
                'internships.*', 'internship_categories.name',
                $data['sortCategory'] == 1 ? 'ASC' : 'DESC');

        if($data['sortTitle'] ?? false)
            $rules[] = new SortRule('title', $data['sortTitle'] == 1 ? 'ASC' : 'DESC');

        if($data['sortHours'] ?? false)
            $rules[] = new SortRule('hours', $data['sortHours'] == 1 ? 'ASC' : 'DESC');

        if($data['sortDate'] ?? false)
            $rules[] = new SortRule('to', $data['sortDate'] == 1 ? 'ASC' : 'DESC');

        return $rules;
    }

    public function paginate(Request $request){
        $rules = $this->createRule($request->input());
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
