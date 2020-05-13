<?php

namespace App\Policies;

use App\Internship;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InternshipPolicy
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

    public function view(User $user, Internship $internship)
    {
        return $internship->user_id == $user->id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Internship $internship)
    {
        return $internship->user_id == $user->id;
    }

    public function delete(User $user, Internship $internship)
    {
        return $internship->user_id == $user->id;
    }

    public function restore(User $user, Internship $internship)
    {
        return $internship->user_id == $user->id;
    }

    public function forceDelete(User $user, Internship $internship)
    {
        return $internship->user_id == $user->id;
    }
}
