<?php

namespace App\Listeners;

use Mail;
use App\Mail\SurveryForm;
use App\Events\FormProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailNotification
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
    public function handle(FormProcessed $event): void
    {
        Mail::to($event->email)->send(new SurveryForm($event->form, $event->link));
    }
}
