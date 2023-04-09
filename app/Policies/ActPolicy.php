<?php

namespace App\Policies;

use App\Models\Act;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Act  $act
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Act $act)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
/*        if ($user->hasRole('Admin') || $user->hasPermissionTo('Create Acts')) {
            return true;
        }
        return false;*/
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Act  $act
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Act $act)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Act  $act
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Act $act)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Act  $act
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Act $act)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Act  $act
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Act $act)
    {
        return true;
    }
}
