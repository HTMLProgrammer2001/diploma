<?php

namespace App\Policies;

use App\Internship;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InternshipPolicy
{
    use HandlesAuthorization;

    public function before(User $user){
        if($user->role <= User::ROLE_MODERATOR)
            return true;
    }

    /**
     * Determine whether the user can view any internships.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the internship.
     *
     * @param  \App\User  $user
     * @param  \App\Internship  $internship
     * @return mixed
     */
    public function view(User $user, Internship $internship)
    {
        return $internship->user_id == $user->id;
    }

    /**
     * Determine whether the user can create internships.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the internship.
     *
     * @param  \App\User  $user
     * @param  \App\Internship  $internship
     * @return mixed
     */
    public function update(User $user, Internship $internship)
    {
        return $internship->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the internship.
     *
     * @param  \App\User  $user
     * @param  \App\Internship  $internship
     * @return mixed
     */
    public function delete(User $user, Internship $internship)
    {
        return $internship->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the internship.
     *
     * @param  \App\User  $user
     * @param  \App\Internship  $internship
     * @return mixed
     */
    public function restore(User $user, Internship $internship)
    {
        return $internship->user_id == $user->id;
    }

    /**
     * Determine whether the user can permanently delete the internship.
     *
     * @param  \App\User  $user
     * @param  \App\Internship  $internship
     * @return mixed
     */
    public function forceDelete(User $user, Internship $internship)
    {
        return $internship->user_id == $user->id;
    }
}
