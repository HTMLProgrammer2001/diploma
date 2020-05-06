<?php


namespace App\Repositories;


use App\Rank;
use App\Repositories\Interfaces\RankRepositoryInterface;

class RankRepository implements RankRepositoryInterface
{
    public function getById(int $id)
    {
        return Rank::find($id);
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
        $rank = Rank::findOrFail($id);
        $rank->fill($data);
        $rank->save();

        return $rank;
    }

    public function destroy($id)
    {
        Rank::destroy($id);
    }

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
