<?php

namespace App\Extensions;

trait syncFollowToUser
{
    public function syncFollow($followable_type, $followable_id, $attributes)
    {
        $instance = app(ucfirst('App\\' . $followable_type));

        return $instance->syncFollow($followable_id, array_add($attributes, 'user_id', auth()->user()->id));
    }
}