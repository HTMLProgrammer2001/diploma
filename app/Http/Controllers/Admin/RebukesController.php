<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RebukesRequest;
use App\Repositories\Interfaces\RebukeRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class RebukesController extends Controller
{
    private $rebukeRep, $userRep;

    public function __construct(RebukeRepositoryInterface $rebukeRep, UserRepositoryInterface $userRep)
    {
        $this->userRep = $userRep;
        $this->rebukeRep = $rebukeRep;
    }

    public function paginate(){
        $rebukes = $this->rebukeRep->paginate();
        $isProfile = false;

        return view('admin.rebukes.paginate', compact('rebukes', 'isProfile'));
    }

    public function index()
    {
        $rebukes = $this->rebukeRep->paginate();

        return view('admin.rebukes.index', compact('rebukes'));
    }

    public function create()
    {
        $users = $this->userRep->getForCombo();

        return view('admin.rebukes.create', compact('users'));
    }

    public function store(RebukesRequest $request)
    {
        $data = $request->all();
        $this->rebukeRep->create($data);

        return redirect()->route('rebukes.index');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit($rebuke_id)
    {
        $rebuke = $this->rebukeRep->getById($rebuke_id);

        if(!$rebuke)
            return abort(404);

        $users = $this->userRep->getForCombo();
        return view('admin.rebukes.edit', compact('users', 'rebuke'));
    }

    public function update(RebukesRequest $request, $rebuke_id)
    {
        $data = $request->all();
        $this->rebukeRep->update($rebuke_id, $data);

        return redirect()->route('rebukes.index');
    }

    public function destroy($rebuke_id)
    {
        $this->rebukeRep->destroy($rebuke_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
