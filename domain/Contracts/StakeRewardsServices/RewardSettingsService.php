<?php

namespace domain\Contracts\StakeRewardsServices;

use App\Models\Reward;
use App\Models\RewardSettings;

/**
 * Created by PhpStorm.
 * User: Speralabs
 * Date: 10/07/2020
 * Time: 02:10 PM
 */
class RewardSettingsService
{
    protected $reward_settings;


    public function __construct()
    {
        $this->reward_settings = new RewardSettings();
    }
    /**
     * getRate
     *
     * @param  mixed $type
     * @param  mixed $degree
     * @return void
     */
    public function getRate($type, $degree)
    {
        switch ($type) {
            case Reward::TYPE['COR']:
                $type = "cor";
                break;
            case Reward::TYPE['GEO']:
                $type = "geo";
                break;
            case Reward::TYPE['OIGCC']:
                $type = "oigcc";
                break;
            default:
            $type = "";
                break;
        }
        $name = $type . '_d' . $degree;
        $resp = $this->reward_settings->where('name',  $name)->first();
        if ($resp) {
            return $resp->value;
        }else{
            return 1;
        }
    }
}
