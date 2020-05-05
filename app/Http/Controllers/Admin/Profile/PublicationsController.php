<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicationRequest;
use App\Publication;
use App\Repositories\Interfaces\PublicationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Auth;

class PublicationsController extends Controller
{
    private $userRep, $publicationRep;

    public function __construct(UserRepositoryInterface $userRep, PublicationRepositoryInterface $publicationRep)
    {
        //sync to publication policy
        $this->authorizeResource(Publication::class, 'publication');

        $this->userRep = $userRep;
        $this->publicationRep = $publicationRep;
    }

    public function paginate(){
        $user = Auth::user();
        $publications = $user->publications()->paginate(env('PAGINATE_SIZE', 10));

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

    public function show($id)
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
