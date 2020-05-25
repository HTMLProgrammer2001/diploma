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
        $education = $this->getModel()->query()->newModelInstance($data);
        $education->setUser($data['user']);
        $education->save();
    }

    public function update($id, $data)
    {
        $education = $this->getModel()->query()->findOrFail($id);
        $education->fill($data);
        $education->setUser($data['user']);
        $education->save();

        return $education;
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

    public function getUserString(int $user_id): string {
        //get  all educations
        $educations = $this->getModel()->query()->where('user_id', $user_id)->get();

        //parse string
        $educationsString = $educations->reduce(function(string $acc, $item){
            return $acc . implode(', ', [$item->institution, $item->graduate_year, $item->qualification]) . ';';
        }, '');

        //return info
        return $educationsString ? $educationsString : 'Немає інформації';
    }
}
