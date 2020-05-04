<?php

namespace App\Http\Controllers\Admin;

use App\Commission;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommissionsRequest;
use App\Repositories\Interfaces\CommissionRepositoryInterface;
use Illuminate\Http\Request;

class CommissionsController extends Controller
{
    private $commissionRep;

    public function __construct(CommissionRepositoryInterface $commissionRep)
    {
        $this->commissionRep = $commissionRep;
    }

    public function paginate()
    {
        $commissions = $this->commissionRep->paginate();

        return view('admin.commissions.paginate', compact('commissions'));
    }

    public function index()
    {
        $commissions = $this->commissionRep->paginate();

        return \view('admin.commissions.index', [
           'commissions' => $commissions
        ]);
    }

    public function create()
    {
        return view('admin.commissions.create');
    }

    public function store(CommissionsRequest $request)
    {
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

    public function update(CommissionsRequest $request, Commission $commission)
    {
        //create new commission
        $commission->name = $request->get('name');
        $commission->save();

        return redirect()->route('commissions.index');
    }

    public function destroy(Commission $commission)
    {
        $commission->delete();

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
