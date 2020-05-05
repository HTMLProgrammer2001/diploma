<?php


namespace App\Repositories\Interfaces;


interface PlaceRepositoryInterface extends BaseRepositoryInterface
{
    public function all();

    public function getForCombo();
}
