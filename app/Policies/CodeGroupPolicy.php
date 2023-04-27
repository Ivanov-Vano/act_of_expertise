<?php

namespace App\Policies;

use App\Models\CodeGroup;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CodeGroupPolicy
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
        return $user->hasPermissionTo('просмотр всех: правило');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CodeGroup  $codeGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, CodeGroup $codeGroup)
    {
        return $user->hasPermissionTo('просмотр: правило');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('создание: правило');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CodeGroup  $codeGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, CodeGroup $codeGroup)
    {
        return $user->hasPermissionTo('изменение: правило');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CodeGroup  $codeGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, CodeGroup $codeGroup)
    {
        return $user->hasPermissionTo('изменение: правило');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CodeGroup  $codeGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, CodeGroup $codeGroup)
    {
        return $user->hasPermissionTo('восстановление: правило');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CodeGroup  $codeGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CodeGroup $codeGroup)
    {
        return $user->hasPermissionTo('безвозвратное удаление: правило');
    }
}
