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

        $honor = $this->getModel()->query()->newModelInstance($data);
        $honor->setUser($data['user']);
        $honor->changeActive(true);
        $honor->save();

        return $honor;
    }

    public function update($id, $data)
    {
        if($data['date_presentation'] ?? false)
            $data['date_presentation'] = from_locale_date($data['date_presentation']);

        $honor = $this->getModel()->query()->findOrFail($id);
        $honor->fill($data);

        $honor->setUser($data['user']);
        $honor->changeActive($data['active'] ?? false);
        $honor->save();

        return $honor;
    }

    public function all()
    {
        return $this->getModel()->all();
    }

    public function paginateForUser($user_id, ?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return $this->getModel()->query()->where('user_id', $user_id)->paginate($size);
    }

    public function getTypes(): array{
        return [
            'МОН',
            'Президента',
            'КМУ',
            'Ректора ОНПУ',
            'Директора коледжу',
            'Облдержадміністрації',
            'Управління освіти',
            'МАН',
            'Спортивні досягнення',
            'Облради',
            'Олімпіади та конкурси',
            'Інші'
        ];
    }
}
