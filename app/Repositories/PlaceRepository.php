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
        $place = $this->getModel()->query()->newModelInstance($data);
        $place->fill($data);
        $place->save();

        return $place;
    }

    public function update($id, $data)
    {
        $place = $this->getModel()->query()->findOrFail($id);
        $place->fill($data);
        $place->save();

        return $place;
    }

    public function all()
    {
        return $this->getModel()->all();
    }

    public function getForCombo()
    {
        return $this->getModel()->all('id', 'name');
    }

    public function getForExportList(): array
    {
        return to_export_list($this->getModel()->all('id', 'name')->toArray());
    }
}
