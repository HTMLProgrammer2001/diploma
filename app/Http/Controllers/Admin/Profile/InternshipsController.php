<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\InternshipsRequest;
use App\InternCategory;
use App\Internship;
use App\Place;
use App\User;
use Illuminate\Support\Facades\Auth;

class InternshipsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Internship::class, 'internship');
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

        $users = User::all();
        $places = Place::all();
        $categories = InternCategory::all();

        return view('admin.profile.internships.create',
            compact('curUser', 'users', 'places', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InternshipsRequest $request)
    {
        $internship = new Internship();
        $internship->fill($request->all());

        $internship->from = $request->get('from');
        $internship->to = $request->get('to');

        $internship->setUser(Auth::user()->id);
        $internship->setCategory($request->get('category'));
        $internship->setPlace($request->get('place'));

        $internship->save();

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
    public function edit(Internship $internship)
    {
        $places = Place::all();
        $categories = InternCategory::all();
        $users = User::all();

        return view('admin.profile.internships.edit',
            compact('internship', 'places', 'users', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InternshipsRequest $request, Internship $internship)
    {
        $internship->fill($request->all());

        $internship->from = $request->get('from');
        $internship->to = $request->get('to');
        $internship->save();

        $internship->setCategory($request->get('category'));
        $internship->setPlace($request->get('place'));

        $internship->save();

        return redirect()->route('profile.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Internship $internship)
    {
        $internship->delete();

        return redirect()->route('profile.show');
    }
}
