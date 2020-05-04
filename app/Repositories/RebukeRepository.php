<?php


namespace App\Repositories;


use App\Rebuke;
use App\Repositories\Interfaces\RebukeRepositoryInterface;

class RebukeRepository implements RebukeRepositoryInterface
{
    public function all()
    {
        return Rebuke::all();
    }

    public function paginate(?int $size)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Rebuke::paginate($size);
    }
}
