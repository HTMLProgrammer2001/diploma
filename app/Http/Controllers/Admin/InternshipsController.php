<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InternshipsRequest;
use App\InternCategory;
use App\Internship;
use App\Place;
use App\User;
use Illuminate\Http\Request;

class InternshipsController extends Controller
{
    public function paginate(){
        $internships = Internship::paginate(env('PAGINATE_SIZE', 10));

        return view('admin.internships.paginate', compact('internships'));
    }

    public function index()
    {
        $internships = Internship::paginate(env('PAGINATE_SIZE', 10));

        return view('admin.internships.index', compact('internships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = InternCategory::all();
        $places = Place::all();

        return view('admin.internships.create', compact('users', 'categories', 'places'));
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

        $internship->setCategory($request->get('category'));
        $internship->setUser($request->get('user'));
        $internship->setPlace($request->get('place'));

        $internship->save();

        return redirect()->route('internships.index');
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
        $users = User::all();
        $categories = InternCategory::all();
        $places = Place::all();

        return view('admin.internships.edit', compact('users', 'categories', 'places', 'internship'));
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
        $internship->setPlace($request->get('place'));
        $internship->setUser($request->get('user'));
        $internship->setCategory($request->get('category'));

        $internship->save();

        return redirect()->route('internships.index');
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

        return redirect()->route('internships.index');
    }
}
