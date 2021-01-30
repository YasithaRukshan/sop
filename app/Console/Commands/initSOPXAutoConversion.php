<?php

namespace App\Console\Commands;

use domain\Facades\SOPXAutoConversionFacade;
use Illuminate\Console\Command;

class initSOPXAutoConversion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:sopxConversion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize SOPX Auto Conversion';

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
       SOPXAutoConversionFacade::initTransactions();
        return "completed";
    }
}
