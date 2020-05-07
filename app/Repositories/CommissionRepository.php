<?php


namespace App\Repositories;


use App\Commission;
use App\Repositories\Interfaces\CommissionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CommissionRepository extends BaseRepository implements CommissionRepositoryInterface
{
    private $model = Commission::class;

    public function getModel(): Model
    {
        return app($this->model);
    }

    public function create($data)
    {
        $commission = new Commission();
        $commission->fill($data);
        $commission->save();

        return $commission;
    }

    public function update($id, $data)
    {
        $commission = Commission::query()->findOrFail($id);
        $commission->fill($data);
        $commission->save();

        return $commission;
    }

    public function all(){
        return Commission::all();
    }

    public function getForCombo(){
        return Commission::all('id', 'name');
    }
}
