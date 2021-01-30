<?php

namespace domain\ProductionService\ProductionServices;

use App\Events\ProductionInitEvent;
use App\Models\Production;
use domain\Facades\ContractProductionFacade;
use domain\Facades\ContractsFacade;
use domain\Facades\OilPriceFacade;
use domain\Facades\ProductionFacade;
use domain\Facades\WalletFacade;

class ProductionManagementService
{
    public function __construct()
    {
    }

    /**
     * Initialize Production Jobs Via Cron Schedule
     *
     * @return void
     */
    public function iniProduction()
    {
        $portfolio_production = ProductionFacade::getAllNew();
        foreach ($portfolio_production as $key => $production) {
            // event(new ProductionInitEvent($production->id));
            ProductionFacade::update($production, ['status' => Production::USERSTATUS['JOBCREATED']]);
            $this->shareTheProductions($production->id);
        }
    }
    /**
     * share The Productions across the users who staked
     *
     * @param  mixed $production_id
     * @return void
     */
    public function shareTheProductions($production_id)
    {
        $production = ProductionFacade::get($production_id);
        if ($production) {
            $resp = $this->generateShare($production);
            if ($resp['status'] == true) {
                ProductionFacade::update($production, ['status' => Production::USERSTATUS['COMPLETED']]);
            }
        }
    }
    /**
     * generate Share
     *
     * @param  mixed $production
     * @return void
     */
    public function generateShare($production)
    {
        $contracts = ContractsFacade::getByPortFolio($production->portfolio_id);
        $oil_price = OilPriceFacade::currentPrice();
        if ($oil_price) {
            foreach ($contracts as $key => $contract) {
                $this->storeShare($contract, $oil_price, $production);
            }
            $resp = ['status' => true];
        } else {
            // TODO:RUn exception
            $resp = ['status' => false];
        }
        return $resp;
    }
    /**
     * Store Share
     *
     * @param  mixed $contract
     * @param  mixed $oil_price
     * @param  mixed $production
     * @return void
     */
    public function storeShare($contract, $oil_price, $production)
    {
        //calculate share
        $share = ($production->count_of_barrel) * ($contract->amount / $contract->Portfolio->price);
        if (!ContractProductionFacade::getByContractProduction($contract->id,$production->id)) {
            # code...
            $contractProduction = ContractProductionFacade::make([
                'contract_id' => $contract->id,
                'production_id' => $production->id,
                'oil_price_id' => $oil_price->id,
                'customer_id' => $contract->Customer->id,
                'date' => $production->date,
                'amount' => round($share,4),
            ]);

            $wallet = $contract->Customer->wallet;
            WalletFacade::update($wallet,[
                'tp_sopx' => $wallet->tp_sopx+round($share,4),
            ]);
            return $contractProduction;
        }
    }
}
