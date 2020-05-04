<?php


namespace App\Repositories;


use App\Internship;
use App\Repositories\Interfaces\InternshipRepositoryInterface;

class InternshipRepository implements InternshipRepositoryInterface
{
    public function all(){
        return Internship::all();
    }

    public function paginate(?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Internship::paginate($size);
    }
}
