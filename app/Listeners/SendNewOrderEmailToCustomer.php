<?php

namespace App\Providers;

use App\Mail\NewOrderMailToCustomer;
use App\Events\NewOrderEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewOrderEmailToCustomer
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  NewOrderEvent  $event
     * @return void
     */
    public function handle(NewOrderEvent $event)
    {
        Mail::to('balazs.csabak@gmail.com')->send(new NewOrderMailToCustomer($event->user, $event->order));
    }
}
