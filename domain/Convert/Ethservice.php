<?php

namespace domain\Convert;

use App\Models\EthGasRate;
use App\Models\EthRate;

class EthService
{
    protected $eth_rate;
    protected $eth_gas_rate;

    const fixed_cost = 3;
    const fixed_rate = 1;
    public function __construct()
    {
        $this->eth_rate = new EthRate();
        $this->eth_gas_rate = new EthGasRate();
    }
    /**
     * getLastEthRate
     *
     * @return void
     */
    public function getLastEth()
    {
        $ethValue = $this->eth_rate->latest('created_at')->first();
        return $ethValue;
    }
    /**
     * getLastEthRate
     *
     * @return void
     */
    public function getLastEthRate($usd)
    {
        $ethValue = $this->eth_rate->latest('created_at')->first();
        return ($usd * $ethValue->rate);
    }
    /**
     * getLastUSDRate
     *
     * @param  mixed $usd
     * @return void
     */
    public function getLastUSDRate($eth)
    {
        $ethValue = $this->eth_rate->latest('created_at')->first();
        return ($eth / $ethValue->rate);
    }
    /**
     * get Gas Cost
     *
     * @return EthGasRate
     */
    public function getGasCost()
    {
        return $this->eth_gas_rate->latest('created_at')->first();
    }
    /**
     * getHandlingFee
     *
     * @param  mixed $requested_usd
     * @return mixed
     */
    public function getHandlingFee($requested_usd)
    {
        $fee = self::fixed_cost + $this->getGasCost()->rate + ($requested_usd * 0.01);
        return ['usd_fee' => $fee, 'fee' => $this->getLastEthRate($fee)];
    }
}
