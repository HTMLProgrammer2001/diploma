<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentsRequest;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\Rules\LikeRule;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    private $departmentRep;

    public function __construct(DepartmentRepositoryInterface $departmentRep)
    {
        $this->departmentRep = $departmentRep;
    }

    public function paginate(Request $request)
    {
        //create rules
        $rules = [];

        if($request->input('name'))
            $rules[] = new LikeRule('name', $request->input('name'));

        //filter
        $departments = $this->departmentRep->filterPaginate($rules);

        return view('admin.departments.paginate', compact('departments'));
    }

    public function index()
    {
        $departments = $this->departmentRep->paginate();

        return view('admin.departments.index', [
            'departments' => $departments
        ]);
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(DepartmentsRequest $request)
    {
        //create new department
        $data = $request->all();
        $this->departmentRep->create($data);

        return redirect()->route('departments.index');
    }

    public function show()
    {
        return abort(404);
    }

    public function edit($department_id)
    {
        $department = $this->departmentRep->getById($department_id);

        if(!$department)
            return abort(404);

        return view('admin.departments.edit', [
            'department' => $department
        ]);
    }

    public function update(DepartmentsRequest $request, $department_id)
    {
        //update department
        $data = $request->all();
        $this->departmentRep->update($department_id, $data);

        return redirect()->route('departments.index');
    }

    public function destroy($department_id)
    {
        $this->departmentRep->destroy($department_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
