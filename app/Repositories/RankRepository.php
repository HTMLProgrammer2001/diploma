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
        $rank = new Rank();
        $rank->fill($data);
        $rank->save();

        return $rank;
    }

    public function update($id, $data)
    {
        $rank = Rank::query()->findOrFail($id);
        $rank->fill($data);
        $rank->save();

        return $rank;
    }

    public function all()
    {
        return Rank::all();
    }

    public function getForCombo()
    {
        return Rank::all('id', 'name');
    }

    public function getForExportList()
    {
        return to_export_list(Rank::all('id', 'name')->toArray());
    }
}
