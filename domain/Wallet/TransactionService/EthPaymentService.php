<?php

namespace domain\Wallet\TransactionService;

use App\Events\DepositConfirmationEvent;
use App\Models\WalletTransaction as WT;
use domain\Facades\TransactionFacade;
use domain\Facades\WalletFacade;
use Illuminate\Support\Facades\Http;


class EthPaymentService
{

    protected $apiKey;
    protected $api_url;
    protected $account;

    const APIURL = "https://api.etherscan.io/api/";
    const APIROPURL = "https://api-ropsten.etherscan.io/api/";
    const PARAMS = [
        "gas" => "?module=proxy&action=eth_gasPrice&apikey=",
        "gas_qty" => "?module=proxy&action=eth_estimateGas&",
        "gas_est" => "?module=gastracker&action=gasoracle&",
        "tx_verification" => "?module=transaction&action=getstatus&txhash=",
        "get_tx" => "?module=proxy&action=eth_getTransactionByHash&txhash=",
    ];

    public function __construct()
    {
        $this->apiKey = config('services.etherscan.api_key');
        $this->api_url = config('app.env') == "production" ? self::APIURL : self::APIROPURL;
        $this->account = config('app.env') == "production" ? config('ethProvider.pro.master_acc') : config('ethProvider.dev.master_acc');
    }

    /**
     * Initialize Scheduled Transaction Checker
     *!don't use any session/cookie based variable or anything inside the function
     * ! modifications are prohibited [Lathindu]
     * @return void
     */
    public function initScheduledTransactionChecker()
    {
        $available_transactions = TransactionFacade::notConfirmedEthTransactionsOverTime();
        foreach ($available_transactions as $key => $transaction) {
            if ($transaction->thash) {

                // event(new SOAXTransactionValidationEvent($transaction->thash));
                TransactionFacade::update($transaction, ["pjob" => WT::PJOB['TRUE']]);
                $this->validateInvoice($transaction->id);
            } else {
                $this->markAsCanceled($transaction);
            }
        }
    }
    /**
     * validate Invoice
     * !don't use any session/cookie based variable or anything inside the function
     * !modifications are prohibited [Lathindu]
     *
     * @param  mixed $invoice_id
     * @return mixed
     */
    public function validateInvoice($transaction_id)
    {
        $transaction = TransactionFacade::get($transaction_id);
        $transactionRsp = $this->getTransactionReceipt($transaction->thash);

        if ($transactionRsp && array_key_exists('result', $transactionRsp)) {
            $tr_data = $transactionRsp['result'];
            if (strtolower($tr_data['to']) == strtolower($this->account)) {
                return $this->saveTransaction($transaction);
            } else {
                return $this->markAsCanceled($transaction);
            }
        } else {
            return $this->markAsCanceled($transaction);
        }
    }
    /**
     * Mark As Success
     *
     * @param  mixed $transaction
     * @return mixed
     */
    public function saveTransaction($transaction)
    {
        TransactionFacade::update($transaction, [
            "status" => WT::STATUS['CONFIRMED'],
            "pjob" => WT::PJOB['FALSE'],
        ]);
        // Update Wallet balance
        if ($wallet = $transaction->wallet) {
            WalletFacade::update($wallet, [
                'amount' => $wallet->amount + $transaction->amount,
                "static_amount" => intval($wallet->static_amount + $transaction->amount),
            ]);
        }
        // fire deposit confirmation event for send emails and generate commissions
        event(new DepositConfirmationEvent($transaction));
    }
    /**
     * Mark As Canceled
     *
     * @param  mixed $transaction
     * @param  mixed $status
     * @return mixed
     */
    public function markAsCanceled($transaction)
    {
        return TransactionFacade::update($transaction, [
            "status" => WT::STATUS['CANCELLED'],
            "pjob" => WT::PJOB['FALSE'],
        ]);
    }
    /**
     * get Transaction
     *
     * @param  mixed $invoice_id
     * @return Array
     */
    public function getTransactionReceipt($transaction_hash)
    {
        $response = Http::get($this->api_url . self::PARAMS['get_tx'] . $transaction_hash . '&apikey=' . $this->apiKey);
        return $response->json();
    }
}
