<?php

namespace App\Http\Controllers\Admin;

use App\Commission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommissionsController extends Controller
{
    public function index()
    {
        $commissions = Commission::all();

        return view('admin.commissions.index', [
            'commissions' => $commissions
        ]);
    }

    public function create()
    {
        return view('admin.commissions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        //create new commission
        $commission = new Commission;
        $commission->fill($request->all());
        $commission->save();

        return redirect()->route('commissions.index');
    }

    public function show(Commission $commission)
    {
    }

    public function edit(Commission $commission)
    {
        return view('admin.commissions.edit', [
            'commission' => $commission
        ]);
    }

    public function update(Request $request, Commission $commission)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        //create new commission
        $commission->name = $request->get('name');
        $commission->save();

        return redirect()->route('commissions.index');
    }

    public function destroy(Commission $commission)
    {
        $commission->delete();

        return redirect()->route('commissions.index');
    }
}
