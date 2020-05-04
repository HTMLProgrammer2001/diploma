<?php


namespace App\Repositories\Interfaces;


interface EducationRepositoryInterface
{
    public function all();

    public function paginate(?int $size);
}
