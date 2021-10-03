<?php

namespace App\Providers;

use App\Events\CancelledOrderByCustomerEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\NewOrderEvent;
use App\Listeners\SendCancelledOrderNotificationToShopOwner;
use App\Listeners\SendNewOrderEmailToCustomer;
use App\Listeners\SendUserRegistrationEmail;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // UserRegistration::class => [
        //     SendNewOrderEmailToCustomer::class,
        //     SendUserRegistrationEmail::class,
        // ],
        NewOrderEvent::class => [
            SendNewOrderEmailToCustomer::class,
            SendNewOrderEmailToShopOwner::class,
        ],
        CancelledOrderByCustomerEvent::class => [
            SendCancelledOrderNotificationToShopOwner::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
