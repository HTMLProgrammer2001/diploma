<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RebukesRequest;
use App\Rebuke;
use App\User;

class RebukesController extends Controller
{
    public function paginate(){
        $rebukes = Rebuke::paginate(env('PAGINATE_SIZE', 10));
        $isProfile = false;

        return view('admin.rebukes.paginate', compact('rebukes', 'isProfile'));
    }

    public function index()
    {
        $rebukes = Rebuke::paginate(env('PAGINATE_SIZE', 10));

        return view('admin.rebukes.index', compact('rebukes'));
    }

    public function create()
    {
        $users = User::all();

        return view('admin.rebukes.create', compact('users'));
    }

    public function store(RebukesRequest $request)
    {
        $rebuke = new Rebuke();

        //fill values
        $rebuke->fill($request->all());
        $rebuke->date_presentation = $request->get('date_presentation');
        $rebuke->changeActive(true);

        //set owner of honor
        $rebuke->setUser($request->get('user'));
        $rebuke->save();

        return redirect()->route('rebukes.index');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit(Rebuke $rebuke)
    {
        $users = User::all();
        return view('admin.rebukes.edit', compact('users', 'rebuke'));
    }

    public function update(RebukesRequest $request, Rebuke $rebuke)
    {
        //fill values
        $rebuke->fill($request->all());
        $rebuke->date_presentation = $request->get('date_presentation');
        $rebuke->changeActive($request->get('active'));

        //set owner of honor
        $rebuke->setUser($request->get('user'));
        $rebuke->save();

        return redirect()->route('rebukes.index');
    }

    public function destroy(Rebuke $rebuke)
    {
        $rebuke->delete();

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
