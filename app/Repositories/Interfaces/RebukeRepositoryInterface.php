<?php


namespace App\Repositories\Interfaces;


interface RebukeRepositoryInterface
{
    public function all();

    public function paginate(?int $size);
}
