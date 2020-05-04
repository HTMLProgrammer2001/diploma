<?php


namespace App\Repositories\Interfaces;


interface InternshipRepositoryInterface
{
    public function all();

    public function paginate(?int $size);
}
