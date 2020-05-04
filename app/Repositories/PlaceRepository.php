<?php


namespace App\Repositories;


use App\Place;
use App\Repositories\Interfaces\PlaceRepositoryInterface;

class PlaceRepository implements PlaceRepositoryInterface
{
    public function all()
    {
        return Place::all();
    }

    public function paginate(?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Place::paginate($size);
    }

    public function getForCombo()
    {
        return Place::all('id', 'name');
    }
}
