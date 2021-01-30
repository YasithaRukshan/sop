<?php

namespace App\Console\Commands;

use domain\Facades\ProductionManagementFacade;
use Illuminate\Console\Command;

class initProduction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:production';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize Production';

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
        ProductionManagementFacade::iniProduction();
        return "completed";
    }
}
