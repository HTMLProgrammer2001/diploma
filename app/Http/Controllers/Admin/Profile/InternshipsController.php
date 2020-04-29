<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\InternshipsRequest;
use App\InternCategory;
use App\Internship;
use App\Place;
use App\User;
use Illuminate\Support\Facades\Auth;

class InternshipsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Internship::class, 'internship');
    }

    public function paginate(){
        $user = Auth::user();
        $internships = $user->internships()->paginate(env('PAGINATE_SIZE', 10));

        return view('admin.internships.paginate', [
            'internships' => $internships,
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
        $places = Place::all();
        $categories = InternCategory::all();

        return view('admin.profile.internships.create',
            compact('curUser', 'users', 'places', 'categories'));
    }

    public function store(InternshipsRequest $request)
    {
        $internship = new Internship();
        $internship->fill($request->all());

        $internship->from = $request->get('from');
        $internship->to = $request->get('to');

        $internship->setUser(Auth::user()->id);
        $internship->setCategory($request->get('category'));
        $internship->setPlace($request->get('place'));

        $internship->save();

        return redirect()->route('profile.show');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit(Internship $internship)
    {
        $places = Place::all();
        $categories = InternCategory::all();
        $users = User::all();

        return view('admin.profile.internships.edit',
            compact('internship', 'places', 'users', 'categories'));
    }

    public function update(InternshipsRequest $request, Internship $internship)
    {
        $internship->fill($request->all());

        $internship->from = $request->get('from');
        $internship->to = $request->get('to');
        $internship->save();

        $internship->setCategory($request->get('category'));
        $internship->setPlace($request->get('place'));

        $internship->save();

        return redirect()->route('profile.show');
    }

    public function destroy(Internship $internship)
    {
        $internship->delete();

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
