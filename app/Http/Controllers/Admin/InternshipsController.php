<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InternshipsRequest;
use App\InternCategory;
use App\Internship;
use App\Place;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\InternshipRepositoryInterface;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class InternshipsController extends Controller
{
    private $categoryRep, $internshipRep, $userRep, $placeRep;

    public function __construct(CategoryRepositoryInterface $categoryRep,
                                InternshipRepositoryInterface $internshipRep,
                                UserRepositoryInterface $userRep,
                                PlaceRepositoryInterface $placeRep)
    {
        $this->categoryRep = $categoryRep;
        $this->internshipRep = $internshipRep;
        $this->userRep = $userRep;
        $this->placeRep = $placeRep;
    }

    public function paginate(){
        $internships = $this->internshipRep->paginate();

        return view('admin.internships.paginate', compact('internships'));
    }

    public function index()
    {
        $internships = $this->internshipRep->paginate();

        return view('admin.internships.index', compact('internships'));
    }

    public function create()
    {
        $users = $this->userRep->getForCombo();
        $categories = $this->categoryRep->getForCombo();
        $places = $this->placeRep->getForCombo();

        return view('admin.internships.create', compact('users', 'categories', 'places'));
    }

    public function store(InternshipsRequest $request)
    {
        $internship = new Internship();

        $internship->fill($request->all());

        $internship->setCategory($request->get('category'));
        $internship->setUser($request->get('user'));
        $internship->setPlace($request->get('place'));

        $internship->save();

        return redirect()->route('internships.index');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit(Internship $internship)
    {
        $users = $this->userRep->getForCombo();
        $categories = $this->categoryRep->getForCombo();
        $places = $this->placeRep->getForCombo();

        return view('admin.internships.edit', compact('users', 'categories', 'places', 'internship'));
    }

    public function update(InternshipsRequest $request, Internship $internship)
    {
        $internship->fill($request->all());
        $internship->setPlace($request->get('place'));
        $internship->setUser($request->get('user'));
        $internship->setCategory($request->get('category'));

        $internship->save();

        return redirect()->route('internships.index');
    }

    public function destroy(Internship $internship)
    {
        $internship->delete();

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
