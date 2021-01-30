<?php

return [
    'type' => ['eth' => 1, 'btc' => 2, 'capp' => 3, 'zelle' => 4],
    'soax_to_usd' => 0.1,
    'sopx_to_usd' => 0.1, //don't use anywhere. it's calculation from daily oil barrel price
    'minimum_soax' => env('SOAX_MIN', 200),
    'minimum_sopx' => env('SOPX_MIN', 0.25),
    'minimum_commissions_to_convert' => 0,
    'withdraw_charges' => 0.015,
    'redeem' => [
        'minimum_sopx' => 0.25,
        'minimum_share' => 20,
        'minimum_rewards' => 20,
        // 'handling_fee' =>  0.015,
    ],
];
