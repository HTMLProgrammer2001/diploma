<?php


namespace App\Repositories\Interfaces;


interface RankRepositoryInterface
{
    public function all();

    public function paginate(?int $size);

    public function getForCombo();
}
