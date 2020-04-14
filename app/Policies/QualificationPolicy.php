<?php

namespace App\Policies;

use App\Qualification;
use App\User;
use Aws\Common\Enum\UaString;
use Illuminate\Auth\Access\HandlesAuthorization;

class QualificationPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $abilities){
        if($user->role <= User::ROLE_MODERATOR)
            return true;
    }

    /**
     * Determine whether the user can view any qualifications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the qualification.
     *
     * @param  \App\User  $user
     * @param  \App\Qualification  $qualification
     * @return mixed
     */
    public function view(User $user, Qualification $qualification)
    {
        return $qualification->user_id == $user->id;
    }

    /**
     * Determine whether the user can create qualifications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the qualification.
     *
     * @param  \App\User  $user
     * @param  \App\Qualification  $qualification
     * @return mixed
     */
    public function update(User $user, Qualification $qualification)
    {
        return $qualification->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the qualification.
     *
     * @param  \App\User  $user
     * @param  \App\Qualification  $qualification
     * @return mixed
     */
    public function delete(User $user, Qualification $qualification)
    {
        return $qualification->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the qualification.
     *
     * @param  \App\User  $user
     * @param  \App\Qualification  $qualification
     * @return mixed
     */
    public function restore(User $user, Qualification $qualification)
    {
        return $qualification->user_id == $user->id;
    }

    /**
     * Determine whether the user can permanently delete the qualification.
     *
     * @param  \App\User  $user
     * @param  \App\Qualification  $qualification
     * @return mixed
     */
    public function forceDelete(User $user, Qualification $qualification)
    {
        return $qualification->user_id == $user->id;
    }
}
