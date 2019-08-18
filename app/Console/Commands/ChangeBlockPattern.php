<?php

namespace App\Console\Commands;

use App\Repositories\Contracts\SettingInterface;
use Illuminate\Console\Command;

class ChangeBlockPattern extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blockpattern:change {pattern}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change Url Black List Pattern';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param SettingInterface $setting
     * @throws \Exception
     */
    public function handle(SettingInterface $setting)
    {
        $pattern = $this->argument('pattern');
        if(!$this->isRegularExpression($pattern)){
            throw new \Exception('Invalid Regex Pattern: '.$pattern);
        }
        $setting->changeUrlBlockPattern($pattern);
    }


    /**
     * Checks if regex is valid
     * @param $string
     * @return bool
     */
    protected function isRegularExpression($string)
    {
        set_error_handler(function () {
        }, E_WARNING);
        $isRegularExpression = preg_match($string, "") !== FALSE;
        restore_error_handler();
        return $isRegularExpression;

    }
}
