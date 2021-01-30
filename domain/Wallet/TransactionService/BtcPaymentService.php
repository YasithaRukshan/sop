<?php

namespace domain\Wallet\TransactionService;

use App\Events\DepositConfirmationEvent;
use App\Events\Wallet\SOAXTransactionValidationEvent;
use App\Models\WalletTransaction as WT;
use domain\Facades\TransactionFacade;
use domain\Facades\WalletFacade;
use Illuminate\Support\Facades\Http;

class BtcPaymentService
{

    protected $apiKey;
    protected $store_id;
    protected $url;
    const PART1 = "/api/v1/stores/";
    const TYPES = [
        "INVOICES" => "invoices/"
    ];
    const STATUS = [
        "NEW" => "New",
        "PROCESS" => "Processing",
        "SETTLED" => "Settled",
        "EXPIRED" => "Expired",
        "CONFIRMED" => "Confirmed",
        "COMPLETED" => "Complete",
        "INVALID" => "Invalid",
    ];
    const ADITIONALSTATUS = [
        "PAIDOVER" => "PaidOver",
        "PAIDPARTIAL" => "PaidPartial",
        "PAIDLATE" => "PaidLate",
        "MARKED" => "Marked",
        "NONE" => "None",
        "INVALID" => "Invalid",
    ];

    public function __construct()
    {
        $this->apiKey = config('btcPasyServer.apiKey');
        $this->store_id = config('btcPasyServer.storeId');
        $this->url = config('btcPasyServer.url');
    }

