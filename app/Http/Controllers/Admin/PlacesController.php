<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlacesRequest;
use App\Repositories\Interfaces\PlaceRepositoryInterface;

class PlacesController extends Controller
{
    private $placeRep;

    public function __construct(PlaceRepositoryInterface $placeRep)
    {
        $this->placeRep = $placeRep;
    }

    public function paginate(){
        $places = $this->placeRep->paginate();

        return view('admin.places.paginate', compact('places'));
    }

    public function index()
    {
        $places = $this->placeRep->paginate();

        return view('admin.places.index', compact('places'));
    }

    public function create()
    {
        return view('admin.places.create');
    }

    public function store(PlacesRequest $request)
    {
        //create new place
        $data = $request->all();
        $this->placeRep->create($data);

        return redirect()->route('places.index');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit($place_id)
    {
        $place = $this->placeRep->getById($place_id);

        if(!$place)
            return abort(404);

        return view('admin.places.edit', compact('place'));
    }

    public function update(PlacesRequest $request, $place_id)
    {
        //edit place
        $data = $request->all();
        $this->placeRep->update($place_id, $data);

        return redirect()->route('places.index');
    }

    public function destroy($place_id)
    {
        $this->placeRep->destroy($place_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
