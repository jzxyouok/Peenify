<?php

namespace App\Foundation;

use App\Favorite;
use App\User;

trait Favorable
{
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorable');
    }

    public function favorite(User $user)
    {
        return $this->favorites()->save(new Favorite(['user_id' => $user->id]));
    }

    public function unFavorite(User $user)
    {
        return $this->favorites()->delete(new Favorite(['user_id' => $user->id]));
    }

    public function isFavorite(User $user)
    {
        return $this->favorites()->where('user_id', $user->id)->exists();
    }
}