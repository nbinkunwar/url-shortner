<?php

namespace App\Console\Commands;

use App\Repositories\Contracts\LinkInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ExpireLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'links:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set links as expired';

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
     * @param LinkInterface $link
     */
    public function handle(LinkInterface $link)
    {
        $current_date_time =  Carbon::now()->toDateTimeString();
        $link->setLinksExpired($current_date_time);
    }
}
