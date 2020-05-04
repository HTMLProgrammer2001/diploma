<?php


namespace App\Repositories;


use App\Department;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function all(){
        return Department::all();
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
