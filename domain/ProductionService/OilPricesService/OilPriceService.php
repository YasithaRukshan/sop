<?php

namespace domain\ProductionService\OilPricesService;

use App\Models\OilPrice;
use App\Models\Production;
use App\Models\ScAccount;
use domain\Facades\MemberExWalletFacade;

class OilPriceService
{
    protected $oil_price;
    public function __construct()
    {
        $this->oil_price = new OilPrice();
    }
    /**
     * Get All New
     *
     * @return void
     */
    public function getAllNew(){
        return $this->oil_price->getAllNew();
    }
    /**
     * Get By Id
     *! this method is used inside job don't change anything here
     * @param  mixed $id
     * @return mixed
     */
    public function currentPrice()
    {
        return $this->oil_price->latest('created_at')->first();
    }
    /**
     * Get By Id
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->oil_price->find($id);
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
        return $this->oil_price->create($date);
    }
    /**
     * update
     *
     * @param  OilPrice $oil_price
     * @param  mixed $data
     * @return void
     */
    public function update(OilPrice $oil_price, array $data)
    {
        $oil_price->update($this->edit($oil_price, $data));
    }
    /**
     * edit
     *
     * @param  OilPrice $oil_price
     * @param  mixed $data
     * @return mixed
     */
    public function edit(OilPrice $oil_price, array $data)
    {
        return array_merge($oil_price->toArray(), $data);
    }
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $oil_price = $this->get($id);
        $oil_price->delete();
    }
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function getLastPrice()
    {
        return $this->oil_price->latest('created_at')->first();
    }
}
