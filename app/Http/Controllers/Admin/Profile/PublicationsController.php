<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\PublicationCreateRequest;
use App\Publication;
use App\User;
use Illuminate\Support\Facades\Auth;

class PublicationsController extends Controller
{
    public function __construct()
    {
        //sync to publication policy
        $this->authorizeResource(Publication::class, 'publication');
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

        return view('admin.profile.publications.create', compact('curUser', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublicationCreateRequest $request)
    {
        //check if current user in authors
        if(!in_array($request->user()->id, $request->get('authors')))
            return back()->withErrors([
                'You cannot create publication if you aren\'t his author'
            ]);

        //create publication
        $publication = new Publication();
        $publication->fill($request->all());

        $publication->date_of_publication = $request->get('date_of_publication');
        $publication->save();

        $publication->setAuthors($request->get('authors'));
        $publication->save();

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
    public function edit(Publication $publication)
    {

        $users = User::all();

        return view('admin.profile.publications.edit', compact('users', 'publication'));
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
        //check if current user in authors
        if(!in_array($request->user()->id, $request->get('authors')))
            return back()->withErrors([
                'You cannot create publication if you aren\'t his author'
            ]);

        $publication->fill($request->all());
        $publication->date_of_publication = $request->get('date_of_publication');
        $publication->setAuthors($request->get('authors'));

        $publication->save();

        return redirect()->route('profile.show');
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

        return redirect()->route('profile.show');
    }
}
