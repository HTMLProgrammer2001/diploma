<?php


namespace App\Repositories;


use App\Rebuke;
use App\Repositories\Interfaces\RebukeRepositoryInterface;

class RebukeRepository implements RebukeRepositoryInterface
{
    public function getById(int $id)
    {
        return Rebuke::find($id);
    }

    public function create($data)
    {
        $rebuke = new Rebuke();
        $rebuke->fill($data);

        $rebuke->changeActive(true);
        $rebuke->setUser($data['user']);
        $rebuke->save();

        return $rebuke;
    }

    public function update($id, $data)
    {
        $rebuke = Rebuke::findOrFail($id);
        $rebuke->fill($data);

        $rebuke->changeActive(true);
        $rebuke->setUser($data['user']);
        $rebuke->save();

        return $rebuke;
    }

    public function destroy($id)
    {
        Rebuke::destroy($id);
    }

    public function all()
    {
        return Rebuke::all();
    }

    public function paginate(?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Rebuke::paginate($size);
    }

    public function paginateForUser($user_id, ?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Rebuke::query()->where('user_id', $user_id)->paginate($size);
    }
}
