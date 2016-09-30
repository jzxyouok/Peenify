<?php

namespace App\Foundation;

use App\Favorite;
use App\User;

trait Favoriteable
{
    /**
     * Laravel related
     * @return mixed
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoriteable');
    }

    /**
     * @param Favorite $favorite
     * @return mixed
     */
    public function giveFavoriteTo(Favorite $favorite)
    {
        return $this->favorites()->save($favorite);
    }

    /**
     * @param Favorite $favorite
     * @return mixed
     */
    public function removeFavoriteTo(Favorite $favorite)
    {
        return $this->favorites()->delete($favorite);
    }

    /**
     * 新建
     * @param User $user
     * @return mixed
     */
    public function giveFavoriteToUser(User $user)
    {
        return $this->giveFavoriteTo(new Favorite([
            'user_id' => $user->id
        ]));
    }

    /**
     * 移除
     * @param User $user
     * @return mixed
     */
    public function removeFavoriteToUser(User $user)
    {
        return $this->removeFavoriteTo(new Favorite([
            'user_id' => $user->id
        ]));
    }

    /**
     * 使用者是否有資料
     * @param User $user
     * @return bool
     */
    public function isExistFavoriteByUser(User $user)
    {
        return (bool) $this->favorites()->where('user_id', $user->id)->count();
    }
}