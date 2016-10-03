<?php

namespace App\Foundation;

use App\Subscribe;
use App\User;

trait Subscribable
{
    public function subscribes()
    {
        return $this->morphMany(Subscribe::class, 'subscribable');
    }

    public function subscribe(User $user)
    {
        return $this->subscribes()->save(new Subscribe(['user_id' => $user->id]));
    }

    public function describe(User $user)
    {
        return $this->subscribes()->delete(new Subscribe(['user_id' => $user->id]));
    }

    public function isSubscribe(User $user)
    {
        return (bool) $this->subscribes()->where('user_id', $user->id)->exists();
    }
}