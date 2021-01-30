<?php

namespace domain\ProductionService\ProductionServices;

use App\Models\Production;
use App\Models\ScAccount;
use domain\Facades\MemberExWalletFacade;

class ProductionService
{
    protected $production;
    public function __construct()
    {
        $this->production = new Production();
    }
    /**
     * Get All New
     *
     * @return void
     */
    public function getAllNew(){
        return $this->production->getAllNew();
    }
    /**
     * Get By Id
     *! this method is used inside job don't change anything here
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->production->find($id);
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
        return $this->production->create($date);
    }
    /**
     * update
     *
     * @param  Production $production
     * @param  mixed $data
     * @return void
     */
    public function update(Production $production, array $data)
    {
        $production->update($this->edit($production, $data));
    }
    /**
     * edit
     *
     * @param  Production $production
     * @param  mixed $data
     * @return mixed
     */
    public function edit(Production $production, array $data)
    {
        return array_merge($production->toArray(), $data);
    }
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $production = $this->get($id);
        $production->delete();
    }

    /**
     * get all production by portfolio
     *
     * @return void
     */
    public function getProductionByPortfolio($portfolio_id){
        return $this->production->getProductionByPortfolio($portfolio_id);
    }
}
