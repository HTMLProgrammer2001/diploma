<?php

namespace App\Policies;

use App\Qualification;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QualificationPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $abilities){
        if($user->can('moderate'))
            return true;
    }

    public function viewAny(User $user)
    {
        return $user->can('view');
    }

    public function view(User $user, Qualification $qualification)
    {
        return $qualification->user_id == $user->id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Qualification $qualification)
    {
        return $qualification->user_id == $user->id;
    }

    public function delete(User $user, Qualification $qualification)
    {
        return $qualification->user_id == $user->id;
    }

    public function restore(User $user, Qualification $qualification)
    {
        return $qualification->user_id == $user->id;
    }

    public function forceDelete(User $user, Qualification $qualification)
    {
        return $qualification->user_id == $user->id;
    }
}
