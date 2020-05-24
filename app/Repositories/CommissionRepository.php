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
        $commission = $this->getModel()->query()->newModelInstance($data);
        $commission->save();

        return $commission;
    }

    public function update($id, $data)
    {
        $commission = $this->getModel()->query()->findOrFail($id);
        $commission->fill($data);
        $commission->save();

        return $commission;
    }

    public function all(){
        return $this->getModel()->all();
    }

    public function getForCombo(){
        return $this->getModel()->all('id', 'name');
    }

    public function getForExportList()
    {
        return to_export_list($this->getModel()->all('id', 'name')->toArray());
    }
}
