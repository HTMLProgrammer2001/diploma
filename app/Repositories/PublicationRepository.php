<?php


namespace App\Repositories;


use App\Publication;
use App\Repositories\Interfaces\PublicationRepositoryInterface;

class PublicationRepository implements PublicationRepositoryInterface
{
    public function all()
    {
        return Publication::all();
    }

    public function paginate(?int $size = null)
    {
        $size = $size ?? config('app.PAGINATE_SIZE');

        return Publication::paginate($size);
    }
}
