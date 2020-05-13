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
use App\Repositories\Rules\SortAssociateRule;
use App\Repositories\Rules\SortRule;
use Illuminate\Http\Request;

class RebukesController extends Controller
{
    private $rebukeRep, $userRep;

    public function __construct(RebukeRepositoryInterface $rebukeRep, UserRepositoryInterface $userRep)
    {
        $this->userRep = $userRep;
        $this->rebukeRep = $rebukeRep;
    }

    private function createRule(array $data): array {
        $rules = [];

        if($data['user'] ?? false)
            $rules[] = new EqualRule('user_id', $data['user']);

        if($data['name'] ?? false)
            $rules[] = new LikeRule('title', $data['name']);

        if($data['start_date_presentation'] ?? false)
            $rules[] = new DateMoreRule('date_presentation', $data['start_date_presentation']);

        if($data['end_date_presentation'] ?? false)
            $rules[] = new DateLessRule('date_presentation', $data['end_date_presentation']);

        if($data['sortID'] ?? false)
            $rules[] = new SortRule('id', $data['sortID'] == 1 ? 'ASC' : 'DESC');

        if($data['sortUser'] ?? false)
            $rules[] = new SortAssociateRule(['users', 'users.id', '=', 'rebukes.user_id'], 'rebukes.*',
                'users.surname', $data['sortUser'] == 1 ? 'ASC' : 'DESC');

        if($data['sortName'] ?? false)
            $rules[] = new SortRule('title', $data['sortName'] == 1 ? 'ASC' : 'DESC');

        if($data['sortDate'] ?? false)
            $rules[] = new SortRule('date_presentation',
                $data['sortDate'] == 1 ? 'ASC' : 'DESC');

        return $rules;
    }

    public function paginate(Request $request){
        //create rules for filter
        $rules = $this->createRule($request->input());
        $rebukes = $this->rebukeRep->filterPaginate($rules);

        return view('admin.rebukes.paginate', compact('rebukes'));
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
        $rebuke = $this->rebukeRep->getById($id);

        return view('admin.rebukes.show', compact('rebuke'));
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
