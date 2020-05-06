<?php


namespace App\Repositories\Interfaces;


interface EducationRepositoryInterface extends BaseRepositoryInterface
{
    public function paginateForUser($user_id, ?int $size = null);
}
