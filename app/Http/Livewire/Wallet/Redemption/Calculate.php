<?php

namespace App\Http\Livewire\Wallet\Redemption;

use App\Traits\UtilityHelper;
use App\Traits\WalletHelper;
use domain\Facades\Convert\EthRateFacade;
use domain\Facades\OilPriceFacade;
use domain\Facades\WalletFacade;
use Livewire\Component;

class Calculate extends Component
{
    use UtilityHelper;
    public $withdrawalAmount;
    public $maxAmount;
    public $amount;
    // public $btcValue;
    public $ethValue;
    public $soaxValue;
    public $usdValue;
    public $sopxAmount;
    public $oilPrice;
    public $handelingfee;
    public $currencyType;
    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        $this->sopxAmount = $this->amount;
        $this->currencyType = '1';
        return view('MemberArea.Pages.Wallet.Withdrawals.Components.LiveWire.Create.calculate');
    }

    /**
     * convertCurrency
     *
     * @return void
     */
    public function convertCurrency()
    {
        $tempOilPrice = OilPriceFacade::getLastPrice();
        if ($tempOilPrice) {
            $this->oilPrice = $tempOilPrice['price'];
        } else {
            $this->oilPrice = 45;
        }
        $this->usdValue = ($this->sopxAmount * ($this->oilPrice - 18));

        $this->ethValue = EthRateFacade::getLastEthRate($this->usdValue);
        $this->soaxValue = ($this->usdValue / config('payments.soax_to_usd'));
        $this->handlingFee =  EthRateFacade::getHandlingFee($this->usdValue);
    }

    /**
     * getCurrency
     *
     * @return void
     */
    public function getCurrency()
    {
        $this->convertCurrency();
        $data = array();
        $data['oilPrice'] =  $this->oilPrice;
        $data['usdValue'] =  $this->usdValue;
        // $data['btcValue'] =  $this->btcValue;
        $data['ethValue'] =  $this->ethValue;
        $data['soaxValue'] =   $this->soaxValue;
        $data['sopxAmount'] =   $this->sopxAmount;
        $data['handlingFee'] =  $this->handlingFee;
        $this->emit('dataSet', $data);
        $this->emit('removeDisabledBtn');
    }

    /**
     * updateAmount
     *
     * @param  mixed $amount
     * @return void
     */
    public function updateAmount($amount, $type)
    {
        $this->sopxAmount = $amount;
        $this->currencyType = $type;
        $this->convertCurrency();
        $this->getCurrency();
    }
}
