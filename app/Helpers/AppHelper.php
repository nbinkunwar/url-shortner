<?php

/**
 * gets setting value by key
 */
if (!function_exists('setting')) {
    function    setting($key,$default = null)
    {
        return App\Services\Settings\Facade\AppSetting::get($key, $default);
    }
}