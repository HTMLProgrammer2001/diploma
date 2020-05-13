<?php

namespace App\Policies;

use App\Rebuke;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RebukePolicy
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

    public function view(User $user, Rebuke $rebuke)
    {
        return $rebuke->user_id == $user->id;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Rebuke $rebuke)
    {
        return $rebuke->user_id == $user->id;
    }

    public function delete(User $user, Rebuke $rebuke)
    {
        return $rebuke->user_id == $user->id;
    }

    public function restore(User $user, Rebuke $rebuke)
    {
        return $rebuke->user_id == $user->id;
    }

    public function forceDelete(User $user, Rebuke $rebuke)
    {
        return $rebuke->user_id == $user->id;
    }
}
