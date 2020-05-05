<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RanksRequest;
use App\Repositories\Interfaces\RankRepositoryInterface;
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
        //create rank
        $data = $request->all();
        $this->rankRep->create($data);

        return redirect()->route('ranks.index');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit(Rank $rank)
    {
        return view('admin.ranks.edit', compact('rank'));
    }

    public function update(RanksRequest $request, $rank_id)
    {
        $data = $request->all();
        $this->rankRep->update($rank_id, $data);

        return redirect()->route('ranks.index');
    }

    public function destroy($rank_id)
    {
        $this->rankRep->destroy($rank_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
