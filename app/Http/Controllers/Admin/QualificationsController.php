<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QualificationRequest;
use App\Qualification;
use App\User;
use App\Http\Controllers\Controller;

class QualificationsController extends Controller
{
    public function paginate(){
        $qualifications = Qualification::paginate(env('PAGINATE_SIZE', 10));

        return view('admin.qualifications.paginate', compact('qualifications'));
    }

    public function index()
    {
        $qualifications = Qualification::paginate(env('PAGINATE_SIZE', 10));

        return view('admin.qualifications.index', compact('qualifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $qualificationNames = Qualification::getQualificationNames();

        return view('admin.qualifications.create', compact('users', 'qualificationNames'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QualificationRequest $request)
    {
        $qualification = new Qualification();
        $qualification->fill($request->all());

        $qualification->date = $request->get('date');
        $qualification->setUser($request->get('user'));

        $qualification->save();

        return redirect()->route('qualifications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Qualification $qualification)
    {
        $users = User::all();
        $qualificationNames = Qualification::getQualificationNames();

        return view('admin.qualifications.edit', compact('qualification', 'users', 'qualificationNames'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QualificationRequest $request, Qualification $qualification)
    {
        $qualification->fill($request->all());

        $qualification->date = $request->get('date');
        $qualification->setUser($request->get('user'));

        $qualification->save();

        return redirect()->route('qualifications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Qualification $qualification)
    {
        $qualification->delete();

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
