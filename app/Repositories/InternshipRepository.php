<?php


namespace App\Repositories;


use App\Internship;
use App\Repositories\Interfaces\InternshipRepositoryInterface;
use App\Repositories\Interfaces\QualificationRepositoryInterface;

class InternshipRepository implements InternshipRepositoryInterface
{
    private $qualificationRep;

    public function __construct(QualificationRepositoryInterface $qualificationRep)
    {
        $this->qualificationRep = $qualificationRep;
    }

    public function create($data)
    {
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
        $internship = Internship::findOrFail($id);
        $internship->fill($data);

        $internship->setCategory($data['category']);
        $internship->setUser($data['user']);
        $internship->setPlace($data['place']);

        $internship->save();

        return $internship;
    }

    public function destroy($id)
    {
        Internship::destroy($id);
    }

    public function all(){
        return Internship::all();
    }

    public function paginate(?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Internship::paginate($size);
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
}
