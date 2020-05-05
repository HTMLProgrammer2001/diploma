<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QualificationRequest;
use App\Qualification;
use App\Repositories\Interfaces\QualificationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use App\Http\Controllers\Controller;

class QualificationsController extends Controller
{
    private $qualificationRep, $userRep;

    public function __construct(QualificationRepositoryInterface $qualificationRep,
                                UserRepositoryInterface $userRep)
    {
        $this->qualificationRep = $qualificationRep;
        $this->userRep = $userRep;
    }

    public function paginate(){
        $qualifications = $this->qualificationRep->paginate();

        return view('admin.qualifications.paginate', compact('qualifications'));
    }

    public function index()
    {
        $qualifications = $this->qualificationRep->paginate();

        return view('admin.qualifications.index', compact('qualifications'));
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
        return abort(404);
    }

    public function edit(Qualification $qualification)
    {
        $users = $this->userRep->getForCombo();
        $qualificationNames = $this->qualificationRep->getQualificationNames();

        return view('admin.qualifications.edit', compact('qualification', 'users', 'qualificationNames'));
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
