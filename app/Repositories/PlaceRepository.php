<?php


namespace App\Repositories;


use App\Place;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PlaceRepository extends BaseRepository implements PlaceRepositoryInterface
{
    private $model = Place::class;

    public function getModel(): Model
    {
        return app($this->model);
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
        $place = Place::query()->findOrFail($id);
        $place->fill($data);
        $place->save();

        return $place;
    }

    public function all()
    {
        return Place::all();
    }

    public function getForCombo()
    {
        return Place::all('id', 'name');
    }
}
