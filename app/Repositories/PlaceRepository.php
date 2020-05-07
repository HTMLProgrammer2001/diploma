<?php


namespace App\Repositories;


use App\Place;
use App\Repositories\Interfaces\PlaceRepositoryInterface;

class PlaceRepository implements PlaceRepositoryInterface
{
    private function filterByAddress($q, $address)
    {
        if(!$address)
            return $q;

        return $q->where('address', 'like', '%' . $address . '%');
    }

    private function filterByName($q, $name)
    {
        if(!$name)
            return $q;

        return $q->where('name', 'like', '%' . $name . '%');
    }

    public function filterPaginate(array $data, ?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        $placeQuery = Place::query();
        $placeQuery = $this->filterByName($placeQuery, $data['name'] ?? false);
        $placeQuery = $this->filterByAddress($placeQuery, $data['address'] ?? false);

        return $placeQuery->paginate($size);
    }

    public function getById(int $id)
    {
        return Place::find($id);
    }

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
