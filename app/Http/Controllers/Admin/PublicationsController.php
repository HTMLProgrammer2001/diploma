<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PublicationCreateRequest;
use App\Publication;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicationsController extends Controller
{
    public function paginate(){
        $publications = Publication::paginate(env('PAGINATE_SiZE', 10));

        return view('admin.publications.paginate', compact('publications'));
    }

    public function index()
    {
        $publications = Publication::paginate(env('PAGINATE_SIZE', 10));

        return view('admin.publications.index', compact('publications'));
    }

    public function create()
    {
        $users = User::all();

        return view('admin.publications.create', compact('users'));
    }

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

    public function show($id)
    {
        return abort(404);
    }

    public function edit(Publication $publication)
    {
        $users = User::all();

        return view('admin.publications.edit', compact('publication', 'users'));
    }

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

    public function destroy(Publication $publication)
    {
        $publication->delete();

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
