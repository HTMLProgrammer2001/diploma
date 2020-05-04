<?php


namespace App\Repositories;


use App\Rank;
use App\Repositories\Interfaces\RankRepositoryInterface;

class RankRepository implements RankRepositoryInterface
{
    public function all()
    {
        return Rank::all();
    }

    public function paginate(?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Rank::paginate($size);
    }

    public function getForCombo()
    {
        return Rank::all('id', 'name');
    }
}
