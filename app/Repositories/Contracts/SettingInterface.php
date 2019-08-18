<?php


namespace App\Repositories\Contracts;


interface SettingInterface
{

    /**
     * @param string $pattern
     * @return mixed
     */
    public function changeUrlBlockPattern($pattern='');
}