<?php


namespace App\Repositories;


use App\Department;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function create($data)
    {
        $department = new Department();
        $department->fill($data);
        $department->save();

        return $department;
    }

    public function update($id, $data)
    {
        $department = Department::findOrFail($id);
        $department->fill($data);
        $department->save();

        return $department;
    }

    public function destroy($id)
    {
        Department::destroy($id);
    }

    public function paginate(?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Department::paginate($size);
    }

    public function getForCombo()
    {
        return Department::all('id', 'name');
    }
}
