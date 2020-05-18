<?php


namespace App\Repositories;


use App\Honor;
use App\Repositories\Interfaces\HonorRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class HonorRepository extends BaseRepository implements HonorRepositoryInterface
{
    private $model = Honor::class;

    public function getModel(): Model
    {
        return app($this->model);
    }

    public function create($data)
    {
        if($data['date_presentation'] ?? false)
            $data['date_presentation'] = from_locale_date($data['date_presentation']);

        $honor = new Honor();
        $honor->fill($data);

        $honor->setUser($data['user']);
        $honor->changeActive(true);
        $honor->save();

        return $honor;
    }

    public function update($id, $data)
    {
        if($data['date_presentation'] ?? false)
            $data['date_presentation'] = from_locale_date($data['date_presentation']);

        $honor = Honor::query()->findOrFail($id);
        $honor->fill($data);

        $honor->setUser($data['user']);
        $honor->changeActive($data['active'] ?? false);
        $honor->save();

        return $honor;
    }

    public function all()
    {
        return Honor::all();
    }

    public function paginateForUser($user_id, ?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Honor::query()->where('user_id', $user_id)->paginate($size);
    }
}
