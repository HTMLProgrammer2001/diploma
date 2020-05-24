<?php


namespace App\Repositories;


use App\Qualification;
use App\Repositories\Interfaces\QualificationRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class QualificationRepository extends BaseRepository implements QualificationRepositoryInterface
{
    private $model = Qualification::class;

    public function getModel(): Model
    {
        return app($this->model);
    }

    public function create($data)
    {
        if($data['date'] ?? false)
            $data['date'] = from_locale_date($data['date']);

        $qualification = $this->getModel()->query()->newModelInstance($data);
        $qualification->setUser($data['user']);
        $qualification->save();

        return $qualification;
    }

    public function update($id, $data)
    {
        if($data['date'] ?? false)
            $data['date'] = from_locale_date($data['date']);

        $qualification = $this->getModel()->query()->findOrFail($id);
        $qualification->fill($data);

        $qualification->setUser($data['user']);
        $qualification->save();

        return $qualification;
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

    public function getQualificationNames(): array
    {
        return [
            'Спеціаліст',
            'Спеціаліст 2 категорії',
            'Спеціаліст 1 категорії',
            'Спеціаліст вищої категорії'
        ];
    }

    public function getLastQualificationDateOf(int $user_id)
    {
        $date = $this->getModel()->query()->where('user_id', $user_id)
            ->orderBy('date', 'desc')->pluck('date')->first();

        return $date ?? null;
    }

    public function getNextQualificationDateOf(int $user_id)
    {
        $lastDate = $this->getLastQualificationDateOf($user_id);

        if(!$lastDate)
            return null;

        return Carbon::createFromFormat('Y-m-d', $lastDate)
                ->addYears(5)->format('Y-m-d');
    }

    public function getQualificationNameOf(int $user_id)
    {
        $name = $this->getModel()->query()->where('user_id', $user_id)
            ->orderBy('date', 'desc')->pluck('name')->first();

        return $name ?? null;
    }
}
