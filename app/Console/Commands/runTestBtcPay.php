<?php

namespace App\Console\Commands;

use App\Models\TestData;
use domain\Facades\BTCPaymentFacade;
use Illuminate\Console\Command;

class runTestBtcPay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:testBtcPay';

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
        $arr = ["C479aiHkkbNUJtS628a51q", "TVWdy8kFHykcZaVyNorNd2", "87cwfjC8LurLdhLwrZRZNZ"];
        foreach ($arr as $d) {
            $testData = BTCPaymentFacade::getInvoice($d);
            unset($testData['metadata']);
            unset($testData['checkout']);
            TestData::create(["data"=>implode(" -|- ", $testData)]);
        }
        return 1;
    }
}
