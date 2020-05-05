<?php


namespace App\Repositories;


use App\Place;
use App\Repositories\Interfaces\PlaceRepositoryInterface;

class PlaceRepository implements PlaceRepositoryInterface
{
    public function create($data)
    {
        $place = new Place();
        $place->fill($data);
        $place->save();

        return $place;
    }

    public function update($id, $data)
    {
        $place = Place::findOrFail($id);
        $place->fill($data);
        $place->save();

        return $place;
    }

    public function destroy($id)
    {
        Place::destroy($id);
    }

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
