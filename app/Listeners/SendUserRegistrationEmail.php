<?php

namespace App\Listeners;

use App\Events\UserRegistration;
use App\Mail\TestMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUserRegistrationEmail
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
     * @param  UserRegistration  $event
     * @return void
     */
    public function handle(UserRegistration $event)
    {
        // $event->user;
        dd('asdasdadasdasdasdasd');
        Mail::to('csabak.balazs@fotex.net')->send(new TestMail($event->user));
    }
}
