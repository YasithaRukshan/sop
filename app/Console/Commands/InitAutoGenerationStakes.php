<?php

namespace App\Console\Commands;

use domain\Facades\ContractsFacade;
use Illuminate\Console\Command;

class InitAutoGenerationStakes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:autoStake';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize Auto Stake Generation';

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
        ContractsFacade::autoStake();
        return 0;
    }
}
