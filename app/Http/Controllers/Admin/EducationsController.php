<?php

namespace App\Http\Controllers\Admin;

use App\Education;
use App\Http\Controllers\Controller;
use App\Http\Requests\EducationsRequest;
use App\User;

class EducationsController extends Controller
{
    public function paginate(){
        $educations = Education::paginate(env('PAGINATE_SIZE', 10));

        return view('admin.educations.paginate', compact('educations'));
    }

    public function index()
    {
        $educations = Education::paginate(env('PAGINATE_SIZE', 10));

        return view('admin.educations.index', compact('educations'));
    }

    public function create()
    {
        $users = User::all();

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
        $users = User::all();

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
