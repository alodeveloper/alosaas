<?php

namespace App\Listeners;

use App\Events\InvitationSentEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class InviteEventListener
{
  //protected $mailer;

  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    //$this->mailer = mailer;
  }

  /**
   * Handle the event.
   *
   * @param  InvitationSentEvent  $event
   * @return void
   */
  public function handle(InvitationSentEvent $event)
  {
    Mail::send('emails.welcome', ['invitation' => $event->invitation], function ($message) {
      $message->to('support@alobin.com');
    });
  }
}
