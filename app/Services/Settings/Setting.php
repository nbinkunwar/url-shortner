<?php


namespace App\Services\Settings;


class Setting
{

    public $setting_cache = null;

    /**
     * Gets setting key
     * @param $key
     * @param null $default
     * @return null
     */
    public function get($key,$default = null)
    {
        if ($this->setting_cache === null) {
            $this->setSetting();
        }
        return @$this->setting_cache[$key]?? $default;
    }

    /**
     * Sets setting value
     *
     */
    protected function setSetting()
    {
        $model = new \App\Models\Setting();
        $res = $model->all();
        $result = [];
        $res->map(function ($item) use (&$result){
            $result[$item->key] = $item->value;
        });

        @$this->setting_cache = $result;
    }
}