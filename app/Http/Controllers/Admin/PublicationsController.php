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
use App\Repositories\Rules\SortRule;
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

    private function createRule(array $data): array {
        $rules = [];

        if($data['title'] ?? false)
            $rules[] = new LikeRule('title', $data['title']);

        if($data['user'] ?? false)
            $rules[] = new HasAssociateRule('authors',
                new EqualRule('users.id', $data['user']));

        if($data['start_date_of_publication'] ?? false)
            $rules[] = new DateMoreRule('date_of_publication',
                $data['start_date_of_publication']);

        if($data['end_date_of_publication'] ?? false)
            $rules[] = new DateLessRule('date_of_publication',
                $data['end_date_of_publication']);

        if($data['sortID'] ?? false)
            $rules[] = new SortRule('id', $data['sortID'] == 1 ? 'ASC' : 'DESC');

        if($data['sortName'] ?? false)
            $rules[] = new SortRule('title', $data['sortName'] == 1 ? 'ASC' : 'DESC');

        if($data['sortDate'] ?? false)
            $rules[] = new SortRule('date_of_publication', $data['sortDate'] == 1 ? 'ASC' : 'DESC');

        return $rules;
    }

    public function paginate(Request $request){
        //create rules array
        $rules = $this->createRule($request->input());
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
        $publication = $this->publicationRep->getById($id);
        return view('admin.publications.show', compact('publication'));
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
