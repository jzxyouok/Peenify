<?php

namespace App\Foundation;

use App\User;
use App\Wish;

trait Wishable
{
    public function wishes()
    {
        return $this->morphMany(Wish::class, 'wishable');
    }

    public function wish(User $user)
    {
        return $this->wishes()->save(new Wish(['user_id' => $user->id]));
    }

    public function unWish(User $user)
    {
        return $this->wishes()->delete(new Wish(['user_id' => $user->id]));
    }

    public function isWish(User $user)
    {
        return $this->wishes()->where('user_id', $user->id)->exists();
    }
}