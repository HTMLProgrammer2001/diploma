<?php


namespace App\Repositories;


use App\Rank;
use App\Repositories\Interfaces\RankRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class RankRepository extends BaseRepository implements RankRepositoryInterface
{
    private $model = Rank::class;

    public function getModel(): Model
    {
        return app($this->model);
    }

    public function create($data)
    {
        $rank = $this->getModel()->query()->newModelInstance($data);
        $rank->save();

        return $rank;
    }

    public function update($id, $data)
    {
        $rank = $this->getModel()->query()->findOrFail($id);
        $rank->fill($data);
        $rank->save();

        return $rank;
    }

    public function all()
    {
        return $this->getModel()->all();
    }

    public function getForCombo()
    {
        return $this->getModel()->all('id', 'name');
    }

    public function getForExportList()
    {
        return to_export_list($this->getModel()->all('id', 'name')->toArray());
    }
}
