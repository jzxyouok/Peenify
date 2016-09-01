<?php

namespace App\Extensions;

use App\Emoji;

trait EmojiableTrait
{
    public function emojis()
    {
        return $this->morphMany(Emoji::class, 'emojiable');
    }

    public function createEmoji($instance, $attributes)
    {
        return $instance->emojis()->save(new Emoji($attributes));
    }

    public function updateEmoji($instance, $attributes)
    {
        return $instance->emojis()->where('user_id', $attributes['user_id'])->update(['type' => $attributes['type']]);
    }

    public function deleteEmoji($instance, $attributes)
    {
        return $instance->emojis()->delete(new Emoji($attributes));
    }

    public function isExistEmoji($instance, $user_id)
    {
        return (bool) $instance->emojis()->where('user_id', $user_id)->count();
    }

    public function updateOrDeleteEmoji($instance, $attributes)
    {
        if ($instance->emojis()->first()->type == $attributes['type']) {
            return $this->deleteEmoji($instance, $attributes);
        }
        return $this->updateEmoji($instance, $attributes);
    }

    public function syncEmoji($id, $attributes)
    {
        $instance = $this->find($id);

        if ($this->isExistEmoji($instance, $attributes['user_id'])) {
            $this->updateOrDeleteEmoji($instance, $attributes);

            return false;
        }

        $this->createEmoji($instance, $attributes);

        return true;
    }
}