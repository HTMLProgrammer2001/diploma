<?php


namespace App\Repositories;


use App\Honor;
use App\Repositories\Interfaces\HonorRepositoryInterface;

class HonorRepository implements HonorRepositoryInterface
{
    public function all()
    {
        return Honor::all();
    }

    public function paginate(?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Honor::paginate($size);
    }
}
