<?php


namespace App\Repositories\Interfaces;


interface PublicationRepositoryInterface
{
    public function all();

    public function paginate(?int $size);
}
