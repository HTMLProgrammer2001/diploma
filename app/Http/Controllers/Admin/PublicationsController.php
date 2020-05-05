<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PublicationRequest;
use App\Publication;
use App\Repositories\Interfaces\PublicationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
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
        //create publication
        $data = $request->all();
        $this->publicationRep->create($data);

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

    public function update(PublicationRequest $request, $publication_id)
    {
        //update
        $data = $request->all();
        $this->publicationRep->update($publication_id, $data);

        return redirect()->route('publications.index');
    }

    public function destroy($publication_id)
    {
        $this->publicationRep->destroy($publication_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
