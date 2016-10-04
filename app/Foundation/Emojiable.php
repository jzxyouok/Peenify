<?php

namespace App\Foundation;

use App\Emoji;
use App\User;

trait Emojiable
{
    public function emojis()
    {
        return $this->morphMany(Emoji::class, 'emojiable');
    }

    public function emoji(User $user, $type)
    {
        return $this->emojis()->save(new Emoji(['user_id' => $user->id, 'type' => $type]));
    }

    public function unEmoji(User $user)
    {
        return $this->emojis()->delete(new Emoji(['user_id' => $user->id]));
    }

    public function updateEmoji(User $user, $type)
    {
        return $this->emojis()->where('user_id', $user->id)->update(['type' => $type]);
    }

    public function isEmoji(User $user)
    {
        if (array_key_exists(1, func_get_args())) {
            return $this->emojis()->where(['user_id' => $user->id, 'type' => func_get_arg(1)])->exists();
        }

        return $this->emojis()->where(['user_id' => $user->id])->exists();
    }

    public function countEmoji(User $user, $type)
    {
        return $this->emojis()->where(['user_id' => $user->id, 'type' => $type])->count();
    }

    public function getEmoji($column = 'type')
    {
        return $this->emojis()->first((array)$column)->{$column};
    }
}