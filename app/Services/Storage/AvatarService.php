<?php


namespace App\Services\Storage;


use App\Services\Storage\Interfaces\AvatarServiceInterface;

class AvatarService extends BaseStorage implements AvatarServiceInterface
{
    const AVATAR_PATH = 'public/avatars/';
    const AVATAR_URL = '/storage/avatars/';
    const DEFAULT_URL = '/storage/avatars/default.gif';

    public function uploadAvatar($file)
    {
        return $this->upload($file, self::AVATAR_PATH);
    }

    public function getAvatarUrlPath($name)
    {
        if($this->exists(self::AVATAR_URL . $name))
            return self::AVATAR_URL . $name;
        else
            return self::DEFAULT_URL;
    }

    public function deleteAvatar($name)
    {
        return $this->delete(self::AVATAR_PATH . $name);
    }
}
