<?php


namespace App\Repositories;


use App\Commission;
use App\Repositories\Interfaces\CommissionRepositoryInterface;

class CommissionRepository implements CommissionRepositoryInterface
{
    public function all(){
        return Commission::all();
    }

    public function paginate(?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Commission::paginate($size);
    }

    public function getForCombo(){
        return Commission::all('id', 'name');
    }
}
