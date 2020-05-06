<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InternshipsRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\InternshipRepositoryInterface;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

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
        //create internship
        $data = $request->all();
        $this->internshipRep->create($data);

        return redirect()->route('internships.index');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit($internship_id)
    {
        $internship = $this->internshipRep->getById($internship_id);

        if(!$internship)
            return abort(404);

        $users = $this->userRep->getForCombo();
        $categories = $this->categoryRep->getForCombo();
        $places = $this->placeRep->getForCombo();

        return view('admin.internships.edit', compact('users', 'categories', 'places',
            'internship'));
    }

    public function update(InternshipsRequest $request, $internship_id)
    {
        //update internship
        $data = $request->all();
        $this->internshipRep->update($internship_id, $data);

        return redirect()->route('internships.index');
    }

    public function destroy($internship_id)
    {
        $this->internshipRep->destroy($internship_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
