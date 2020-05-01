<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicationRequest;
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
        $users = User::all();

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
        $publication = new Publication();
        $publication->fill($request->all());

        $publication->date_of_publication = $request->get('date_of_publication');
        $publication->save();

        $publication->setAuthors($request->get('authors'));
        $publication->save();

        return redirect()->route('profile.show');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit(Publication $publication)
    {

        $users = User::all();

        return view('admin.profile.publications.edit', compact('users', 'publication'));
    }

    public function update(PublicationRequest $request, Publication $publication)
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

    public function destroy(Publication $publication)
    {
        $publication->delete();

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
