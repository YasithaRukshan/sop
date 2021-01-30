<?php

namespace App\Http\Livewire\Socialimpact;

use App\Traits\UtilityHelper;
use App\Traits\WalletHelper;
use domain\Facades\Convert\EthRateFacade;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Redemption extends Component
{
    use WalletHelper;
    use UtilityHelper;
    public $withdrawalAmount;
    public $amount;
    public $btcValue;
    public $ethValue;
    public $soaxValue;
    public $usdValue;
    public $Amount;
    public $handlingFee;
    public $currencyType;
    public $maxEthValue;
    public $address;
    public $lastEth;

    public function render()
    {
        $this->withdrawalAmount = Auth::user()->wallet->rw_amount;
        $this->lastEth = EthRateFacade::getLastEth();
        $this->maxEthValue = (float)($this->lastEth['rate'] * (float)($this->withdrawalAmount));
        $this->minEthValue = $this->lastEth['rate'] * (float) config("payments.redeem.minimum_share");
        return view('MemberArea.Pages.SocialImpact.Redemptions.Components.LiveWire.redemption');
    }

    /**
     * convertCurrency
     *
     * @return void
     */
    public function convertCurrency()
    {
        $this->ethValue = $this->Amount;
        $this->usdValue =   (float)$this->ethValue / $this->lastEth['rate'];
        $this->handlingFee =  EthRateFacade::getHandlingFee($this->usdValue);
        $this->soaxValue = ($this->usdValue / config('payments.soax_to_usd'));
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
        $data['usdValue'] =  $this->usdValue;
        // $data['btcValue'] =  $this->btcValue;
        $data['ethValue'] =  $this->ethValue;
        $data['soaxValue'] =   $this->soaxValue;
        $data['Amount'] =   $this->Amount;
        $data['maxEthValue'] =   $this->maxEthValue;
        $data['address'] =   $this->address;
        $data['handlingFee'] =   $this->handlingFee;
        $this->emit('dataSet', $data);
    }

    /**
     * updateAmount
     *
     * @param  mixed $amount
     * @return void
     */
    public function updateAmount($amount, $type, $address)
    {
        $this->Amount = $amount;
        $this->address = $address;
        $this->currencyType = $type;
        $this->convertCurrency();
        $this->getCurrency();
    }
}
