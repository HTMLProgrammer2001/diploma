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

    /**
     * Determine whether the user can view any publications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the publication.
     *
     * @param  \App\User  $user
     * @param  \App\Publication  $publication
     * @return mixed
     */
    public function view(User $user, Publication $publication)
    {
        return $publication->authors()->find($user->id);
    }

    /**
     * Determine whether the user can create publications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the publication.
     *
     * @param  \App\User  $user
     * @param  \App\Publication  $publication
     * @return mixed
     */
    public function update(User $user, Publication $publication)
    {
        return $publication->authors()->find($user->id);
    }

    /**
     * Determine whether the user can delete the publication.
     *
     * @param  \App\User  $user
     * @param  \App\Publication  $publication
     * @return mixed
     */
    public function delete(User $user, Publication $publication)
    {
        return $publication->authors()->find($user->id);
    }

    /**
     * Determine whether the user can restore the publication.
     *
     * @param  \App\User  $user
     * @param  \App\Publication  $publication
     * @return mixed
     */
    public function restore(User $user, Publication $publication)
    {
        return $publication->authors()->find($user->id);
    }

    /**
     * Determine whether the user can permanently delete the publication.
     *
     * @param  \App\User  $user
     * @param  \App\Publication  $publication
     * @return mixed
     */
    public function forceDelete(User $user, Publication $publication)
    {
        return $publication->authors()->find($user->id);
    }
}
