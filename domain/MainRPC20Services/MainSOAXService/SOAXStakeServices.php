<?php

namespace domain\MainRPC20Services\MainSOAXService;

use Web3\Web3;
use Web3\Contract;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Illuminate\Support\Facades\Http;
use Web3\Eth;
use Web3p\EthereumTx\Transaction;

class SOAXStakeServices
{
    protected $network;
    protected $abi;
    protected $byte_code;

    protected $contract_owner;
    protected $stake_master;

    protected $web3;
    protected $contract;
    protected $env;
    protected $contract_address;

    protected $min_tx_soax;
    protected $soax_decimal_points;


    protected $response;
    protected $gas;
    protected $gas_price;
    protected $tr_count;

    public function __construct()
    {
        $this->env = config('app.env') == "production" ? "pro" : "dev";
        // Get Network For desired location [In local please use Ganache]
        $this->network = config('smartcontract.' . $this->env . '.sc_provider');

        $this->min_tx_soax = config('smartcontract.' . $this->env . '.sc_minimum_soax_tr_limit');

        $this->soax_decimal_points = config('smartcontract.' . $this->env . '.soax_decimal_points');
        // Member SC ABI
        // dd(config('smartcontract.' . $this->env . '.sc_member_soax_abi_code'));
        $this->abi = file_get_contents(storage_path(config('smartcontract.' . $this->env . '.sc_main_soax_abi_code')));
        // dd(config('smartcontract'));
        // Member SC BYTE CODE
        $this->byte_code = '0x' . json_decode(file_get_contents(storage_path(config('smartcontract.' . $this->env . '.sc_main_soax_byte_code'))))->object;
        // Master account public address
        $this->contract_owner = config('smartcontract.' . $this->env . '.contract_owner');
        // Stake Master Address
        $this->stake_master = config('smartcontract.' . $this->env . '.staking_account');
        $this->soax_contract_address = config('smartcontract.' . $this->env . '.soax_contract_address');
        // Create Web3 Instant Using Current Network
        $this->web3 = new Web3(new HttpProvider(new HttpRequestManager($this->network, 0.1)));
        // $this->web3 = new Web3($this->network);
        // Create Contract Instant Using Current Network
        // $this->contract = new Contract($this->network, $this->abi);
        // $this->contract = new Contract($this->web3->provider, $this->abi);
        $this->eth = new Eth(new HttpProvider(new HttpRequestManager($this->network, 0.1)));

        $this->contract = new Contract(new HttpProvider(new HttpRequestManager($this->network, 0.1)), $this->abi);
    }
    /**
     * get Contract Balance From Contract Address
     *
     * @param  mixed $contract_address
     * @return mixed
     */
    public function getContractBalance($contract_address, $contract_owner)
    {
        $this->contract->at($contract_address)->call(
            "balanceOf",
            $contract_owner,
            function ($err, $resp) {
                dd($err, $resp);
                if ($err !== null) {
                    return $this->fail($err);
                }
                if ($resp) {
                    return $this->success($resp);
                }
            }
        );
    }
    // public function getContractBalance($contract_address, $contract_owner)
    // {
    //     $this->contract->at($this->soax_contract_address)->call(
    //         "transfer",
    //         $this->stake_master,
    //         100,
    //         [
    //             'from' => $contract_owner,
    //             'gas' => '0x200b20'

