<?php

namespace App\Traits;

use domain\Facades\ContractsFacade;
use Illuminate\Support\Str;

trait StakingHelper
{
    /**
     * getAuthContractsAmount
     *
     * @return void
     */
    /**
     * getAuthContractsAmount
     *
     * @return void
     */
    public function getAuthContractsAmount($formatted = false)
    {
        if ($formatted) {
            # code...
            return number_format(ContractsFacade::getAuthContractsAmount());
        } else {
            return ContractsFacade::getAuthContractsAmount();
        }
    }
    /**
     * totalContracts
     *
     * @return void
     */
    public function totalContracts()
    {
        return ContractsFacade::totalContracts();
    }
    /**
     * totalProductionCount
     *
     * @return void
     */
    public function totalProductionCount()
    {
        return ContractsFacade::totalProductionCount();
    }
}
