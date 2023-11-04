<?php

namespace App\Policies;

use App\Models\Measure;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeasurePolicy
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
        //return $user->hasPermissionTo('просмотр всех: единица измерения');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Measure  $measure
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Measure $measure)
    {
        return $user->hasPermissionTo('просмотр: единица измерения');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('создание: единица измерения');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Measure  $measure
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Measure $measure)
    {
        return $user->hasPermissionTo('изменение: единица измерения');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Measure  $measure
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Measure $measure)
    {
        return $user->hasPermissionTo('удаление: единица измерения');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Measure  $measure
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Measure $measure)
    {
        return $user->hasPermissionTo('восстановление: единица измерения');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Measure  $measure
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Measure $measure)
    {
        return $user->hasPermissionTo('безвозвратное удаление: единица измерения');
    }
}
