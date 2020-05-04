<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RebukesRequest;
use App\Rebuke;
use App\Repositories\Interfaces\RebukeRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

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
        $users = $this->userRep->getForCombo();
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
