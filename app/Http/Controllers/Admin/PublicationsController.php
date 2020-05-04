<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PublicationRequest;
use App\Publication;
use App\Repositories\Interfaces\PublicationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicationsController extends Controller
{
    private $publicationRep, $userRep;

    public function __construct(PublicationRepositoryInterface $publicationRep,
                                UserRepositoryInterface $userRep)
    {
        $this->publicationRep = $publicationRep;
        $this->userRep = $userRep;
    }

    public function paginate(){
        $publications = $this->publicationRep->paginate();

        return view('admin.publications.paginate', compact('publications'));
    }

    public function index()
    {
        $publications = $this->publicationRep->paginate();

        return view('admin.publications.index', compact('publications'));
    }

    public function create()
    {
        $users = $this->userRep->getForCombo();

        return view('admin.publications.create', compact('users'));
    }

    public function store(PublicationRequest $request)
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
        $users = $this->userRep->getForCombo();

        return view('admin.publications.edit', compact('publication', 'users'));
    }

    public function update(PublicationRequest $request, Publication $publication)
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
