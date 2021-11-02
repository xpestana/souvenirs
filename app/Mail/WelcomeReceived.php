<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $password;
    public $appName;
    public $appUrl;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
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
        return $this->subject(config('app.name') . " - Registro ". $this->user->name)->view('Mails.welcome');
    }
}
