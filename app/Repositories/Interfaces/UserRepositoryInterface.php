<?php


namespace App\Repositories\Interfaces;


interface UserRepositoryInterface
{
    public function all();

    public function paginate(?int $size);

    public function getForCombo();

    public function getRoles(): array;

    public function getPedagogicalTitles(): array;
}
