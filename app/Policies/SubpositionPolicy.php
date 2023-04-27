<?php

namespace App\Policies;

use App\Models\Subposition;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubpositionPolicy
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
        return $user->hasPermissionTo('просмотр всех: товарная подпозиция');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subposition  $subposition
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Subposition $subposition)
    {
        return $user->hasPermissionTo('любой просмотр: товарная подпозиция');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('создание: товарная подпозиция');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subposition  $subposition
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Subposition $subposition)
    {
        return $user->hasPermissionTo('изменение: товарная подпозиция');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subposition  $subposition
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Subposition $subposition)
    {
        return $user->hasPermissionTo('удаление: товарная подпозиция');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subposition  $subposition
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Subposition $subposition)
    {
        return $user->hasPermissionTo('восстановление: товарная подпозиция');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subposition  $subposition
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Subposition $subposition)
    {
        return $user->hasPermissionTo('безвозвратное удаление: товарная подпозиция');
    }
}
