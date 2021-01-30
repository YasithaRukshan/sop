<?php

namespace App\Traits;

use domain\Facades\Convert\EthRateFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait UtilityHelper
{

    /**
     * ethF
     *
     * @param  mixed $eth
     * @return void
     */
    public function ethF($eth)
    {
        return number_format($eth, 5);
    }
    /**
     * ethPan
     *
     * @param  mixed $usd
     * @param  mixed $format
     * @return void
     */
    public function ethPan($usd, $format = true)
    {
        $eth = $this->ethF(EthRateFacade::getLastEthRate($usd * 1));
        if ($format) {
            return '<span class="epeval">' . $eth . 'ETH </span><span class="epuval">($' . number_format($usd, 2) . ')</span>';
        } else {
            return $eth;
        }
    }
}
