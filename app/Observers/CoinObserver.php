<?php

namespace App\Observers;

use App\Models\Coin;
use Illuminate\Support\Facades\Cache;

class CoinObserver
{
    /**
     * Handle the Coin "created" event.
     *
     * @param  \App\Models\Coin  $coin
     * @return void
     */
    public function created(Coin $coin)
    {
        Cache::forget('list_coins');
    }

    /**
     * Handle the Coin "updated" event.
     *
     * @param  \App\Models\Coin  $coin
     * @return void
     */
    public function updated(Coin $coin)
    {
        Cache::forget('list_coins');
    }

    /**
     * Handle the Coin "deleted" event.
     *
     * @param  \App\Models\Coin  $coin
     * @return void
     */
    public function deleted(Coin $coin)
    {
        Cache::forget('list_coins');
    }

    /**
     * Handle the Coin "restored" event.
     *
     * @param  \App\Models\Coin  $coin
     * @return void
     */
    public function restored(Coin $coin)
    {
        //
    }

    /**
     * Handle the Coin "force deleted" event.
     *
     * @param  \App\Models\Coin  $coin
     * @return void
     */
    public function forceDeleted(Coin $coin)
    {
        //
    }
}
