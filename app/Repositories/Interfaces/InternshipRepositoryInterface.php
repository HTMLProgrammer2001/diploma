<?php


namespace App\Repositories\Interfaces;


interface InternshipRepositoryInterface extends BaseRepositoryInterface
{
    public function all();

    public function getInternshipHoursOf(int $user_id): int;

    public function paginateForUser($user_id, ?int $size = null);
}
