<?php


namespace App\Repositories\Interfaces;


interface HonorRepositoryInterface
{
    public function all();

    public function paginate(?int $size);
}
