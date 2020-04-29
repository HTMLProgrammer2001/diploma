<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rank;

class RanksController extends Controller
{
    public function paginate(){
        $ranks = Rank::paginate(env('PAGINATE_SIZE', 10));

        return view('admin.ranks.paginate', compact('ranks'));
    }

    public function index()
    {
        $ranks = Rank::paginate(env('PAGINATE_SIZE', 10));

        return view('admin.ranks.index', compact('ranks'));
    }

    public function create()
    {
        return view('admin.ranks.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|string'
        ]);

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

    public function update(Request $request, Rank $rank)
    {
        $this->validate($request, [
           'name' => 'required|string'
        ]);

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