    /**
     * Initialize Scheduled Transaction Checker
     *!don't use any session/cookie based variable or anything inside the function
     * ! modifications are prohibited [Lathindu]
     * @return void
     */
    public function initScheduledTransactionChecker()
    {
        $available_transactions = TransactionFacade::notConfirmedBtcTransactionsOverTime();
        foreach ($available_transactions as $key => $transaction) {
            if ($transaction->thash) {
                // event(new SOAXTransactionValidationEvent($transaction->thash));
                TransactionFacade::update($transaction, ["pjob" => WT::PJOB['TRUE']]);
                $this->validateInvoice($transaction->thash);
            } else {
                $this->markAsCanceled($transaction, WT::STATUS['CANCELLED']);
            }
        }
    }
    /**
     * callback this is coming though outside
     * !don't use any session/cookie based variable or anything inside the function
     * ! modifications are prohibited [Lathindu]
     *
     * @param  mixed $request
     * @return void
     */
    public function callbackNew($request)
    {
        if ($data = $request->all()) {
            if ($transaction = TransactionFacade::getWithTxIdAndId($data['orderId'], $data['id'])) {

                // event(new SOAXTransactionValidationEvent($transaction->thash));
                TransactionFacade::update($transaction, ["pjob" => WT::PJOB['TRUE']]);
                return $this->validateInvoice($transaction->thash);
            }
        }
    }
    /**
     * validate Invoice
     *!don't use any session/cookie based variable or anything inside the function
     * ! modifications are prohibited [Lathindu]
     *
     * @param  mixed $invoice_id
     * @return void
     */
    public function validateInvoice($invoice_id)
    {
        $invoice = $this->getInvoice($invoice_id);
        if ($invoice && array_key_exists('metadata', $invoice) && array_key_exists('id', $invoice)) {
            $transaction = TransactionFacade::get($invoice['metadata']['orderId'] * 1);
            if ($transaction) {

                switch ($invoice['status']) {
                    case self::STATUS['NEW']:
                        //do nothing with new status
                        return TransactionFacade::update($transaction, ["pjob" => WT::PJOB['FALSE']]);
                        break;
                    case self::STATUS['PROCESS']:
                        //do nothing with process status
                        return TransactionFacade::update($transaction, ["pjob" => WT::PJOB['FALSE']]);
                        break;
                    case self::STATUS['SETTLED']:
                    case self::STATUS['CONFIRMED']:
                    case self::STATUS['COMPLETED']:
                        return $this->validateSuccessType($invoice, $transaction);
                        break;
                    case self::STATUS['EXPIRED']:
                        return  $this->validateExpiredType($invoice, $transaction);
                        break;
                    case self::STATUS['INVALID']:
                        # code...
                        return TransactionFacade::update($transaction, ["pjob" => WT::PJOB['FALSE']]);
                        break;
                }
            } else {
                return TransactionFacade::update($transaction, ["pjob" => WT::PJOB['FALSE']]);
            }
        } else {
            // update transaction if it have not valid invoice on BTCPAY server
            if ($transaction = TransactionFacade::getByInvoiceId($invoice_id)) {
                return $this->markAsCanceled($transaction, WT::STATUS['CANCELLED']);
            }
        }
    }
    /**
     * validate Success Transactions
     *
     * !don't use any session/cookie based variable or anything inside the function
     * ! modifications are prohibited [Lathindu]
     *
     * @param  mixed $invoice
     * @return void
     */
    public function validateSuccessType($invoice, $transaction)
    {
        switch ($invoice['additionalStatus']) {
            case self::ADITIONALSTATUS['PAIDOVER']:
                // save Transaction data
                return $this->saveTransaction($invoice, WT::STATUS['OVER_CONFIRMED'], $transaction);
                break;
            case self::ADITIONALSTATUS['PAIDPARTIAL']:
                // save Transaction data
                return $this->saveTransaction($invoice, WT::STATUS['PARTIALLY_CONFIRMED'], $transaction);
                break;
            case self::ADITIONALSTATUS['PAIDLATE']:
                // save Transaction data
                return $this->saveTransaction($invoice, WT::STATUS['CONFIRMED'], $transaction);
                break;
            case self::ADITIONALSTATUS['NONE']:
                // save Transaction data
                return $this->saveTransaction($invoice, WT::STATUS['CONFIRMED'], $transaction);
                break;
        }
    }
    /**
     * validate Expired Transactors
     *
     * !don't use any session/cookie based variable or anything inside the function
     * ! modifications are prohibited [Lathindu]
     *
     * @param  mixed $invoice
     * @param  mixed $transaction
     * @return void
     */
    public function validateExpiredType($invoice, $transaction)
    {
        switch ($invoice['additionalStatus']) {
            case self::ADITIONALSTATUS['PAIDOVER']:
                // save Transaction data
                return $this->saveTransaction($invoice, WT::STATUS['OVER_CONFIRMED'], $transaction);
                break;
            case self::ADITIONALSTATUS['PAIDPARTIAL']:
                // save Transaction data
                return $this->saveTransaction($invoice, WT::STATUS['PARTIALLY_CONFIRMED'], $transaction);
                break;
            case self::ADITIONALSTATUS['PAIDLATE']:
                // save Transaction data
                return $this->saveTransaction($invoice, WT::STATUS['LATE_PAYMENT'], $transaction);
                break;
            case self::ADITIONALSTATUS['NONE']:
                // Cancel Transaction data
                return $this->markAsCanceled($transaction, WT::STATUS['CANCELLED']);
                break;
        }
    }
    /**
     * save Transaction
     *
     * !don't use any session/cookie based variable or anything inside the function
     * ! modifications are prohibited [Lathindu]
     * @param  mixed $invoice
     * @param  mixed $status
     * @return void
     */
    public function saveTransaction($invoice, $status, $transaction)
    {
        $amount = intval($invoice['amount'] / config("payments.soax_to_usd"));
        TransactionFacade::update($transaction, [
            "status" => $status,
            "amount" => $amount,
            "rq_amount" => $transaction->amount,
            "pjob" => WT::PJOB['FALSE'],
        ]);
        // Update Wallet balance
        if ($wallet = $transaction->wallet) {
            WalletFacade::update($wallet, [
                'amount' => $wallet->amount + $amount,
                "static_amount" => intval($wallet->static_amount + $amount),
            ]);
        }
        // fire deposit confirmation event for send emails and generate commissions
        event(new DepositConfirmationEvent($transaction));
    }
    /**
     * mark As Canceled
     *
     * @param  mixed $transaction
     * @return void
     */
    public function markAsCanceled($transaction, $status)
    {
        return TransactionFacade::update($transaction, [
            "status" => $status,
            "pjob" => WT::PJOB['FALSE'],
        ]);
    }
    /**
     * get Invoice
     *
     * @param  mixed $invoice_id
     * @return Array
     */
    public function getInvoice($invoice_id)
    {
        $response = Http::withHeaders([
            'authorization' => $this->apiKey,
        ])->get($this->url . self::PART1 . $this->store_id . '/' . self::TYPES['INVOICES'] . $invoice_id);
        return $response->json();
    }

    /**
     * callback Validate Step1
     *
     * @param  mixed $request
     * @return void
     */
    public function callbackValidate($request)
    {
        if ($request->has('invoiceId') && $request->has('status') && $request->has('odid')) {
            if ($transaction = TransactionFacade::getWithAuth($request->odid)) {
                if ($request->has('status') == "paid") {
                    TransactionFacade::update($transaction, [
                        "status" => WT::STATUS['PAID'],
                        "thash" => $request->invoiceId,
                    ]);
                }
            }
            if ($transaction) {
                return ['status' => true, 'transaction' => TransactionFacade::get($transaction->id)];
            } else {
                // TODO: Error Request
                return ['status' => false, 'msg' => "Something Went Wrong"];
            }
        } elseif ($request->has('odid')) {
            if ($transaction = TransactionFacade::getWithAuth($request->odid)) {
                if (array_key_exists($transaction->status, [WT::STATUS['PAID'], WT::STATUS['CONFIRMED']])) {
                    return ['status' => true, 'transaction' => TransactionFacade::get($transaction->id)];
                }
            }
        }
        return ['status' => false, 'msg' => "Something Went Wrong"];
    }
}
