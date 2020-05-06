<?php


namespace App\Repositories;


use App\Commission;
use App\Repositories\Interfaces\CommissionRepositoryInterface;

class CommissionRepository implements CommissionRepositoryInterface
{
    public function getById(int $id)
    {
        return Commission::find($id);
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
        $commission = Commission::findOrFail($id);
        $commission->fill($data);
        $commission->save();

        return $commission;
    }

    public function destroy($id)
    {
        Commission::destroy($id);
    }

    public function all(){
        return Commission::all();
    }

    public function paginate(?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Commission::paginate($size);
    }

    public function getForCombo(){
        return Commission::all('id', 'name');
    }
}
