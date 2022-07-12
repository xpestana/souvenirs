<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DisplayReceiver extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $appName;
    public $appUrl;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
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
        return $this->subject(config('app.name') . " - Requerimiento de Display ". $this->data['user']['name'])->view('Mails.display');
    }
}
