<?php


namespace App\Repositories\Interfaces;


interface HonorRepositoryInterface extends BaseRepositoryInterface
{
    public function all();

    public function paginateForUser($user_id, ?int $size = null);
}
