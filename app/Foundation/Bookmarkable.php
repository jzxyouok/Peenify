<?php

namespace App\Foundation;

use App\Bookmark;
use App\User;

trait Bookmarkable
{
    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function bookmark(User $user)
    {
        return $this->bookmarks()->save(new Bookmark(['user_id' => $user->id]));
    }

    public function removeBookmark(User $user)
    {
        return $this->bookmarks()->delete(new Bookmark(['user_id' => $user->id]));
    }

    public function isBookmark(User $user)
    {
        return $this->bookmarks()->where('user_id', $user->id)->exists();
    }
}