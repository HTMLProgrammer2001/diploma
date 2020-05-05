<?php


namespace App\Services\Interfaces;


interface AvatarServiceInterface
{
    public function uploadAvatar($file);

    public function getAvatarUrlPath($name);

    public function deleteAvatar($name);
}
