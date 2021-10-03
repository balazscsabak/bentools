<?php

namespace App\Listeners;

use App\Events\CancelledOrderByCustomerEvent;
use App\Mail\OrderCancelledMail;
use App\Models\Errors;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendCancelledOrderNotificationToShopOwner
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
     * @param  CancelledOrderByCustomerEvent  $event
     * @return void
     */
    public function handle(CancelledOrderByCustomerEvent $event)
    {
        Mail::to(env('SHOW_OWNER_EMAIL'))->send(new OrderCancelledMail($event->order));
    }
}
