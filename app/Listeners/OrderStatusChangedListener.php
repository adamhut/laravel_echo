<?php

namespace App\Listeners;

use App\Events\OrderStatusChanged;

class OrderStatusChangedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param OrderStatusChanged $event
     *
     * @return void
     */
    public function handle(OrderStatusChanged $event)
    {
        //
    }
}
