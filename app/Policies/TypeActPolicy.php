<?php

namespace App\Policies;

use App\Models\TypeAct;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypeActPolicy
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
        return $user->hasPermissionTo('просмотр всех: тип акта');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TypeAct  $typeAct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TypeAct $typeAct)
    {
        return $user->hasPermissionTo('просмотр: тип акта');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('создание: тип акта');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TypeAct  $typeAct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TypeAct $typeAct)
    {
        return $user->hasPermissionTo('изменение: тип акта');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TypeAct  $typeAct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TypeAct $typeAct)
    {
        return $user->hasPermissionTo('удаление: тип акта');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TypeAct  $typeAct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, TypeAct $typeAct)
    {
        return $user->hasPermissionTo('восстановление: тип акта');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TypeAct  $typeAct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, TypeAct $typeAct)
    {
        return $user->hasPermissionTo('безвозвратное удаление: тип акта');
    }
}
