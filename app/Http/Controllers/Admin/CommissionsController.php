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
        $this->commissionRep->create($request);

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

    public function update(CommissionsRequest $request, $commission_id)
    {
        //update commission
        $this->commissionRep->update($commission_id, $request);

        return redirect()->route('commissions.index');
    }

    public function destroy($commission_id)
    {
        $this->commissionRep->destroy($commission_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
