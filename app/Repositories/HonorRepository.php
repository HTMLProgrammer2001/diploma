<?php


namespace App\Repositories;


use App\Honor;
use App\Repositories\Interfaces\HonorRepositoryInterface;

class HonorRepository implements HonorRepositoryInterface
{
    public function create($data)
    {
        $honor = new Honor();
        $honor->fill($data);

        $honor->setUser($data['user']);
        $honor->changeActive(true);
        $honor->save();

        return $honor;
    }

    public function update($id, $data)
    {
        $honor = Honor::findOrFail($id);
        $honor->fill($data);

        $honor->setUser($data['user']);
        $honor->changeActive($data['active'] ?? false);
        $honor->save();

        return $honor;
    }

    public function destroy($id)
    {
        Honor::destroy($id);
    }

    public function all()
    {
        return Honor::all();
    }

    public function paginate(?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Honor::paginate($size);
    }
}
