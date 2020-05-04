<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlacesRequest;
use App\Place;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.places.create');
    }

    public function store(PlacesRequest $request)
    {
        //create new place
        $place = new Place();
        $place->fill($request->all());

        $place->save();

        return redirect()->route('places.index');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit(Place $place)
    {
        return view('admin.places.edit', compact('place'));
    }

    public function update(PlacesRequest $request, Place $place)
    {
        //edit place
        $place->fill($request->all());
        $place->save();

        return redirect()->route('places.index');
    }

    public function destroy(Place $place)
    {
        $place->delete();

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
