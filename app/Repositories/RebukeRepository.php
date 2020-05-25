<?php


namespace App\Repositories;


use App\Rebuke;
use App\Repositories\Interfaces\RebukeRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class RebukeRepository extends BaseRepository implements RebukeRepositoryInterface
{
    private $model = Rebuke::class;

    public function getModel(): Model
    {
        return app($this->model);
    }

    public function create($data)
    {
        if($data['date_presentation'] ?? false)
            $data['date_presentation'] = from_locale_date($data['date_presentation']);

        $rebuke = $this->getModel()->query()->newModelInstance($data);
        $rebuke->changeActive(true);
        $rebuke->setUser($data['user']);
        $rebuke->save();

        return $rebuke;
    }

    public function update($id, $data)
    {
        if($data['date_presentation'] ?? false)
            $data['date_presentation'] = from_locale_date($data['date_presentation']);

        $rebuke = $this->getModel()->query()->findOrFail($id);
        $rebuke->fill($data);

        $rebuke->changeActive(true);
        $rebuke->setUser($data['user']);
        $rebuke->save();

        return $rebuke;
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

    public function getUserString(int $user_id): string
    {
        //get all rebukes
        $rebukes = $this->getModel()->query()->where('user_id', $user_id)->get();

        //parse string
        $rebukesString = $rebukes->reduce(function(string $acc, $item){
            return $acc . implode(', ', [$item->title, $item->type,
                    to_locale_date($item->date_presentation), $item->order]) . ';';
        }, '');

        //return info
        return $rebukesString ? $rebukesString : 'Немає інформації';
    }
}
