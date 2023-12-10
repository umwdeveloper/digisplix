<?php

namespace App\Listeners;

use App\Events\TwoFaEvent;
use App\Mail\TwoFA;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class TwoFaListener {
    /**
     * Create the event listener.
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TwoFaEvent $event): void {
        Mail::to($event->user->email)->send(new TwoFA($event->code));
    }
}
