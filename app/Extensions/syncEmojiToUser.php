<?php

namespace App\Extensions;

trait syncEmojiToUser
{
    public function syncEmoji($emojiable_type, $emojiable_id, $attributes)
    {
        $instance = app(ucfirst('App\\' . $emojiable_type));

        return $instance->syncEmoji($emojiable_id, array_add($attributes, 'user_id', auth()->user()->id));
    }
}