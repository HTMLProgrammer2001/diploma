<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RebukesRequest;
use App\Repositories\Interfaces\RebukeRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Rules\DateLessRule;
use App\Repositories\Rules\DateMoreRule;
use App\Repositories\Rules\EqualRule;
use App\Repositories\Rules\LikeRule;
use Illuminate\Http\Request;

class RebukesController extends Controller
{
    private $rebukeRep, $userRep;

    public function __construct(RebukeRepositoryInterface $rebukeRep, UserRepositoryInterface $userRep)
    {
        $this->userRep = $userRep;
        $this->rebukeRep = $rebukeRep;
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

        $rebukes = $this->rebukeRep->filterPaginate($rules);
        $isProfile = false;

        return view('admin.rebukes.paginate', compact('rebukes', 'isProfile'));
    }

    public function index()
    {
        $rebukes = $this->rebukeRep->paginate();
        $users = $this->userRep->getForCombo();

        return view('admin.rebukes.index', compact('rebukes', 'users'));
    }

    public function create()
    {
        $users = $this->userRep->getForCombo();

        return view('admin.rebukes.create', compact('users'));
    }

    public function store(RebukesRequest $request)
    {
        $data = $request->all();
        $this->rebukeRep->create($data);

        return redirect()->route('rebukes.index');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit($rebuke_id)
    {
        $rebuke = $this->rebukeRep->getById($rebuke_id);

        if(!$rebuke)
            return abort(404);

        $users = $this->userRep->getForCombo();
        return view('admin.rebukes.edit', compact('users', 'rebuke'));
    }

    public function update(RebukesRequest $request, $rebuke_id)
    {
        $data = $request->all();
        $this->rebukeRep->update($rebuke_id, $data);

        return redirect()->route('rebukes.index');
    }

    public function destroy($rebuke_id)
    {
        $this->rebukeRep->destroy($rebuke_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
