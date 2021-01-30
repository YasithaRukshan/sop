<?php

namespace domain\Wallet;

use App\Models\SOAXContract;
use App\Models\Wallet;

class SmartContractService
{
    protected $member_soax;
    public function __construct()
    {
        $this->member_soax = new SOAXContract();

    }

    /**
     * all
     *
     * @return void
     */
    public function newSoaxSC($wallet)
    {
        if(!$wallet->soaxContract){



        }
    }

    /**
     * create
     *
     * @param  mixed $data
     * @return void
     */
    public function create(array $data){
        return $this->member_soax->create($data);
    }

}
