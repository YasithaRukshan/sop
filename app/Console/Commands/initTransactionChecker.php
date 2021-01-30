<?php

namespace App\Console\Commands;

use domain\Facades\BTCPaymentFacade;
use Illuminate\Console\Command;

class initTransactionChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:transactionChecker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        BTCPaymentFacade::initScheduledTransactionChecker();
        return "Successfully Initialized";
    }
}
