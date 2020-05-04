<?php

namespace App\Http\Controllers\Admin;

use App\Education;
use App\Http\Controllers\Controller;
use App\Http\Requests\EducationsRequest;
use App\Repositories\Interfaces\EducationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

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
        $education = new Education();

        //fill values
        $education->fill($request->all());
        //set teacher
        $education->setUser($request->get('user'));

        $education->save();

        return redirect()->route('educations.index');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit(Education $education)
    {
        $users = $this->userRep->getForCombo();

        return view('admin.educations.edit', compact('education', 'users'));
    }

    public function update(EducationsRequest $request, Education $education)
    {
        $education->fill($request->all());

        $education->setUser($request->get('user'));
        $education->save();

        return redirect()->route('educations.index');
    }

    public function destroy(Education $education)
    {
        $education->delete();

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
