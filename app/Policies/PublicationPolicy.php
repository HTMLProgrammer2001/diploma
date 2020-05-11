<?php

namespace App\Policies;

use App\Publication;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PublicationPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if($user->role <= User::ROLE_MODERATOR)
            return true;
    }

    public function viewAny()
    {
        return false;
    }

    public function view(User $user, Publication $publication)
    {
        return $publication->authors()->find($user->id);
    }

    public function create()
    {
        return true;
    }

    public function update(User $user, Publication $publication)
    {
        return $publication->authors()->find($user->id);
    }

    public function delete(User $user, Publication $publication)
    {
        return $publication->authors()->find($user->id);
    }

    public function restore(User $user, Publication $publication)
    {
        dd($publication);
        return $publication->authors()->find($user->id);
    }

    public function forceDelete(User $user, Publication $publication)
    {
        return $publication->authors()->find($user->id);
    }
}
