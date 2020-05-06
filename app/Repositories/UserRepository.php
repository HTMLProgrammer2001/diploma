<?php


namespace App\Repositories;


use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\AvatarServiceInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    private $avatarService;

    public function __construct(AvatarServiceInterface $avatarService)
    {
        $this->avatarService = $avatarService;
    }

    public function getById(int $id)
    {
        return User::find($id);
    }

    public function create($data)
    {
        $user = new User();
        $user->fill($data);

        //generate secret values
        $user->generatePassword($data['password']);

        //relationships
        $user->setDepartment($data['department']);
        $user->setCommission($data['commission']);

        $user->avatar = $this->avatarService->uploadAvatar($data['avatar'] ?? false);
        $user->save();
    }

    public function update($id, $data)
    {
        $user = User::findOrFail($id);
        $user->fill($data);

        //generate secret values
        $user->generatePassword($data['password']);
        $user->cryptPassport($data['passport']);
        $user->cryptCode($data['code']);

        //relationships
        $user->setDepartment($data['department']);
        $user->setCommission($data['commission']);
        $user->setRank($data['rank']);

        //set new avatar
        $this->avatarService->deleteAvatar($user->avatar ?? false);
        $user->avatar = $this->avatarService->uploadAvatar($data['avatar'] ?? false);

        if($data['role'] ?? false)
            $user->role = $data['role'];

        $user->save();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $this->avatarService->deleteAvatar($user->avatar);

        User::destroy($id);
    }

    public function all()
    {
        return User::all();
    }

    public function paginate(?int $size = null)
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
