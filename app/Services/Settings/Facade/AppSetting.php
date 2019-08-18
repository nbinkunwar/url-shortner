<?php


namespace App\Services\Settings\Facade;


use Illuminate\Support\Facades\Facade;

class AppSetting extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'setting';
    }

}