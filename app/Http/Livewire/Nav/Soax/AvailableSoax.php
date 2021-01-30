<?php

namespace App\Http\Livewire\Nav\Soax;

use App\Traits\UtilityHelper;
use Livewire\Component;

class AvailableSoax extends Component
{
    use UtilityHelper;
    public function render()
    {
        return view('livewire.nav.soax.available-soax');
    }
}
