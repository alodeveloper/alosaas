<?php
namespace App\Listeners;

use Session;
use AccountUtil;

class UserEventListener {

    /**
     * Handle user login events.
     *
     */
    public function onUserLogin($event)
    {
      if(count($event->user->accounts) > 0) {
        Session::put('currentAccounts', $event->user->accounts);
        AccountUtil::current($event->user->accounts->first());
      }
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event)
    {
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventListener@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventListener@onUserLogout'
        );
    }

}
