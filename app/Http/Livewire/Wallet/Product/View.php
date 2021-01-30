<?php

namespace App\Http\Livewire\Wallet\Product;

use App\Traits\UtilityHelper;
use domain\Facades\ContractsFacade;
use Livewire\Component;

class View extends Component
{
    use UtilityHelper;
    public $contracts;

    /**
     * mount
     *
     * @param  mixed $contracts
     * @return void
     */
    public function mount($contracts)
    {
        $this->contracts = $contracts;
    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        $response['portfolios'] = ContractsFacade::getByAuthPortfolios();
        return view('livewire.wallet.product.view')->with($response);
    }

    /**
     * updateValues
     *
     * @param  mixed $value
     * @return void
     */
    public function updateValues($value)
    {
        $data = ContractsFacade::getByAuthPortfolio($value);
        $this->contracts = $data['contract'];
        $this->emit('dataSet', $data);
    }
}
