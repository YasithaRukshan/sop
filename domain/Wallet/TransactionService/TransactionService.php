<?php

namespace domain\Wallet\TransactionService;

use App\Models\SopxTransactions;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\Withdrawal;
use domain\Facades\OilPriceFacade;

class TransactionService
{
    protected $transactions;
    protected $withdrawals;
    protected $sopx_transactions;


    public function __construct()
    {
        $this->transactions = new WalletTransaction();
        $this->withdrawals  = new Withdrawal();
        $this->sopx_transactions  = new SopxTransactions();
    }

    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        return $this->transactions->all();
    }
    public function getByTypeAndAuth($type)
    {
        return $this->transactions->getByTypeAndAuth($type);
    }

    /**
     * get
     *
     * @param  mixed $id
     * @return void
     */
    public function get($id)
    {
        return $this->transactions->where('id', $id)->first();
    }
    /**
     * notConfirmedBtcTransactionsOverTime
     *!don't change anything inside this method
     * @return void
     */
    public function notConfirmedBtcTransactionsOverTime()
    {
        return $this->transactions->notConfirmedBtcTransactionsOverTime();
    }
    /**
     * notConfirmedEthTransactionsOverTime
     *!don't change anything inside this method
     * @return void
     */
    public function notConfirmedEthTransactionsOverTime()
    {
        return $this->transactions->notConfirmedEThTransactionsOverTime();
    }

    public function notConfirmedBtcTransactionsOverTimeTest()
    {
        return $this->transactions->notConfirmedBtcTransactionsOverTimeTest();
    }
    /**
     * getWithTxIdAndId
     *
     * @param  mixed $id
     * @param  mixed $txid
     * @return void
     */
    public function getWithTxIdAndId($id, $txid)
    {
        return $this->transactions->getWithTxIdAndId($id, $txid);
    }
    /**
     * get By InvoiceId
     *
     * @param  mixed $txid
     * @return void
     */
    public function getByInvoiceId($txid)
    {
        return $this->transactions->getByInvoiceId($txid);
    }
    /**
     * getEthTransactions
     *
     * @return mixed
     */
    public function getEthTransactions()
    {
        return $this->transactions->getEthTransactions();
    }

    /**
     * get
     *
     * @param  mixed $id
     * @return void
     */
    public function getWithAuth($id)
    {
        return $this->transactions->getWithAuth($id);
    }

    /**
     * get By Address
     *
     * @param  mixed $id
     * @return void
     */
    public function getByAddress($address)
    {
        return $this->transactions->getByAddress($address);
    }

    /**
     * getByKey
     *
     * @param  mixed $key
     * @return mixed
     */
    public function getByKey($key, $status)
    {
        return $this->transactions->getByKey($key, $status);
    }
    /**
     * make
     *
     * @param  mixed $data
     * @return void
     */
    public function make($data)
    {
        return $this->create($data);
    }
    /**
     * create
     *
     * @param  mixed $request
     * @return void
     */
    public function create($data)
    {
        return $this->transactions->create($data);
    }

    /**
     * update
     *
     * @param  WalletTransaction $data
     * @return mixed
     */
    public function update(WalletTransaction $wallet, array $data)
    {
        $wallet->update($this->edit($wallet, $data));
    }

    /**
     * edit
     *
     * @param  WalletTransaction $transactions
     * @param  mixed $data
     * @return mixed
     */
    public function edit(WalletTransaction $transactions, $data)
    {
        return array_merge($transactions->toArray(), $data);
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($transactions)
    {
        return  $transactions->delete();
    }

    /**
     * getDeposit
     *
     * @param  mixed $data
     * @param  mixed $wallet
     * @return mixed
     */
    public function getDeposit($data, $wallet)
    {
        if (array_key_exists('depkey', $data) && $transaction = $this->getByKey($data['depkey'], WalletTransaction::STATUS['PENDING'])) {
            if ($transaction->wallet_id == $wallet->id) {
                $this->update($transaction, [
                    'amount' => $data['amount'],
                    'depkey' => Str::random(64),
                    'type' => $data['type'],
                    'value' => $this->calculateValue($data)['amount'],
                ]);
                $rpdata = $this->get($transaction->id);
                return $this->generateResponse($rpdata, $wallet);
            }
        }
        $rpdata = $this->create([
            'wallet_id' => $wallet->id,
            'amount' => $data['amount'],
            'depkey' => Str::random(64),
            'type' => $data['type'],
            'value' => $this->calculateValue($data)['amount'],
        ]);
        return $this->generateResponse($rpdata, $wallet);
    }

    /**
     * generateResponse
     *
     * @param  mixed $rpdata
     * @param  mixed $wallet
     * @return void
     */
    public function generateResponse($rpdata, $wallet)
    {
        $master_acc = "";
        $chain_id = "";
        if ($rpdata->type == WalletTransaction::TYPE['ETH']) {
            $master_acc = config('app.env') == "production" ? config('ethProvider.pro.master_acc') : config('ethProvider.dev.master_acc');
            $chain_id = config('app.env') == "production" ? 1 : 3;
        }
        return [
            "amount" => $rpdata->amount,
            "usd" => $rpdata->amount * config('payments.soax_to_usd'),
            "value" => $rpdata->value,
            "depkey" => $rpdata->depkey,
            "id" => $rpdata->id,
            "authorization" => $rpdata->type == WalletTransaction::TYPE['BTC'] ? config('btcPasyServer.authorization') : "",
            "master_acc" => $master_acc,
            "chain_id" =>  $chain_id,
        ];
    }
    /**
     * calculate Value of sc
     *
     * @param  mixed $data
     * @return void
     */
    public function calculateValue($data)
    {
        switch ($data['type']) {
            case WalletTransaction::TYPE['ETH']:
                $eth_to_usd_conversion = Http::get('https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=USD');
                $d = $eth_to_usd_conversion->json();
                $eth_to_usd_conversion_rate = array_key_exists('USD', $d) ? $d['USD'] : 440;
                $soax_to_usd = config('payments.soax_to_usd');
                $usd = $soax_to_usd * ($data['amount'] * 1);
                $amount = $usd / $eth_to_usd_conversion_rate;
                break;
            case WalletTransaction::TYPE['BTC']:
                $btc_to_usd_conversion = Http::get('https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD');
                $d = $btc_to_usd_conversion->json();
                $btc_to_usd_conversion_rate = array_key_exists('USD', $d) ? $d['USD'] : 16000;
                $soax_to_usd = config('payments.soax_to_usd');
                $usd = $soax_to_usd * ($data['amount'] * 1);
                $amount = $usd / $btc_to_usd_conversion_rate;
                break;
            case WalletTransaction::TYPE['CAPP']:
                $amount = ($data['amount'] * 1) * config('payments.soax_to_usd') / 0.95;
                break;
            case WalletTransaction::TYPE['ZELLE']:
                $amount = ($data['amount'] * 1) * config('payments.soax_to_usd') / 0.95;
                break;

            default:
                $amount = 0;
                break;
        }
        return ['amount' => round($amount, 6)];
    }
    /**
     * cApp Callback Validate
     *
     * @param  mixed $request
     * @return void
     */
    public function cAppCallbackValidate($request)
    {
        if ($request->has('depkey')) {
            $transaction = $this->getByKey($request->depkey, WalletTransaction::STATUS['PENDING']);
            $this->update($transaction, ['status' => WalletTransaction::STATUS['PAID']]);
            return ['status' => true];
        }
        return ['status' => false];
    }
    /**
     * zelle Callback Validate
     *
     * @param  mixed $request
     * @return void
     */
    public function zelleCallbackValidate($request)
    {
        if ($request->has('depkey')) {
            $transaction = $this->getByKey($request->depkey, WalletTransaction::STATUS['PENDING']);
            $this->update($transaction, ['status' => WalletTransaction::STATUS['PAID']]);
            return ['status' => true];
        }
        return ['status' => false];
    }
    /**
     * get Purchase Data
     *
     * @param  mixed $id
     * @return void
     */
    public function getPurchaseData($id)
    {
        return $this->transactions->where('wallet_id', $id)->get();
    }
    /**
     * Retrieve wallet Data
     *
     * @return void
     */
    public function walletData()
    {

        $data = array();
        $walletData = $this->transactions->where('wallet_id', Auth::user()->wallet->id)->get();
        if (count($walletData) == 1) {
            array_push($data, 0);
        }
        foreach ($walletData as $key => $value) {
            array_push($data, $value['amount']);
        }
        return $data;
    }
    /**
     * Get Pending Approvals
     * @param  mixed $request
     * @return mixed
     */
    public function getPendingTransactions()
    {
        return $this->transactions->getPendingTransactions();
    }
    /**
     * Get withdrawals
     * @param  mixed $request
     * @return void
     */
    public function storeWithdrawal($request)
    {
        if ($request['redemptionType'] == 'convert') {
            $request['recipient_address'] = $request['recipient'];
            unset($request['recipient']);
            $request['withdraw_type'] = 1;
            $request['customer_id'] = Auth::user()->id;
            $request['wallet_id'] = Auth::user()->wallet->id;
            $this->withdrawals->create($request);
        } else {
            $request['withdraw_type'] = 2;
            $request['customer_id'] = Auth::user()->id;
            $request['wallet_id'] = Auth::user()->wallet->id;
            $this->withdrawals->create($request);
        }
    }

    /**
     *withdraw data
     *
     * @return void
     */
    public function withdrawalData()
    {
        $data['sopx'] = Auth::user()->wallet->sopx;
        $oilPrice = OilPriceFacade::getLastPrice();
        if ($oilPrice) {
            $data['oilPrice'] = $oilPrice['price'];
        } else {
            $data['oilPrice'] = 45;
        }
        $data['withdrawalAmount'] = number_format($data['sopx'], 4);
        $data['withdrawalAmountNumber'] = number_format($data['sopx'], 4);
        $data['oilPrice'] = number_format($data['oilPrice'], 2);

        return $data;
    }

    /**
     * sopxData
     *
     * @return void
     */
    public function sopxData()
    {
        $data = array();
        $walletData = $this->sopx_transactions->where('customer_id', Auth::user()->id)->get();
        if (count($walletData) == 1) {
            array_push($data, 0);
        }
        foreach ($walletData as $key => $value) {
            array_push($data, $value['amount']);
        }
        return $data;
    }

    // /**
    //  * Validate Eth Transactions
    //  *
    //  * @return void
    //  */
    // public function validateEthTransactions()
    // {
    //     $transactions = $this->getEthTransactions();
    //     foreach ($transactions as $transaction) {
    //         $this->update($transaction, [
    //             "status" => WalletTransaction::STATUS['CANCELLED'],
    //         ]);
    //     }
    // }
}
