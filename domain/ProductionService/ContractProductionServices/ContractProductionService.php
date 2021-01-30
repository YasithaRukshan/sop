<?php

namespace domain\ProductionService\ContractProductionServices;

use App\Models\ContractProduction;

class ContractProductionService
{
    protected $contract_production;
    public function __construct()
    {
        $this->contract_production = new ContractProduction();
    }
    /**
     * get
     *
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->contract_production->find($id);
    }
    /**
     * Get By User Rate Null
     *
     * @param  mixed $customer_id
     * @return void
     */
    public function getByUserRateNull($customer_id)
    {
        return $this->contract_production->getByUserRateNull($customer_id);
    }

    /**
     * make
     *
     * @param  mixed $date
     * @return void
     */
    public function make($data)
    {
        return $this->create($data);
    }
    /**
     * create
     *
     * @param  mixed $date
     * @return void
     */
    public function create($date)
    {
        return $this->contract_production->create($date);
    }
    /**
     * update
     *
     * @param  ContractProduction $contract_production
     * @param  mixed $data
     * @return void
     */
    public function update(ContractProduction $contract_production, array $data)
    {
        $contract_production->update($this->edit($contract_production, $data));
    }
    /**
     * edit
     *
     * @param  ContractProduction $contract_production
     * @param  mixed $data
     * @return mixed
     */
    public function edit(ContractProduction $contract_production, array $data)
    {
        return array_merge($contract_production->toArray(), $data);
    }
    public function getByContractProduction($contract_id, $production_id)
    {
        return $this->contract_production->getByContractProduction($contract_id, $production_id);
    }
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $contract_production = $this->get($id);
        $contract_production->delete();
    }
}
