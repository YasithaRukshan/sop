<?php

namespace App\Traits;

use App\Models\WalletTransaction;
use domain\Facades\Convert\EthRateFacade;
use domain\Facades\TransactionFacade;

trait ReferralTransactionHelper
{
    /**
     * get status badge
     *
     * @param  mixed $status
     * @return void
     */
    public function getStatusName($status)
    {
        switch ($status) {
            case '1':
                return '<span class="badge badge-pill badge-warning">Pending</span>';
                break;
            case '2':
                return '<span class="badge badge-pill badge-success">Confirmed</span>';
                break;
            case '3':
                return '<span class="badge badge-pill badge-danger">Rejected</span>';
                break;
        }
    }

    /**
     * Get user name
     *
     * @param $date
     * @return void
     */
    public function getUserName($data)
    {
        if (isset($data->wallet->customer->first_name)) {
            return  $data->wallet->customer->first_name . ' ' . $data->wallet->customer->last_name;
        }
        return '-';
    }
    /**
     * getTypeAmount
     *
     * @param  mixed $acc_type
     * @param  mixed $redemptionAmount
     * @return void
     */
    public function getTypeAmount($acc_type, $redemptionAmount)
    {
        switch ($acc_type) {
            case 1:
                return 'BTC ' . $redemptionAmount;
                break;
            case 2:
                return 'ETH ' . $redemptionAmount;
                break;
            case 3:
                return 'SOAX ' . $redemptionAmount;
                break;
            default:
                break;
        }
    }

    /**
     * getTypeName
     *
     * @param  mixed $type
     * @return void
     */
    public function getTypeName($type)
    {
        switch ($type) {
            case 1:
                return ' <span class="badge badge-dark">Convert</span>';
                break;
            case 2:
                return ' <span class="badge badge-info">Transfer</span>';
                break;

            default:
                break;
        }
    }

    /**
     * getTypeName
     *
     * @param  mixed $type
     * @return void
     */
    public function getSOAXValue($usd)
    {
        return $usd / config('payments.soax_to_usd');
    }
    /**
     * getCommissionValue
     *
     * @param  mixed $usd
     * @return void
     */
    public function getCommissionValue($usd)
    {
        $ethVale = EthRateFacade::getLastEthRate($usd);
        return $ethVale . ' ETH ($ ' . number_format($usd, 2) . ')';
    }
    public function getTransactionType($transaction_id)
    {
        if ($transaction_id) {
            $transactionData = TransactionFacade::get($transaction_id);
            $type = $transactionData['type'];

            switch ($type) {
                case '1':
                    return  '<span class="badge badge-dark">ETH</span>';
                    break;
                case '2':
                    return  '<span class="badge badge-warning">BTC</span>';
                    break;
                case '3':
                    return  '<span class="badge badge-info">SOPX Auto</span>';
                    break;
                case '4':
                    return  '<span class="badge badge-primary">SOPX Auto</span>';
                    break;
                case '5':
                    return  '<span class="badge badge-secondary">Admin Action</span>';
                    break;
                case '6':
                    return  '<span class="badge badge-success">Auto Commissions</span>';
                case '7':
                    return  '<span class="badge badge-info">Commissions</span>';
                case '8':
                    return '<span class="badge badge-danger">Reward</span>';
                case '9':
                    return '<span class="badge badge-danger">Cash App</span>';
                case '10':
                    return '<span class="badge badge-danger">ZELLE</span>';
            }
        } else {
            return 'By admin';
        }
    }
}
