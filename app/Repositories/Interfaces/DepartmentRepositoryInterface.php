<?php


namespace App\Repositories\Interfaces;


interface DepartmentRepositoryInterface
{
    public function all();

    public function paginate(?int $size);

    public function getForCombo();
}
