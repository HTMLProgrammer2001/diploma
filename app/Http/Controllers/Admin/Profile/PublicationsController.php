<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicationRequest;
use App\Publication;
use App\Repositories\Interfaces\PublicationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Rules\DateLessRule;
use App\Repositories\Rules\DateMoreRule;
use App\Repositories\Rules\EqualRule;
use App\Repositories\Rules\HasAssociateRule;
use App\Repositories\Rules\LikeRule;
use App\Repositories\Rules\SortRule;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationsController extends Controller
{
    private $userRep, $publicationRep;

    public function __construct(UserRepositoryInterface $userRep, PublicationRepositoryInterface $publicationRep)
    {
        //sync to publication policy
        $this->authorizeResource(Publication::class);

        $this->userRep = $userRep;
        $this->publicationRep = $publicationRep;
    }

    private function createRule(array $data): array{
        $rules = [];

        $rules[] = new HasAssociateRule('authors',
            new EqualRule('users.id', Auth::user()->id));

        if($data['title'] ?? false)
            $rules[] = new LikeRule('title', $data['title']);

        if($data['start_date_of_publication'] ?? false)
            $rules[] = new DateMoreRule('date_of_publication', $data['start_date_of_publication']);

        if($data['end_date_of_publication'] ?? false)
            $rules[] = new DateLessRule('date_of_publication', $data['end_date_of_publication']);

        if($data['sortID'] ?? false)
            $rules[] = new SortRule('id', $data['sortID'] == 1 ? 'ASC' : 'DESC');

        if($data['sortName'] ?? false)
            $rules[] = new SortRule('title', $data['sortName'] == 1 ? 'ASC' : 'DESC');

        if($data['sortDate'] ?? false)
            $rules[] = new SortRule('date_of_publication', $data['sortDate'] == 1 ? 'ASC' : 'DESC');

        return $rules;
    }

    public function paginate(Request $request){
        //create rules
        $rules = $this->createRule($request->input());
        $publications = $this->publicationRep->filterPaginate($rules);

        return view('admin.publications.paginate', [
            'publications' => $publications,
            'isProfile' => true
        ]);
    }

    public function index()
    {
        return abort(404);
    }

    public function create()
    {
        $curUser = Auth::user();
        $users = $this->userRep->getForCombo();

        return view('admin.profile.publications.create', compact('curUser', 'users'));
    }

    public function store(PublicationRequest $request)
    {
        //check if current user in authors
        if(!in_array($request->user()->id, $request->get('authors')))
            return back()->withErrors([
                'You cannot create publication if you aren\'t his author'
            ]);

        //create publication
        $data = $request->all();
        $this->publicationRep->create($data);

        return redirect()->route('profile.show');
    }

    public function show(Publication $publication)
    {
        return view('admin.publications.show', compact('publication'));
    }

    public function edit(Publication $publication)
    {
        $users = $this->userRep->getForCombo();

        return view('admin.profile.publications.edit', compact('users', 'publication'));
    }

    public function update(PublicationRequest $request, Publication $publication)
    {
        //check if current user in authors
        if(!in_array($request->user()->id, $request->get('authors')))
            return back()->withErrors([
                'You cannot create publication if you aren\'t his author'
            ]);

        //create publication
        $data = $request->all();
        $this->publicationRep->update($publication->id, $data);

        return redirect()->route('profile.show');
    }

    public function destroy(Publication $publication)
    {
        $this->publicationRep->destroy($publication->id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
