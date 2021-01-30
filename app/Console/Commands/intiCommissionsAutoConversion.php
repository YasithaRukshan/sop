<?php

namespace App\Console\Commands;

use domain\Facades\AutoConversionFacades\CommissionsAutoConversionFacade;
use Illuminate\Console\Command;

class intiCommissionsAutoConversion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:commissionsConversion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize Commissions Auto Conversion';

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        CommissionsAutoConversionFacade::initCommissions();
        return "completed";
    }
}
