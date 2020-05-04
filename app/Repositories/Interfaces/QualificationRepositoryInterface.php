<?php


namespace App\Repositories\Interfaces;


interface QualificationRepositoryInterface
{
    public function all();

    public function paginate(?int $size);

    public function getQualificationNames(): array;
}
