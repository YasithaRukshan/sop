<?php

namespace domain\Wallet\WalletServices;

use App\Events\DepositConfirmationEvent;
use App\Events\WalletModifyEvent;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\Withdrawal;
use App\Traits\WalletHelper;
use DateTime;
use domain\Facades\AccountFacade;
use domain\Facades\ContractsFacade;
use domain\Facades\MemberExWalletFacade;
use domain\Facades\OilPriceFacade;
use domain\Facades\TransactionFacade;
use domain\Facades\WalletFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class WalletService
{
    use WalletHelper;
    protected $wallets;
    public function __construct()
    {
        $this->wallets = new Wallet();
    }
    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        return $this->wallets->all();
    }
    /**
     * getWorkableWallets
     *
     * @param  mixed $min_limit
     * @return void
     */
    public function getWorkableWallets($min_limit)
    {
        return $this->wallets->getWorkableWallets($min_limit);
    }
    /**
     * getCommissionsInitializeWallets
     *
     * @param  mixed $min_limit
     * @return void
     */
    public function getCommissionsInitializeWallets($min_limit)
    {
        return $this->wallets->getCommissionsInitializeWallets($min_limit);
    }
    /**
     * get
     *
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->wallets->find($id);
    }
    /**
     * make
     *
     * @param  mixed $data
     * @return mixed
     */
    public function make($data, $fire_event = true)
    {
        $wallet = $this->create($data);
        if ($fire_event) {
            // broadcast wallet modify event foe create accounts if not exists
            event(new WalletModifyEvent($wallet));
        }
        return $wallet;
    }
    public function allStackable()
    {
        return $this->wallets->allStackable();
    }
    /**
     * create
     *
     * @param  array $data
     * @return Wallet
     */
    public function create(array $data)
    {
        return $this->wallets->create($data);
    }
    /**
     * update
     *
     * @param  mixed $data
     * @return mixed
     */
    public function update(Wallet $wallet, array $data)
    {
        $wallet->update($this->edit($wallet, $data));
    }
    /**
     * edit
     *
     * @param  mixed $wallets
     * @param  mixed $data
     * @return mixed
     */
    public function edit(Wallet $wallets, $data)
    {
        return array_merge($wallets->toArray(), $data);
    }
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($wallets)
    {
        return  $wallets->delete();
    }
    /**
     * Store Transaction
     *
     * @param  mixed $data
     * @return mixed
     */
    public function storeTransaction($data)
    {
        return TransactionFacade::getDeposit($data, $this->getWallet());
    }
    /**
     * Validate Transaction Eth
     *
     * @param  mixed $data
     * @return void
     */
    public function validateTransactionEth($data)
    {
        $wallet = $this->getWallet();
        $transaction = TransactionFacade::get($data['id']);
        TransactionFacade::update($transaction, [
            'thash' => $data['hash'],
            'status' => WalletTransaction::STATUS['PAID'],
        ]);
        return ['status' => true, 'data' => ['wallet' => $wallet, 'transaction' => $transaction]];
    }
    /**
     * Get Wallet
     *
     * @return mixed
     */
    public function getWallet()
    {
        if ($wallet = Auth::user()->wallet) {
            if (!$wallet->mainAc && !$wallet->stakeAc) {
                event(new WalletModifyEvent($wallet));
                return $this->get($wallet->id);
            }
        } else {
            $wallet = $this->make(['customer_id' => Auth::id()]);
        }
        return $this->get($wallet->id);
    }
    /**
     * convert
     *
     * @param  mixed $from
     * @param  mixed $to
     * @param  mixed $amount
     * @return mixed
     */
    public function convert($from, $to, $amount = 1)
    {
        $resp = null;
        if (in_array($from, ['USD', 'SOAX']) && in_array($to, ['ETH', 'BTC'])) {
            $usd_reverse_rate = $this->conversionRates($to);

            switch ($from) {
                case 'SOAX':
                    $resp =  round(($amount * config('payments.soax_to_usd')) / $usd_reverse_rate, 8);
                    break;
                case 'USD':
                    $resp = round(($amount / $usd_reverse_rate), 8);
                    break;
            }
        } else if (in_array($from, ['ETH', 'BTC']) && in_array($to, ['USD', 'SOAX'])) {
            $usd_rate = $this->conversionRates($from);
            switch ($to) {
                case 'SOAX':
                    $resp = $usd_rate * $amount / config('payments.soax_to_usd');
                    break;
                case 'USD':
                    $resp =  $amount;
                    break;
            }
        } else if (in_array($from, ['SOAX']) && in_array($to, ['USD'])) {

            $resp = $amount * config('payments.soax_to_usd');
        } else if (in_array($from, ['SOAX']) && in_array($to, ['CApp'])) {
            $resp = $amount * config('payments.soax_to_usd') / 0.95;
        } else if (in_array($from, ['SOAX']) && in_array($to, ['Zelle'])) {
            $resp = $amount * config('payments.soax_to_usd') / 0.95;
        }
        return $resp;
    }

    /**
     * conversionRates
     *
     * @param  mixed $from
     * @return mixed
     */
    public function conversionRates($from = "ETH")
    {
        $rate = Http::get('https://min-api.cryptocompare.com/data/price?fsym=' . $from . '&tsyms=USD');
        $rate = $rate->json();
        return  array_key_exists('USD', $rate) ? $rate['USD'] : 440;
    }


    /**
     * get SOAX balance
     *
     * @param  mixed $from
     * @return mixed
     */
    public function getBalance($id)
    {
        return $this->wallets->where('customer_id', $id)->get();
    }

    /**
     * get purchase data
     *
     * @param  mixed $from
     * @return mixed
     */
    public function purchaseData($request)
    {
        $wallet_id = Auth::user()->wallet->id;
        $transaction = TransactionFacade::getPurchaseData($wallet_id);
        return $transaction;
    }

    /**
     * view purchase data
     *
     * @param  $id
     * @return mixed
     */
    public function purchaseViewData($id)
    {
        $wallet_id = Auth::user()->wallet->id;
        $transaction = TransactionFacade::getPurchaseData($wallet_id);
        foreach ($transaction as $value) {
            # code...
            if ($id == md5($value['id'])) {
                return $value;
            }
        }
        return null;
    }

    /**
     * getWalletData
     *
     * @return void
     */
    public function getWalletData()
    {
        Auth::user()->wallet->id;
        $data['chartValues'] = array();
        $tempDateArray = array();
        $walletTransaction = WalletTransaction::where('wallet_id', Auth::user()->wallet->id)
            ->where('status', 2)->get();
        $withdrawalData = Withdrawal::where('customer_id', Auth::user()->id)
            ->where('status', 2)->get();
        foreach ($walletTransaction as $key => $walletTransactionValue) {
            $tempDate =  $walletTransactionValue['created_at']->format('Y-m-d');
            if (in_array($tempDate, $tempDateArray)) {
                foreach ($data['chartValues'] as $keyTT => $TempValueW) {
                    if ($TempValueW['date'] == $tempDate) {
                        $data['chartValues'][$keyTT]['value'] = (float)$TempValueW['value'] + $walletTransactionValue['amount'];
                    }
                }
            } else {
                $tempChart['date'] = $tempDate;
                $tempChart['value'] = $walletTransactionValue['amount'];
                array_push($data['chartValues'], $tempChart);
                array_push($tempDateArray, $tempDate);
            }
        }
        foreach ($withdrawalData as $key => $withdrawalDataValue) {
            $tempDate =  $withdrawalDataValue['created_at']->format('Y-m-d');
            if (in_array($tempDate, $tempDateArray)) {
                foreach ($data['chartValues'] as $keyWT => $TempValue) {
                    if ($TempValue['date'] == $tempDate) {
                        $data['chartValues'][$keyWT]['value'] =  ((float) $data['chartValues'][$keyWT]['value']) - ($withdrawalDataValue['sopx_amount']);
                    }
                }
            } else {
                $tempChart['date'] = $tempDate;
                $tempChart['value'] = $walletTransactionValue['amount'];
                array_push($data['chartValues'], $tempChart);
                array_push($tempDateArray, $tempDate);
            }
        }
        if (count($data['chartValues']) == 0) {
            $today = date("Y-m-d");
            $data['chartValues'] = array();
            $tempChart['date'] = $today;
            $tempChart['value'] = 0;
            array_push($data['chartValues'], $tempChart);
        }
        $data['loader'] = $this->loaderHTML();

        usort($data['chartValues'], function ($a, $b) {
            return new DateTime($a['date']) <=> new DateTime($b['date']);
        });
        return  $data;
    }
    /**
     * handlingFee
     *
     * @param  mixed $usdValue
     * @param  mixed $btcValue
     * @param  mixed $ethValue
     * @param  mixed $currencyType
     * @return void
     */
    public function handlingFee($usdValue, $btcValue, $ethValue, $currencyType)
    {
        $fee = 0;
        $handling_fee = config("payments.redeem.handling_fee");
        if ($currencyType == 1) {
            $fee = $btcValue * $handling_fee;
        } elseif ($currencyType == 2) {
            $fee = $ethValue * $handling_fee;
        }
        $data['fee'] = $fee;
        $data['usd_fee'] = $usdValue * $handling_fee;
        return $data;
    }
    public function estimatedStakeProduction($customer)
    {
        $oil_price = OilPriceFacade::currentPrice();
        $staked = ContractsFacade::getAllStakedAMount($customer->id);
        $value = $staked * 3.25 * 3650 / 1000000;
        $usd = $value * ($oil_price->price - 18);
        return ['sopx' => number_format($value, 4), 'usd' => number_format($usd, 2)];
    }
}
