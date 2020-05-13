<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QualificationRequest;
use App\Repositories\Interfaces\QualificationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Repositories\Rules\DateLessRule;
use App\Repositories\Rules\DateMoreRule;
use App\Repositories\Rules\EqualRule;
use App\Repositories\Rules\SortAssociateRule;
use App\Repositories\Rules\SortRule;
use Illuminate\Http\Request;

class QualificationsController extends Controller
{
    private $qualificationRep, $userRep;

    public function __construct(QualificationRepositoryInterface $qualificationRep,
                                UserRepositoryInterface $userRep)
    {
        $this->qualificationRep = $qualificationRep;
        $this->userRep = $userRep;
    }

    private function createRule(array $data): array {
        $rules = [];

        //add rules
        if($data['user'] ?? false)
            $rules[] = new EqualRule('user_id', $data['user']);

        if($data['category'] ?? false)
            $rules[] = new EqualRule('name', $data['category']);

        if($data['start_date'] ?? false)
            $rules[] = new DateMoreRule('date', $data['start_date']);

        if($data['end_date'] ?? false)
            $rules[] = new DateLessRule('date', $data['end_date']);

        if($data['sortID'] ?? false)
            $rules[] = new SortRule('id', $data['sortID'] == 1 ? 'ASC' : 'DESC');

        if($data['sortUser'] ?? false)
            $rules[] = new SortAssociateRule(['users', 'users.id', '=', 'qualifications.user_id'],
                'qualifications.*', 'users.surname', $data['sortUser'] == 1 ? 'ASC' : 'DESC');

        if($data['sortCategory'] ?? false)
            $rules[] = new SortRule('name', $data['sortCategory'] == 1 ? 'ASC' : 'DESC');

        if($data['sortDate'] ?? false)
            $rules[] = new SortRule('date', $data['sortDate'] == 1 ? 'ASC' : 'DESC');

        return $rules;
    }

    public function paginate(Request $request){
        //create rules array
        $rules = $this->createRule($request->input());
        $qualifications = $this->qualificationRep->filterPaginate($rules);

        return view('admin.qualifications.paginate', compact('qualifications'));
    }

    public function index()
    {
        $qualifications = $this->qualificationRep->paginate();
        $users = $this->userRep->getForCombo();
        $categories = $this->qualificationRep->getQualificationNames();

        return view('admin.qualifications.index', compact('qualifications', 'categories', 'users'));
    }

    public function create()
    {
        $users = $this->userRep->getForCombo();
        $qualificationNames = $this->qualificationRep->getQualificationNames();

        return view('admin.qualifications.create', compact('users', 'qualificationNames'));
    }

    public function store(QualificationRequest $request)
    {
        //create qualification
        $data = $request->all();
        $this->qualificationRep->create($data);

        return redirect()->route('qualifications.index');
    }

    public function show($id)
    {
        $qualification = $this->qualificationRep->getById($id);

        return view('admin.qualifications.show', compact('qualification'));
    }

    public function edit($qualification_id)
    {
        $qualification = $this->qualificationRep->getById($qualification_id);

        if(!$qualification)
            return abort(404);

        $users = $this->userRep->getForCombo();
        $qualificationNames = $this->qualificationRep->getQualificationNames();

        return view('admin.qualifications.edit', compact('qualification', 'users',
            'qualificationNames'));
    }

    public function update(QualificationRequest $request, $qualification_id)
    {
        //edit qualification
        $data = $request->all();
        $this->qualificationRep->update($qualification_id, $data);

        return redirect()->route('qualifications.index');
    }

    public function destroy($qualification_id)
    {
        $this->qualificationRep->destroy($qualification_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
