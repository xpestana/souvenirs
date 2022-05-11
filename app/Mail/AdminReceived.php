<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $appName;
    public $appUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
        $this->appName = config('app.name');
        $this->appUrl = config('app.url');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(config('app.name') . " - Compra ". $this->order->transaction_id)->view('Mails.NotifyAdmin');
    }
}
