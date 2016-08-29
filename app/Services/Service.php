<?php

namespace App\Services;

abstract class Service
{
    public function authUser($attributes)
    {
        return array_add($attributes, 'user_id', auth()->user()->id);
    }
}