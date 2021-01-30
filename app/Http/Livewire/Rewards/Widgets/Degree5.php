<?php

namespace App\Http\Livewire\Rewards\Widgets;

use App\Models\Reward;
use App\Traits\FormHelper;
use App\Traits\UtilityHelper;
use domain\Facades\Convert\EthRateFacade;
use domain\Facades\StakeFacades\RewardFacade;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Degree5 extends Component
{
    use FormHelper;
    use UtilityHelper;
    public $cor_reward_degree;
    public $geo_reward_degree;
    public $oigcc_reward_degree;
    public $collectible_reward_cor;
    public $collectible_reward_geo;
    public $collectible_reward_oigcc;
    public $total_reward_cor;
    public $total_reward_geo;
    public $total_reward_oigcc;
    const degree = 5;

    public $cor_reward_points;
    public $geo_reward_points;
    public $oigcc_reward_points;

    public function mount()
    {
        $this->cor_reward_degree = RewardFacade::getByAuthAndLevelTypeOrCreate(Auth::user()->wallet->id, self::degree, Reward::TYPE['COR']);
        $this->geo_reward_degree = RewardFacade::getByAuthAndLevelTypeOrCreate(Auth::user()->wallet->id, self::degree, Reward::TYPE['GEO']);
        $this->oigcc_reward_degree = RewardFacade::getByAuthAndLevelTypeOrCreate(Auth::user()->wallet->id, self::degree, Reward::TYPE['OIGCC']);
        $this->collectible_reward_cor = ($this->cor_reward_degree->rewards * 1) - ($this->cor_reward_degree->rewards_red * 1);
        $this->collectible_reward_geo = ($this->geo_reward_degree->rewards * 1) - ($this->geo_reward_degree->rewards_red * 1);
        $this->collectible_reward_oigcc = ($this->oigcc_reward_degree->rewards * 1) - ($this->oigcc_reward_degree->rewards_red * 1);

        $this->collectible_reward_cor = $this->collectible_reward_cor > 0 ? $this->collectible_reward_cor : 0;
        $this->collectible_reward_geo = $this->collectible_reward_geo > 0 ? $this->collectible_reward_geo : 0;
        $this->collectible_reward_oigcc = $this->collectible_reward_oigcc > 0 ? $this->collectible_reward_oigcc : 0;


        $this->total_reward_cor = $this->cor_reward_degree->rewards;
        $this->total_reward_geo = $this->geo_reward_degree->rewards;
        $this->total_reward_oigcc = $this->oigcc_reward_degree->rewards;


        $this->cor_reward_points = $this->numberAbbreviation($this->cor_reward_degree->points);
        $this->geo_reward_points = $this->numberAbbreviation($this->geo_reward_degree->points);
        $this->oigcc_reward_points = $this->numberAbbreviation($this->oigcc_reward_degree->points);
    }

    public function render()
    {
        return view('MemberArea.Pages.SocialImpact.Components.Levels.level5');
    }
}
