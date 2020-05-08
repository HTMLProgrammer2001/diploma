<?php

namespace App\Http\Controllers\Admin;

use App\Commission;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommissionsRequest;
use App\Repositories\Interfaces\CommissionRepositoryInterface;
use App\Repositories\Rules\LikeRule;
use Illuminate\Http\Request;

class CommissionsController extends Controller
{
    private $commissionRep;

    public function __construct(CommissionRepositoryInterface $commissionRep)
    {
        $this->commissionRep = $commissionRep;
    }

    public function paginate(Request $request)
    {
        //fill rule array
        $rules = [];

        if($request->input('name'))
            $rules[] = new LikeRule('name', $request->input('name'));

        $commissions = $this->commissionRep->filterPaginate($rules);

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
        $this->commissionRep->create($request->all());

        return redirect()->route('commissions.index');
    }

    public function show()
    {
        return abort(404);
    }

    public function edit($commission_id)
    {
        $commission = $this->commissionRep->getById($commission_id);

        if(!$commission)
            return abort(404);

        return view('admin.commissions.edit', [
            'commission' => $commission
        ]);
    }

    public function update(CommissionsRequest $request, $commission_id)
    {
        //update commission
        $this->commissionRep->update($commission_id, $request->all());

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
