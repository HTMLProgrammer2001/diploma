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
        $data['date_presentation'] = from_locale_date($data['date_presentation']);

        $rebuke = new Rebuke();
        $rebuke->fill($data);

        $rebuke->changeActive(true);
        $rebuke->setUser($data['user']);
        $rebuke->save();

        return $rebuke;
    }

    public function update($id, $data)
    {
        $data['date_presentation'] = from_locale_date($data['date_presentation']);

        $rebuke = Rebuke::findOrFail($id);
        $rebuke->fill($data);

        $rebuke->changeActive(true);
        $rebuke->setUser($data['user']);
        $rebuke->save();

        return $rebuke;
    }

    public function all()
    {
        return Rebuke::all();
    }

    public function paginateForUser($user_id, ?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Rebuke::query()->where('user_id', $user_id)->paginate($size);
    }
}
