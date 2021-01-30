<?php

namespace domain\MainRPC20Services\PersonalWallets;

use Web3\Eth;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Web3\Web3;
use Web3\Personal;
use Illuminate\Support\Str;

class MemberEXWalletsServices
{
    protected $network;
    protected $web3;
    protected $eth;
    protected $Personal;
    protected $env;
    protected $password;

    protected $success_resp;

    public function __construct()
    {
        $this->env = config('app.env') == "production" ? "pro" : "dev";
        // Get Network For desired location [In local please use Ganache]
        $this->network = config('smartcontract.' . $this->env . '.sc_provider');
        $this->web3 = new Web3(new HttpProvider(new HttpRequestManager($this->network, 0.1)));
        $this->eth = new Eth(new HttpProvider(new HttpRequestManager($this->network, 0.1)));
        $this->personal = new Personal(new HttpProvider(new HttpRequestManager($this->network, 0.1)));
    }
    /**
     * New Account
     *
     * @return mixed
     */
    public function newAccount()
    {
        $this->password = Str::random(100);
        $personal = $this->personal;
        $personal->newAccount($this->password, function ($err, $resp) {
            return $this->success_resp = ['err'=>$err, 'resp'=>$resp];
        });
        if ($this->success_resp['err'] !== null) {
            return $this->fail($this->success_resp['err']);
        }
        if (isset($this->success_resp['resp'])) {
           return $this->success(['address' => $this->success_resp['resp'], 'password' => $this->password]);
        }
    }
    /**
     * Get Balance
     *
     * @param  mixed $address
     * @return mixed
     */
    public function getBalance($address)
    {
        $eth = $this->eth;
        $eth->getBalance($address, function ($err, $resp) {
            // dd($err, $resp);
            if ($err !== null) {
                return $this->fail($err);
            }
            if (isset($resp)) {
                return $this->success($resp);
            }
        });
    }
    /**
     * All Accounts
     *
     * @return mixed
     */
    public function allAccounts()
    {
        $Personal = $this->personal;
        $Personal->listAccounts(function ($err, $resp) {
            if ($err !== null) {
                // do something
                return $this->fail($err);
            }
            if (isset($resp)) {
                return $this->success($resp);
            }
        });
    }
    public function unlockAccount($address, $password)
    {
        $personal = $this->personal;
        $personal->unlockAccount($address, $password, function ($err, $resp) {
            // dd($resp, 'no resp');
            if ($err !== null) {
                // dd($err, $resp);
                return $this->fail($err);
            }
            if (isset($resp)) {
                // dd($resp);
                return $this->success($resp);
            }

        });
    }
    public function sendTransaction($amount,$address_to,$password)
    {
        $personal = $this->personal;
        $personal->newAccount([
            "from"=> "",
            // "gasPrice"=> "",
            "gas"=> "0x200b20",
            "to"=> $address_to,
            "value"=> "",
            "data"=> "",
        ],$password, function ($err, $resp) {
            return $this->success_resp = ['err'=>$err, 'resp'=>$resp];
        });
        if ($this->success_resp['err'] !== null) {
            return $this->fail($this->success_resp['err']);
        }
        if (isset($this->success_resp['resp'])) {
           return $this->success(['address' => $this->success_resp['resp'], 'password' => $this->password]);
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
        return ['status' => false, 'msg' => $err];
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
    //     /**
    //  * all
    //  *
    //  * @return void
    //  */
    // public function newWallet($address)
    // {
    //     // dd($this->newAccount());
    //     $eth = $this->eth;
    //     // dd($this->web3);
    //     $eth->getBalance("0xc5CD01B72e62B26d1642CdE47D8f54073b55b863", function ($err, $resp) {
    //         if ($err !== null) {
    //             // do something
    //             dd([$err, $resp]);
    //         }
    //         if (isset($resp)) {
    //             dd($resp);
    //         }
    //     });
    // }
}
