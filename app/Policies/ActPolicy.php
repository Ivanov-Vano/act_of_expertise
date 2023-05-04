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
        return $user->hasPermissionTo('просмотр всех: акт экспертизы');
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
        return $user->hasPermissionTo('просмотр: акт экспертизы');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('создание: акт экспертизы');
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
        return $user->hasPermissionTo('изменение: акт экспертизы');
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
        return $user->hasPermissionTo('удаление: акт экспертизы');
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
        return $user->hasPermissionTo('восстановление: акт экспертизы');
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
        return $user->hasPermissionTo('безвозвратное удаление: акт экспертизы');
    }
}
