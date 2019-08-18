<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $models = [
            'Link',
            'Setting'
        ];
        foreach ($models as $model)
        {
            $this->app->bind("App\Repositories\Contracts\\".$model."Interface",
                "App\Repositories\Eloquent\\".$model."Repository");
        }
    }
}