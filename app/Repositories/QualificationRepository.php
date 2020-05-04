<?php


namespace App\Repositories;


use App\Qualification;
use App\Repositories\Interfaces\QualificationRepositoryInterface;

class QualificationRepository implements QualificationRepositoryInterface
{
    public function all()
    {
        return Qualification::all();
    }

    public function paginate(?int $size)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return Qualification::paginate($size);
    }

    public function getQualificationNames(): array
    {
        return Qualification::getQualificationNames();
    }
}
