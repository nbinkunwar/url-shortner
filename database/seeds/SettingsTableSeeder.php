<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new \App\Models\Setting();
        $setting->key = 'url_black_list_pattern';
        $setting->label = 'Url Black List Pattern';
        $setting->value = '/\invalid.com\b/';
        $setting->save();

    }

}