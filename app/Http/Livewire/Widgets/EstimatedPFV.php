<?php

namespace App\Http\Livewire\Widgets;

use App\Traits\UtilityHelper;
use domain\Facades\WalletFacade;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EstimatedPFV extends Component
{
    use UtilityHelper;
    public $estimated_value_sopx = 0;
    public $estimated_value_usd = 0;
    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        return view('MemberArea.Pages.Dashboard.Components.estimatedPFV');
    }
    public function mount()
    {
        $production = WalletFacade::estimatedStakeProduction(Auth::user());
        $this->estimated_value_sopx = $production['sopx'];
        $this->estimated_value_usd = $production['usd'];
    }
}
