<?php

namespace App\Listeners;

use App\Events\UserAccountEvent;
use App\Notifications\UserAccountNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;

//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Queue\InteractsWithQueue;

class UserAccountListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserAccountEvent $event): void
    {
        $event->user->notify(new UserAccountNotification($event->user, $event->data));
    }
}
