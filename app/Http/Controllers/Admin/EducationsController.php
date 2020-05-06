<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EducationsRequest;
use App\Repositories\Interfaces\EducationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class EducationsController extends Controller
{
    private $educationRep, $userRep;

    public function __construct(EducationRepositoryInterface $educationRep, UserRepositoryInterface $userRep)
    {
        $this->educationRep = $educationRep;
        $this->userRep = $userRep;
    }

    public function paginate(){
        $educations = $this->educationRep->paginate();

        return view('admin.educations.paginate', compact('educations'));
    }

    public function index()
    {
        $educations = $this->educationRep->paginate();

        return view('admin.educations.index', compact('educations'));
    }

    public function create()
    {
        $users = $this->userRep->getForCombo();

        return view('admin.educations.create', compact('users'));
    }

    public function store(EducationsRequest $request)
    {
        //create education
        $data = $request->all();
        $this->educationRep->create($data);

        return redirect()->route('educations.index');
    }

    public function show()
    {
        return abort(404);
    }

    public function edit($education_id)
    {
        $education = $this->educationRep->getById($education_id);

        if(!$education)
            return abort(404);

        $users = $this->userRep->getForCombo();

        return view('admin.educations.edit', compact('education', 'users'));
    }

    public function update(EducationsRequest $request, $education_id)
    {
        $data = $request->all();
        $this->educationRep->update($education_id, $data);

        return redirect()->route('educations.index');
    }

    public function destroy($education_id)
    {
        $this->educationRep->destroy($education_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
