<?php


namespace App\Repositories\Interfaces;


interface QualificationRepositoryInterface extends BaseRepositoryInterface
{
    public function all();

    public function getQualificationNames(): array;

    public function getLastQualificationDateOf(int $user_id): string;

    public function getNextQualificationDateOf(int $user_id): string;

    public function getQualificationNameOf(int $user_id): string;
}
