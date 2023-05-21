<?php

namespace App\Observers;

use App\Models\Act;

class ActObserver
{
    /**
     * Handle the Act "created" event.
     *
     * @param  \App\Models\Act  $act
     * @return void
     */
    public function created(Act $act)
    {
        $act->user()->associate(auth()->user());//todo: не работает
    }

    /**
     * Handle the Act "updated" event.
     *
     * @param  \App\Models\Act  $act
     * @return void
     */
    public function updated(Act $act)
    {
 //

    }

    /**
     * Handle the Act "deleted" event.
     *
     * @param  \App\Models\Act  $act
     * @return void
     */
    public function deleted(Act $act)
    {
        //
    }

    /**
     * Handle the Act "restored" event.
     *
     * @param  \App\Models\Act  $act
     * @return void
     */
    public function restored(Act $act)
    {
        //
    }

    /**
     * Handle the Act "force deleted" event.
     *
     * @param  \App\Models\Act  $act
     * @return void
     */
    public function forceDeleted(Act $act)
    {
        //
    }
}
