<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeToSite extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;

        return $this->view('mails.welcome', compact('user'));
    }
}
