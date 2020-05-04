<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentsRequest;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    private $departmentRep;

    public function __construct(DepartmentRepositoryInterface $departmentRep)
    {
        $this->departmentRep = $departmentRep;
    }

    public function paginate()
    {
        $departments = $this->departmentRep->paginate();

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
        $department = new Department();
        $department->fill($request->all());
        $department->save();

        return redirect()->route('departments.index');
    }

    public function show(Department $department)
    {
    }

    public function edit(Department $department)
    {
        return view('admin.departments.edit', [
            'department' => $department
        ]);
    }

    public function update(DepartmentsRequest $request, Department $department)
    {
        //create new commission
        $department->name = $request->get('name');
        $department->save();

        return redirect()->route('departments.index');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
