<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\QualificationRequest;
use App\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QualificationsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Qualification::class, 'qualification');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $curUser = Auth::user();
        $qualificationNames = Qualification::getQualificationNames();

        return view('admin.profile.qualifications.create',
            compact('curUser', 'qualificationNames'));
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

        $qualification->setUser($request->user()->id);
        $qualification->save();

        return redirect()->route('profile.show');
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
        return abort(404);
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
        return abort(404);
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

        return redirect()->route('profile.show');
    }
}
