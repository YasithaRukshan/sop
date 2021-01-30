<?php

namespace App\Console\Commands;

use domain\Facades\ETHPaymentFacade;
use domain\Facades\TransactionFacade;
use Illuminate\Console\Command;

class initETHTransactionChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:EthTransactionChecker';

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
        ETHPaymentFacade::initScheduledTransactionChecker();
        return 0;
    }
}
