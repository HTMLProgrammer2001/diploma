<?php

namespace App\Http\Controllers\Admin;

use App\Honor;
use App\Http\Controllers\Controller;
use App\Http\Requests\HonorsRequest;
use App\Repositories\Interfaces\HonorRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class HonorsController extends Controller
{
    private $honorRep, $userRep;

    public function __construct(HonorRepositoryInterface $honorRep, UserRepositoryInterface $userRep)
    {
        $this->honorRep = $honorRep;
        $this->userRep = $userRep;
    }

    public function paginate(){
        $honors = $this->honorRep->paginate();
        $isProfile = false;

        return view('admin.honors.paginate', compact('honors', 'isProfile'));
    }

    public function index()
    {
        $honors = $this->honorRep->paginate();

        return view('admin.honors.index', compact('honors'));
    }

    public function create()
    {
        $users = $this->userRep->getForCombo();

        return view('admin.honors.create', compact('users'));
    }

    public function store(HonorsRequest $request)
    {
        $honor = new Honor();

        //fill values
        $honor->fill($request->all());
        $honor->date_presentation = $request->get('date_presentation');
        $honor->changeActive(true);

        //set owner of honor
        $honor->setUser($request->get('user'));
        $honor->save();

        return redirect()->route('honors.index');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit(Honor $honor)
    {
        $users = $this->userRep->getForCombo();
        return view('admin.honors.edit', compact('users', 'honor'));
    }

    public function update(HonorsRequest $request, Honor $honor)
    {
        //fill values
        $honor->fill($request->all());
        $honor->date_presentation = $request->get('date_presentation');
        $honor->changeActive($request->get('active') ?? false);

        //set owner of honor
        $honor->setUser($request->get('user'));
        $honor->save();

        return redirect()->route('honors.index');
    }

    public function destroy(Honor $honor)
    {
        $honor->delete();

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
