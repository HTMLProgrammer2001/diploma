<?php


namespace App\Repositories\Interfaces;


interface InternshipRepositoryInterface extends BaseRepositoryInterface
{
    public function all();

    public function getInternshipHoursOf($internships): int;

    public function paginateForUser($user_id, ?int $size = null);

    public function getUserString($internships): string;

    public function getInternshipsFor(int $user_id);
}