    //         ],
    //         function ($err, $resp) {
    //             dd($err, $resp);
    //             if ($err !== null) {
    //                 return $this->fail($err);
    //             }
    //             if ($resp) {
    //                 return $this->success($resp);
    //             }
    //         }
    //     );
    // }
    /**
     * getAllTransactions
     *
     * @return void
     */
    public function getAllTransactions($hash)
    {
        $this->eth->getTransactionByHash($hash,function($err, $transactions){
            dd($err, $transactions);
        });
    }
    /**
     * transfer SOAX To Member Account
     *
     * @param  mixed $to_address
     * @param  mixed $soax_amount
     * @return void
     */
    public function transferSOAXToStakeAccount($soax_amount)
    {
        //  $this->eth->getTransactionByHash("0xbe114e5ffb3f64f298f64e7f852ec8bfc17c0a5f7c2841ae9064ac57e453d4f3", function ($err, $balance) {
        //    dd($err, $balance);
        // });


        // $this->eth->getBalance($this->stake_master, function ($err, $balance) {
        //    dd($err, $balance);
        // });
        //0x7c2e043d494742e2d17890bb7cd658be171c2a359ba3071ca39caf6fe11013cb
        //   $contract =  $this->contract->at($this->soax_contract_address);

        $contract = $this->contract->at($this->soax_contract_address);

        //    $txcon = $contract->functions['transfer'];
        // $txcon = $contract->getData('transfer', $this->stake_master, 1, ['from' => $this->contract_owner,'gas' => '0x200b20']);
        //    transfer($this->stake_master, 100, ['from'=> $this->contract_owner]);
        //   dd($txcon);
        // $this->contract->at($this->soax_contract_address)->estimateGas('transfer', $this->stake_master, 5, [
        //     'from' => $this->contract_owner
        // ], function ($err, $transaction) {
        //     if ($transaction) {
        //         dd($transaction->toString('hex'));
        //         $this->gas = $transaction->toString()*1;
        //     } else {
        //         $this->gas = "51066";
        //         dd($err, $transaction);
        //     }
        // });
        $this->eth->gasPrice(function ($err, $transaction) {
            // dd($err, $transaction);
            if ($transaction) {
                // dd($transaction->toString('hex'));
                $this->gas_price = $transaction->toString()*1;
            } else {
                $this->gas_price = "4999000000";
                dd($err, $transaction);
            }
        });
        $this->eth->getTransactionCount($this->contract_owner, function ($err, $resp) {
            if ($resp) {
                // dd($resp,(($resp->toString()*1)+1));
                $this->tr_count = (($resp->toString() * 1) + 2);
            } else {
                $this->tr_count = 1;
                dd($err, $resp);
            }
        });

        $txcon = $this->contract->at($this->soax_contract_address)->getData('transfer', $this->stake_master, 500, ['from' => $this->contract_owner]);
        // $soax_amount * pow(10, $this->soax_decimal_points)
        $transaction = new Transaction([
            'nonce' => $this->tr_count,
            'from' => $this->contract_owner,
            'to' => $this->soax_contract_address,
            // "gasPrice" => "3000",
            "gasPrice" => $this->gas_price,
            "gasLimit" => 2100000,
            // "gas" => $this->gas,
            'value' => 0, // 0.1 eth
            'data' =>  $txcon,
            'chainId' => 0x03,
        ]);
        // $hashedTx = $transaction->serialize();
        // dd($hashedTx);
        $signedTransaction = '0x' . $transaction->sign('0x78f136cc9bc1f89fe247e24c23d8546ef5d31bce5e8407f3867fc142298f5da2');

        // dd($signedTransaction);

        $this->eth->sendRawTransaction($signedTransaction, function ($err, $resp) {
            dd($err, $resp);
            if ($resp) {
                $this->getTransactionReceipt($resp);
                dd('ss', $resp);
            }
            dd($err, $resp, "err");
        });

        // if ($soax_amount < $this->min_tx_soax) {
        //     return $this->fail(['msg' => 'Minimum SOAX Transaction Amount Is ' . $this->min_tx_soax]);
        // }
        // $this->contract
        //     ->at($this->soax_contract_address)
        //     ->sendRaw(
        //         $signedTransaction,
        //         function ($err, $transaction_id) {
        //             dd($err, $transaction_id);
        //             return $this->response = ["err" => $err, "resp" => $transaction_id];
        //         }
        //     );
        // if ($this->response['err'] !== null) {
        //     return $this->fail($this->response['err']);
        // }
        // if ($this->response['resp']) {
        //     return $this->getTransactionReceipt($this->response['resp']);
        // }
    }
    /**
     * Get Transaction Receipt from transaction id
     * !have to wait for callback
     * @param  mixed $transaction_id
     * @return mixed
     */
    public function getTransactionReceipt($transaction_id)
    {
        $this->contract->eth->getTransactionReceipt($transaction_id, function ($err, $transaction) {
            dd($err, $transaction);

            return $this->response = ["err" => $err, "resp" => $transaction];
        });

        if ($this->response['err'] !== null) {
            return $this->fail($this->response['err']);
        }
        if ($transaction = $this->response['resp']) {
            return $this->success($transaction);
        }
    }
    /**
     * fail message
     *
     * @param  mixed $err
     * @return mixed
     */
    public function fail($err)
    {
        return ['status' => false, 'resp' => $err];
        // TODO:store error logs
    }

    /**
     * success message and data
     *
     * @param  mixed $resp
     * @return mixed
     */
    public function success($resp)
    {
        return ['status' => true, 'resp' => $resp];
    }
}
