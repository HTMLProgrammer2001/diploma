<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RanksRequest;
use App\Repositories\Interfaces\RankRepositoryInterface;
use Illuminate\Http\Request;
use App\Rank;

class RanksController extends Controller
{
    private $rankRep;

    public function __construct(RankRepositoryInterface $rankRep)
    {
        $this->rankRep = $rankRep;
    }

    public function paginate(){
        $ranks = $this->rankRep->paginate();

        return view('admin.ranks.paginate', compact('ranks'));
    }

    public function index()
    {
        $ranks = $this->rankRep->paginate();

        return view('admin.ranks.index', compact('ranks'));
    }

    public function create()
    {
        return view('admin.ranks.create');
    }

    public function store(RanksRequest $request)
    {
        $rank = new Rank();
        $rank->fill($request->all());
        $rank->save();

        return redirect()->route('ranks.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Rank $rank)
    {
        return view('admin.ranks.edit', compact('rank'));
    }

    public function update(RanksRequest $request, Rank $rank)
    {
        $rank->fill($request->all());
        $rank->save();

        return redirect()->route('ranks.index');
    }

    public function destroy(Rank $rank)
    {
        $rank->delete();

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
