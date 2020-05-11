<?php

namespace App\Policies;

use App\Education;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EducationPolicy
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

    public function view(User $user, Education $education)
    {
        return $user->id == $education->user_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Education $education)
    {
        return $user->id == $education->user_id;
    }

    public function delete(User $user, Education $education)
    {
        return $user->id == $education->user_id;
    }

    public function restore(User $user, Education $education)
    {
        return $user->id == $education->user_id;
    }

    public function forceDelete(User $user, Education $education)
    {
        return $user->id == $education->user_id;
    }
}
