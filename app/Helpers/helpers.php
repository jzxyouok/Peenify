<?php

use Illuminate\Http\UploadedFile;

if (!function_exists('image_path')) {
    /**
     * @param $prefix
     * @param $name
     * @return string
     */
    function image_path($prefix, $name)
    {
        return Storage::disk('public')->url(str_replace('.', '/', $prefix) . '/' . $name);
    }
}

if (!function_exists('upload_image')) {
    /**
     * @param $path
     * @param UploadedFile $file
     * @return string
     */
    function upload_image($path, UploadedFile $file)
    {
        $filename = $file->hashName();

        $file->storePubliclyAs('public/' . str_replace('.', '/', $path), $filename);

        return $filename;
    }
}

if (!function_exists('update_image')) {
    /**
     * @param \Illuminate\Http\Request $request
     * @param $key
     * @param $path
     * @return array
     * @internal param $value
     */
    function update_image(\Illuminate\Http\Request $request, $key, $path)
    {
        $data = $request->all();

        if (array_key_exists($key, $data)) {
            return array_set($data, $key, upload_image($path, $request->file($key)));
        }

        return $data;
    }
}

if (!function_exists('options_isEmpty')) {
    /**
     * @param $attributes
     * @return bool
     * check attributes is empty.
     */
    function options_isEmpty($attributes)
    {
        if (is_string($attributes) OR is_null($attributes)) {
            return empty($attributes);
        }

        return empty(array_filter($attributes));
    }
}


if (!function_exists('parse_time')) {
    /**
     * @param $time
     * @return string
     * 用於轉換字串的時間，目前僅取用到年月日
     */
    function parse_time($time)
    {
        return \Carbon\Carbon::parse($time)->toDateString();
    }
}

