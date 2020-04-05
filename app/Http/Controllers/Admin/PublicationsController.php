<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PublicationCreateRequest;
use App\Publication;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publications = Publication::all();

        return view('admin.publications.index', compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        return view('admin.publications.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublicationCreateRequest $request)
    {
        $publication = new Publication();

        //fill
        $publication->fill($request->all());

        //set date
        $publication->date_of_publication = $request->get('date_of_publication');

        $publication->save();

        //set authors
        $publication->setAuthors($request->get('authors'));
        $publication->save();

        return redirect()->route('publications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $publication)
    {
        $users = User::all();

        return view('admin.publications.edit', compact('publication', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublicationCreateRequest $request, Publication $publication)
    {
        //fill
        $publication->fill($request->all());

        //set date
        $publication->date_of_publication = $request->get('date_of_publication');

        $publication->save();

        //set authors
        $publication->setAuthors($request->get('authors'));
        $publication->save();

        return redirect()->route('publications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        $publication->delete();

        return redirect()->route('publications.index');
    }
}
