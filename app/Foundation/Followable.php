<?php

namespace App\Foundation;

use App\Follow;

trait Followable
{
    public function follows()
    {
        return $this->morphMany(Follow::class, 'followable');
    }

    public function createFollow($instance, $attributes)
    {
        return $instance->follows()->save(new Follow($attributes));
    }

    public function deleteFollow($instance, $attributes)
    {
        return $instance->follows()->delete(new Follow($attributes));
    }

    public function isExistFollow($instance, $user_id)
    {
        return (bool) $instance->follows()->where('user_id', $user_id)->count();
    }

    public function syncFollow($id, $attributes)
    {
        $instance = $this->find($id);

        if ($this->isExistFollow($instance, $attributes['user_id'])) {
            $this->deleteFollow($instance, $attributes);

            return false;
        }

        $this->createFollow($instance, $attributes);

        return true;
    }

}