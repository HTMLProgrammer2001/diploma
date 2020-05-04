<?php


namespace App\Repositories\Interfaces;


interface CommissionRepositoryInterface
{
    public function all();

    public function paginate(?int $size);

    public function getForCombo();
}
