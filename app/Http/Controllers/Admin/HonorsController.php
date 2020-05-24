<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HonorsRequest;
use App\Repositories\Interfaces\HonorRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Rules\DateLessRule;
use App\Repositories\Rules\DateMoreRule;
use App\Repositories\Rules\EqualRule;
use App\Repositories\Rules\LikeRule;
use App\Repositories\Rules\SortAssociateRule;
use App\Repositories\Rules\SortRule;
use Illuminate\Http\Request;

class HonorsController extends Controller
{
    private $honorRep, $userRep;

    public function __construct(HonorRepositoryInterface $honorRep, UserRepositoryInterface $userRep)
    {
        $this->honorRep = $honorRep;
        $this->userRep = $userRep;
    }

    private function createRule(array $data): array {
        $rules = [];

        if($data['user'] ?? false)
            $rules[] = new EqualRule('user_id', $data['user']);

        if($data['name'] ?? false)
            $rules[] = new LikeRule('title', $data['name']);

        if($data['start_date_presentation'] ?? false)
            $rules[] = new DateMoreRule('date_presentation', from_locale_date($data['start_date_presentation']));

        if($data['end_date_presentation'] ?? false)
            $rules[] = new DateLessRule('date_presentation', from_locale_date($data['end_date_presentation']));

        if($data['type'] ?? false)
            $rules[] = new EqualRule('type', $data['type']);

        if($data['sortID'] ?? false)
            $rules[] = new SortRule('id', $data['sortID'] == 1 ? 'ASC' : 'DESC');

        if($data['sortUser'] ?? false)
            $rules[] = new SortAssociateRule(['users', 'users.id', '=', 'honors.user_id'], 'honors.*',
                'users.surname', $data['sortUser'] == 1 ? 'ASC' : 'DESC');

        if($data['sortName'] ?? false)
            $rules[] = new SortRule('title', $data['sortName'] == 1 ? 'ASC' : 'DESC');

        if($data['sortDate'] ?? false)
            $rules[] = new SortRule('date_presentation',
                $data['sortDate'] == 1 ? 'ASC' : 'DESC');

        if($data['sortType'] ?? false)
            $rules[] = new SortRule('type',
                $data['sortType'] == 1 ? 'ASC' : 'DESC');

        return $rules;
    }

    public function paginate(Request $request){
        //create rules for filter
        $rules = $this->createRule($request->input());
        $honors = $this->honorRep->filterPaginate($rules);

        return view('admin.honors.paginate', compact('honors'));
    }

    public function index()
    {
        $users = $this->userRep->getForCombo();
        $honors = $this->honorRep->paginate();
        $types = $this->honorRep->getTypes();

        return view('admin.honors.index', compact('honors', 'users', 'types'));
    }

    public function create()
    {
        $users = $this->userRep->getForCombo();
        $types = $this->honorRep->getTypes();

        return view('admin.honors.create', compact('users', 'types'));
    }

    public function store(HonorsRequest $request)
    {
        //create new honor
        $data = $request->all();
        $this->honorRep->create($data);

        return redirect()->route('honors.index');
    }

    public function show($id)
    {
        $honor = $this->honorRep->getById($id);

        return view('admin.honors.show', compact('honor'));
    }

    public function edit($honor_id)
    {
        $honor = $this->honorRep->getById($honor_id);

        if(!$honor)
            return abort(404);

        $users = $this->userRep->getForCombo();
        $types = $this->honorRep->getTypes();
        return view('admin.honors.edit', compact('users', 'honor', 'types'));
    }

    public function update(HonorsRequest $request, $honor_id)
    {
        //edit honor
        $data = $request->all();
        $this->honorRep->update($honor_id, $data);

        return redirect()->route('honors.index');
    }

    public function destroy($honor_id)
    {
        $this->honorRep->destroy($honor_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
