<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PublicationRequest;
use App\Repositories\Interfaces\PublicationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Repositories\Rules\DateLessRule;
use App\Repositories\Rules\DateMoreRule;
use App\Repositories\Rules\EqualRule;
use App\Repositories\Rules\HasAssociateRule;
use App\Repositories\Rules\LikeRule;
use Illuminate\Http\Request;

class PublicationsController extends Controller
{
    private $publicationRep, $userRep;

    public function __construct(PublicationRepositoryInterface $publicationRep,
                                UserRepositoryInterface $userRep)
    {
        $this->publicationRep = $publicationRep;
        $this->userRep = $userRep;
    }

    public function paginate(Request $request){
        //create rules array
        $rules = [];

        if($request->input('title'))
            $rules[] = new LikeRule('title', $request->input('title'));

        if($request->input('user'))
            $rules[] = new HasAssociateRule('authors',
                new EqualRule('users.id', $request->input('user')));

        if($request->input('start_date_of_publication'))
            $rules[] = new DateMoreRule('date_of_publication',
                $request->input('start_date_of_publication'));

        if($request->input('end_date_of_publication'))
            $rules[] = new DateLessRule('date_of_publication',
                $request->input('end_date_of_publication'));

        $publications = $this->publicationRep->filterPaginate($rules);

        return view('admin.publications.paginate', compact('publications'));
    }

    public function index()
    {
        $users = $this->userRep->getForCombo();
        $publications = $this->publicationRep->paginate();

        return view('admin.publications.index', compact('publications', 'users'));
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

    public function edit($publication_id)
    {
        $publication = $this->publicationRep->getById($publication_id);

        if(!$publication)
            return abort(404);

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
