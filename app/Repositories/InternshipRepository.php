<?php


namespace App\Repositories;


use App\Internship;
use App\Repositories\Interfaces\InternshipRepositoryInterface;
use App\Repositories\Interfaces\QualificationRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class InternshipRepository extends BaseRepository implements InternshipRepositoryInterface
{
    private $qualificationRep, $model = Internship::class;

    public function __construct(QualificationRepositoryInterface $qualificationRep)
    {
        $this->qualificationRep = $qualificationRep;
    }

    public function getModel(): Model
    {
        return app($this->model);
    }

    public function create($data)
    {
        if($data['from'] ?? false)
            $data['from'] = from_locale_date($data['from']);

        if($data['to'] ?? false)
            $data['to'] = from_locale_date($data['to']);

        $internship = new Internship();
        $internship->fill($data);

        $internship->setCategory($data['category']);
        $internship->setUser($data['user']);
        $internship->setPlace($data['place']);

        $internship->save();

        return $internship;
    }

    public function update($id, $data)
    {
        if($data['from'] ?? false)
            $data['from'] = from_locale_date($data['from']);

        if($data['to'] ?? false)
            $data['to'] = from_locale_date($data['to']);

        $internship = Internship::query()->findOrFail($id);
        $internship->fill($data);

        $internship->setCategory($data['category']);
        $internship->setUser($data['user']);
        $internship->setPlace($data['place']);

        $internship->save();

        return $internship;
    }

    public function all(){
        return Internship::all();
    }

    public function getInternshipHoursOf(int $user_id): int
    {
        //get date of last qualification update of this user
        $from = $this->qualificationRep->getLastQualificationDateOf($user_id);

        //set default value
        if(!$from)
            $from = '1970-01-01';

        //get hours sum from last qualification update
        $hours = Internship::query()->where('user_id', $user_id)
            ->whereDate('from', '>', $from)->sum('hours');

        return $hours;
    }

    public function paginateForUser($user_id, ?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Internship::query()->where('user_id', $user_id)->paginate($size);
    }
}
