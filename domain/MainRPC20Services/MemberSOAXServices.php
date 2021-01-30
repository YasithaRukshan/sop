<?php

namespace domain\MainRPC20Services;

use Web3\Web3;
use Web3\Contract;

class MemberSOAXServices
{
    protected $network;
    protected $abi;
    protected $byte_code;
    protected $contract_owner;
    protected $web3;
    protected $contract;
    protected $env;
    protected $contract_address;

    protected $min_tx_soax;
    protected $soax_decimal_points;

    protected $response;
    public function __construct()
    {
        $this->env = config('app.env') == "production" ? "pro" : "dev";
        // Get Network For desired location [In local please use Ganache]
        $this->network = config('smartContract.' . $this->env . '.sc_provider');

        $this->min_tx_soax = config('smartContract.' . $this->env . '.sc_minimum_soax_tr_limit');

        $this->soax_decimal_points = config('smartContract.' . $this->env . '.soax_decimal_points');
        // Member SC ABI
        // dd(config('smartContract.' . $this->env . '.sc_member_soax_abi_code'));
        $this->abi = file_get_contents(storage_path(config('smartContract.' . $this->env . '.sc_member_soax_abi_code')));
        // Member SC BYTE CODE
        $this->byte_code = '0x' . json_decode(file_get_contents(storage_path(config('smartContract.' . $this->env . '.sc_member_soax_byte_code'))))->object;
        // Master account public address
        $this->contract_owner = config('smartContract.' . $this->env . '.contract_owner');
        $this->main_soax_contract_address = config('smartContract.' . $this->env . '.soax_contract_address');
        // Create Web3 Instant Using Current Network
        $this->web3 = new Web3($this->network);
        // Create Contract Instant Using Current Network
        $this->contract = new Contract($this->network, $this->abi);
    }
    /**
     * Deploy SOAX Contract For Member Wallet
     * !have to wait for callback
     * @return mixed
     */
    public function deployContract()
    {
        $this->contract->bytecode($this->byte_code)->new([
            "from" => $this->contract_owner,
            "gas" => '0x200b20' //TODO: Have To Deploy function for estimate the gas usage
        ], function ($err, $transaction_id) {

            if ($err !== null) {
                return $this->fail($err);
            }
            if ($transaction_id) {
                return $this->getTransactionReceipt($transaction_id);
            }
        });
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
            return $this->response = ["err" => $err, "resp" => $transaction];
        });

        if ($this->response['err'] !== null) {
            return $this->fail($this->response['err']);
        }
        if ($transaction=$this->response['resp']) {
            return $this->success($transaction);
        }
    }
    /**
     * get Contract Balance From Contract Address
     *
     * @param  mixed $contract_address
     * @return mixed
     */
    public function getContractBalance($contract_address)
    {
        $this->contract->at($contract_address)->call(
            "balanceOf",
            $this->contract_owner,
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
     * transfer SOAX To Contract
     *
     * @param  mixed $contract_address
     * @param  mixed $soax_amount
     * @return mixed
     */
    public function transferToContract($contract_address, $soax_amount)
    {
        if ($soax_amount < $this->min_tx_soax) {
            return $this->fail(['msg' => 'Minimum SOAX Transaction Amount Is ' . $this->min_tx_soax]);
        }
        $this->contract
            ->at($contract_address)
            ->send(
                "transfer",
                $contract_address, //here pass the contract address who received the transfer
                $soax_amount*pow(10,$this->soax_decimal_points), //here pass the soax amount to the transfer
                [
                    'from' => $this->contract_owner,  //contract owner address
                    'gas' => '0x200b20' //TODO:  Have To Deploy function for estimate the gas usage
                ],
                function ($err, $transaction_id) {
                    if ($err !== null) {
                        return $this->fail($err);
                    }
                    if ($transaction_id) {
                        return $this->getTransactionReceipt($transaction_id);
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
    public function transferSOAXToMemberAccount($to_address, $soax_amount)
    {
        if ($soax_amount < $this->min_tx_soax) {
            return $this->fail(['msg' => 'Minimum SOAX Transaction Amount Is ' .$this->min_tx_soax]);
        }
        $this->contract
            ->at($this->main_soax_contract_address)
            ->send(
                "transfer",
                $to_address, //here pass the contract address who received the transfer
                $soax_amount*pow(10,$this->soax_decimal_points), //here pass the soax amount to the transfer
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
     * fail message
     *
     * @param  mixed $err
     * @return mixed
     */
    public function fail($err)
    {
        dd($err);
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
