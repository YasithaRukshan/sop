<?php

namespace domain\MainSOPXService\MainRPC20Services;

use Web3\Web3;
use Web3\Contract;

class SOPXServices
{
    protected $network;
    protected $abi;
    protected $byte_code;

    protected $contract_owner;
    protected $sopx_store;

    protected $web3;
    protected $contract;
    protected $env;
    protected $contract_address;

    protected $min_tx_sopx;
    protected $sopx_decimal_points;


    protected $response;
    public function __construct()
    {
        $this->env = config('app.env') == "production" ? "pro" : "dev";
        // Get Network For desired location [In local please use Ganache]
        $this->network = config('smartcontract.' . $this->env . '.sc_provider');

        $this->min_tx_soax = config('smartcontract.' . $this->env . '.sc_minimum_sopx_tr_limit');

        $this->soax_decimal_points = config('smartcontract.' . $this->env . '.sopx_decimal_points');
        // Member SC ABI
        // dd(config('smartcontract.' . $this->env . '.sc_member_soax_abi_code'));
        $this->abi = file_get_contents(storage_path(config('smartcontract.' . $this->env . '.sc_member_sopx_abi_code')));
        // dd(config('smartcontract'));
        // Member SC BYTE CODE
        $this->byte_code = '0x' . json_decode(file_get_contents(storage_path(config('smartcontract.' . $this->env . '.sc_member_sopx_byte_code'))))->object;
        // Master account public address
        $this->contract_owner = config('smartcontract.' . $this->env . '.contract_owner');
        // Stake Master Address
        $this->sopx_store = config('smartcontract.' . $this->env . '.production_account');
        $this->sopx_contract_address = config('smartcontract.' . $this->env . '.sopx_contract_address');
        // Create Web3 Instant Using Current Network
        $this->web3 = new Web3($this->network);
        // Create Contract Instant Using Current Network
        $this->contract = new Contract($this->network, $this->abi);
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
                if ($err !== null) {
                    return $this->fail($err);
                }
                if ($resp) {
                    return $this->success($resp);
                }
            }
        );
    }
    /**
     * transfer SOAX To Member Account
     *
     * @param  mixed $to_address
     * @param  mixed $soax_amount
     * @return void
     */
    public function transferSOPXToProductionAccount($sopx_amount)
    {
        if ($sopx_amount < $this->min_tx_sopx) {
            return $this->fail(['msg' => 'Minimum SOPX Transaction Amount Is ' . $this->min_tx_sopx]);
        }
        $this->contract
            ->at($this->sopx_contract_address)
            ->send(
                "transfer",
                $this->sopx_store, //here pass the contract address who received the transfer
                $sopx_amount * pow(10, $this->sopx_decimal_points), //here pass the sopx amount to the transfer
                [
                    'from' => $this->contract_owner,  //contract owner address
                    'gas' => '0x200b20' //TODO:  Have To Deploy function for estimate the gas usage
                ],
                function ($err, $transaction_id) {
                    return $this->response = ["err" => $err, "resp" => $transaction_id];
                }
            );
        if ($this->response['err'] !== null) {
            return $this->fail($this->response['err']);
        }
        if ($this->response['resp']) {
            return $this->getTransactionReceipt($this->response['resp']);
        }
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
            // dd($err, $transaction);
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
