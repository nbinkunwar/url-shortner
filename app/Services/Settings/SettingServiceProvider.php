<?php
namespace App\Services\Settings;

use Carbon\Laravel\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton('setting', function () {
            return new Setting();
        });
    }

}