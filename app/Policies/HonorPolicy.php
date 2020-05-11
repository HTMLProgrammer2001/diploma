<?php

namespace App\Policies;

use App\Honor;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HonorPolicy
{
    use HandlesAuthorization;

    public function before(User $user){
        if($user->can('moderate'))
            return true;
    }

    public function viewAny(User $user)
    {
        return $user->can('view');
    }

    public function view(User $user, Honor $honor)
    {
        return $user->id == $honor->user_id;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Honor $honor)
    {
        return $user->id == $honor->user_id;
    }

    public function delete(User $user, Honor $honor)
    {
        return $user->id == $honor->user_id;
    }

    public function restore(User $user, Honor $honor)
    {
        return $user->id == $honor->user_id;
    }

    public function forceDelete(User $user, Honor $honor)
    {
        return $user->id == $honor->user_id;
    }
}
