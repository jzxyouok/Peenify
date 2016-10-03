<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscribedUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    private $subscribed;
    /**
     * @var User
     */
    private $subscriber;

    /**
     * Create a new message instance.
     *
     * @param User $subscribed
     * @param User $subscriber
     * @internal param User $user
     */
    public function __construct(User $subscribed, User $subscriber)
    {
        $this->subscribed = $subscribed;
        $this->subscriber = $subscriber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subscribed = $this->subscribed;

        $subscriber = $this->subscriber;

        return $this->view('mails.subscribe', compact('subscribed', 'subscriber'));
    }
}
