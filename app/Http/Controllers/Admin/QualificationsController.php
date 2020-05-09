<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QualificationRequest;
use App\Repositories\Interfaces\QualificationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Repositories\Rules\DateLessRule;
use App\Repositories\Rules\DateMoreRule;
use App\Repositories\Rules\EqualRule;
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

    public function paginate(Request $request){
        //create rules array
        $rules = [];

        //add rules
        if($request->input('user'))
            $rules[] = new EqualRule('user_id', $request->input('user'));

        if($request->input('category'))
            $rules[] = new EqualRule('name', $request->input('category'));

        if($request->input('start_date'))
            $rules[] = new DateMoreRule('date', $request->input('start_date'));

        if($request->input('end_date'))
            $rules[] = new DateLessRule('date', $request->input('end_date'));

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
