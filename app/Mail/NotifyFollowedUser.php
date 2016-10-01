<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyFollowedUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    private $followed;
    /**
     * @var User
     */
    private $follower;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $followed, User $follower)
    {
        $this->followed = $followed;
        $this->follower = $follower;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $followed = $this->followed;

        $follower = $this->follower;

        return $this->view('mails.followed', compact('followed', 'follower'));
    }
}
