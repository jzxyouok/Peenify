<?php

if (! function_exists('image_path')) {
    function image_path($name)
    {
        return Storage::disk('public')->url($name);
    }
}