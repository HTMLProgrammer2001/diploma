<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function paginate()
    {
        $departments = Department::paginate(env('PAGINATE_SIZE', 10));

        return view('admin.departments.paginate', compact('departments'));
    }

    public function index()
    {
        $departments = Department::paginate(env('PAGINATE_SIZE', 10));

        return view('admin.departments.index', [
            'departments' => $departments
        ]);
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

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

    public function update(Request $request, Department $department)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        //create new commission
        $department->name = $request->get('name');
        $department->save();

        return redirect()->route('departments.index');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index');
    }
}
