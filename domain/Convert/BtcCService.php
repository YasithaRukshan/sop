<?php

namespace domain\Convert;

use App\Models\BtcRate;
use App\Models\EthRate;

class BtcCService
{
    protected $btc_rate;

    public function __construct()
    {
        $this->btc_rate = new BtcRate();
    }
    /**
     * getLastEthRate s
     *
     * @return void
     */
    public function getLastBTCRate()
    {
        return $this->btc_rate->latest('created_at')->first();
    }
    /**
     * getLastEthRate
     *
     * @param  mixed $usd
     * @return void
     */
    public function getLastBTCToDollarRate($btc)
    {
        $btc_rate = $this->btc_rate->latest('created_at')->first();
        return (round($btc * ($btc_rate->rate * 1), 2));
    }
}
