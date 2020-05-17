<?php


namespace App\Repositories;


use App\Department;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{
    private $model = Department::class;

    public function getModel(): Model
    {
        return app($this->model);
    }

    public function create($data)
    {
        $department = new Department();
        $department->fill($data);
        $department->save();

        return $department;
    }

    public function update($id, $data)
    {
        $department = Department::query()->findOrFail($id);
        $department->fill($data);
        $department->save();

        return $department;
    }

    public function getForCombo()
    {
        return Department::all('id', 'name');
    }

    public function getForExportList()
    {
        return to_export_list(Department::all('id', 'name')->toArray());
    }
}
