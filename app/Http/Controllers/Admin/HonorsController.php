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
use Illuminate\Http\Request;

class HonorsController extends Controller
{
    private $honorRep, $userRep;

    public function __construct(HonorRepositoryInterface $honorRep, UserRepositoryInterface $userRep)
    {
        $this->honorRep = $honorRep;
        $this->userRep = $userRep;
    }

    public function paginate(Request $request){
        //create rules for filter
        $rules = [];

        if($request->input('user'))
            $rules[] = new EqualRule('user_id', $request->input('user'));

        if($request->input('name'))
            $rules[] = new LikeRule('title', $request->input('name'));

        if($request->input('start_date_presentation'))
            $rules[] = new DateMoreRule('date_presentation',
                $request->input('start_date_presentation'));

        if($request->input('end_date_presentation'))
            $rules[] = new DateLessRule('date_presentation',
                $request->input('end_date_presentation'));

        $honors = $this->honorRep->filterPaginate($rules);
        $isProfile = false;

        return view('admin.honors.paginate', compact('honors', 'isProfile'));
    }

    public function index()
    {
        $users = $this->userRep->getForCombo();
        $honors = $this->honorRep->paginate();

        return view('admin.honors.index', compact('honors', 'users'));
    }

    public function create()
    {
        $users = $this->userRep->getForCombo();

        return view('admin.honors.create', compact('users'));
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
        return abort(404);
    }

    public function edit($honor_id)
    {
        $honor = $this->honorRep->getById($honor_id);

        if(!$honor)
            return abort(404);

        $users = $this->userRep->getForCombo();
        return view('admin.honors.edit', compact('users', 'honor'));
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
