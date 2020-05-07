<?php


namespace App\Repositories;


use App\Education;
use App\Repositories\Interfaces\EducationRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class EducationRepository extends BaseRepository implements EducationRepositoryInterface
{
    private $model = Education::class;

    public function getModel(): Model
    {
        return app($this->model);
    }

    public function create($data)
    {
        $education = new Education();

        $education->fill($data);
        $education->setUser($data['user']);
        $education->save();
    }

    public function update($id, $data)
    {
        $education = Education::findOrFail($id);
        $education->fill($data);
        $education->setUser($data['user']);
        $education->save();

        return $education;
    }

    public function all()
    {
        return Education::all();
    }

    public function paginateForUser($user_id, ?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Education::query()->where('user_id', $user_id)->paginate($size);
    }
}
