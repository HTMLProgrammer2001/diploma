<?php


namespace App\Repositories\Interfaces;


interface PlaceRepositoryInterface
{
    public function all();

    public function paginate(?int $size);

    public function getForCombo();
}
