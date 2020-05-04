<?php


namespace App\Repositories;


use App\Education;
use App\Repositories\Interfaces\EducationRepositoryInterface;

class EducationRepository implements EducationRepositoryInterface
{
    public function all()
    {
        return Education::all();
    }

    public function paginate(?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Education::paginate($size);
    }
}
