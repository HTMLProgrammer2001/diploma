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
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationsController extends Controller
{
    private $userRep, $publicationRep;

    public function __construct(UserRepositoryInterface $userRep, PublicationRepositoryInterface $publicationRep)
    {
        //sync to publication policy
        //$this->authorizeResource(Publication::class, 'publication');

        $this->userRep = $userRep;
        $this->publicationRep = $publicationRep;
    }

    public function paginate(Request $request){
        //create rules
        $rules = [];

        $rules[] = new HasAssociateRule('authors',
            new EqualRule('users.id', Auth::user()->id));

        if($request->input('title'))
            $rules[] = new LikeRule('title', $request->input('title'));

        if($request->input('start_date_of_publication'))
            $rules[] = new DateMoreRule('date_of_publication', $request->input('start_date_of_publication'));

        if($request->input('end_date_of_publication'))
            $rules[] = new DateLessRule('date_of_publication', $request->input('end_date_of_publication'));

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

    public function show()
    {
        return abort(404);
    }

    public function edit(Publication $publication)
    {
        $users = $this->userRep->getForCombo();

        return view('admin.profile.publications.edit', compact('users', 'publication'));
    }

    public function update(PublicationRequest $request, $publication_id)
    {
        //check if current user in authors
        if(!in_array($request->user()->id, $request->get('authors')))
            return back()->withErrors([
                'You cannot create publication if you aren\'t his author'
            ]);

        //create publication
        $data = $request->all();
        $this->publicationRep->update($publication_id, $data);

        return redirect()->route('profile.show');
    }

    public function destroy($publication_id)
    {
        $this->publicationRep->destroy($publication_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
