<?php

/**
 *
 * !important This configurations valid only for Smart Contract basic integration
 * !don't put any other config here
 * !Here Stored sensual information about Smart Contracts
 * !Don't Edit anything here.
 * *Developer [Lathindu Pramuditha]
 *
 *
 * Any ISSUE PLEASE CONTACT DEVELOPER
 */

return [

    'dev' => [
        // 'sc_provider' => "http://127.0.0.1:7545",

        // 'sc_provider' => "https://ropsten.infura.io/v3/c76068ab4fec4fd29224e76b66ec5ea0",
        'sc_provider' => "https://damp-ancient-paper.ropsten.quiknode.pro/668b094a1fd1185b3f60c7c420ad635eb8622359/",
        'soax_decimal_points' => 0,
        'sopx_decimal_points' => 4,

        'contract_owner' => '0x6cA0323B6DB3bbC5331614b1E5aFf01C0b1771d6',

        'soax_contract_address' => '0x3c99C57D9c6c3B12B37da626e9E6D2Ab5E96FEfB',
        'staking_account' => '0x599aF6603d6D34A4D23F48e37CE396A4C59B6C5A',
        'staking_trash_can' => '0x2F0dC588249F2bdd46456dDEef636e93EDe04336',

        'sopx_contract_address' => '0x936F47C71045E6A4F97ddE084b86189403608058',
        'production_account' => '0xbBf1D790607086e57858ee94eB98b227D25393Bf',
        'production_trash_can' => '0x134F8C6b2c66882dA5d6A4708c4B2A4f81d4365A',



        //MAIN SOAX ACCOUNT Smart Contract
        'sc_main_soax_abi_code' => env('SC_MAIN_SOAX_ABI', 'app/smartContracts/dev/MainSOAX/ABI.json'),
        'sc_main_soax_byte_code' => env('SC_MAIN_SOAX_BYTE_CODE', 'app/smartContracts/dev/MainSOAX/BYTECODE.json'),

        //MAIN SOPX ACCOUNT Smart Contract
        'sc_main_sopx_abi_code' => env('SC_MAIN_SOPX_ABI', 'app/smartContracts/dev/MainSOPX/ABI.json'),
        'sc_main_sopx_byte_code' => env('SC_MAIN_SOPX_BYTE_CODE', 'app/smartContracts/dev/MainSOPX/BYTECODE.json'),


        'sc_minimum_soax_tr_limit' => env('SC_MINIMUM_SOAX_TR_LIMIT', 200),
        'sc_minimum_sopx_tr_limit' => env('SC_MINIMUM_SOPX_TR_LIMIT', 0),
    ],
    'pro' => [
        'sc_provider' => "http://127.0.0.1:7545",
        'soax_decimal_points' => 0,
        'sopx_decimal_points' => 4,
        // 'sc_provider' => "https://ropsten.infura.io/v3/c76068ab4fec4fd29224e76b66ec5ea0",

        'contract_owner' => '0x66c88deaE43b9439AeC494E268c88C4FAC8Bd872',

        'soax_contract_address' => '0x0f874D2B364e8Eb79aD4908b1c84cc490F4AE432',
        'staking_account' => '0x66c88deaE43b9439AeC494E268c88C4FAC8Bd872',
        'staking_trash_can' => '0x66c88deaE43b9439AeC494E268c88C4FAC8Bd872',

        'sopx_contract_address' => '0x0f874D2B364e8Eb79aD4908b1c84cc490F4AE432',
        'production_account' => '0x66c88deaE43b9439AeC494E268c88C4FAC8Bd872',
        'production_trash_can' => '0x66c88deaE43b9439AeC494E268c88C4FAC8Bd872',


        //MAIN SOAX ACCOUNT Smart Contract
        'sc_main_soax_abi_code' => 'app/smartContracts/pro/MainSOAX/ABI.json',
        'sc_main_soax_byte_code' => 'app/smartContracts/pro/MainSOAX/BYTECODE.json',

        //MAIN SOPX ACCOUNT Smart Contract
        'sc_main_sopx_abi_code' => 'app/smartContracts/pro/MainSOPX/ABI.json',
        'sc_main_sopx_byte_code' => 'app/smartContracts/pro/MainSOPX/BYTECODE.json',

        'sc_minimum_soax_tr_limit' => 200,
        'sc_minimum_sopx_tr_limit' => 0,
    ],
    'min_contract_soax' => env('MINIMUM_CONTRACT_SOAX_LIMIT', 200),

];
