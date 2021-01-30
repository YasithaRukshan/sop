<?php

namespace App\Http\Livewire;

use domain\Facades\Convert\BtcRateFacade;
use domain\Facades\Convert\EthRateFacade;
use domain\Facades\OilPriceFacade;
use domain\Facades\WalletFacade;
use Livewire\Component;

class Ticker extends Component
{
    public $oil_price;
    public $sopx;
    public $btc;
    public $eth;

    public function render()
    {
        return view('MemberArea.Includes.ticker');
    }

    public function mount()
    {
        $this->oil_price = OilPriceFacade::currentPrice();
        $this->sopx = OilPriceFacade::currentPrice();
        $this->btc = BtcRateFacade::getLastBTCRate();
        $this->eth = EthRateFacade::getLastEth();
    }
}
