<?php


namespace App\Repositories;


use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function paginate(?int $size)
    {
        $size = $size ?? config('app.PAGINATE_SIZE', 10);

        return User::paginate($size);
    }

    public function getForCombo()
    {
        return User::all('id', 'name', 'surname', 'patronymic');
    }

    public function getRoles(): array
    {
        return User::getRolesArray();
    }

    public function getPedagogicalTitles(): array
    {
        return User::getPedagogicalTitles();
    }
}
