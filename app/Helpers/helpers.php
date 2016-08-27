<?php

if (! function_exists('image_path')) {
    function image_path($path, $id, $name)
    {
        return Storage::disk('public')->url(str_replace('.', '/', $path). '/' . $id . '/' . $name);
    }
}