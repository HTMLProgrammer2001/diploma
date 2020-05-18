<?php


namespace App\Repositories;


use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Storage\Interfaces\AvatarServiceInterface;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    private $avatarService, $model = User::class;

    public function __construct(AvatarServiceInterface $avatarService)
    {
        $this->avatarService = $avatarService;
    }

    public function getModel(): Model
    {
        return app($this->model);
    }

    public function create($data)
    {
        if($data['birthday'] ?? false)
            $data['birthday'] = from_locale_date($data['birthday']);

        $user = new User();
        $user->fill($data);

        //generate secret values
        $user->generatePassword($data['password']);

        //relationships
        $user->setDepartment($data['department']);
        $user->setCommission($data['commission']);

        if($data['rank'] ?? false)
            $user->setRank($data['rank']);

        $user->avatar = $this->avatarService->uploadAvatar($data['avatar'] ?? false);
        $user->save();

        return $user;
    }

    public function update($id, $data)
    {
        if($data['birthday'] ?? false)
            $data['birthday'] = from_locale_date($data['birthday']);

        $user = User::query()->findOrFail($id);
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
