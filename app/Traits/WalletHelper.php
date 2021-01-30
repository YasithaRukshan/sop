<?php

namespace App\Traits;

use App\Models\ContractProduction;
use App\Models\WalletTransaction;
use App\Models\Withdrawal;
use Carbon\Carbon;
use domain\Facades\CommissionsFacade;
use domain\Facades\Convert\EthRateFacade;
use domain\Facades\TransactionFacade;
use domain\Facades\WithdrawalFacade;
use domain\Facades\WithdrawalSettingsFacade;
use Illuminate\Support\Facades\Auth;

trait WalletHelper
{
    /**
     * get SOAX balance
     *
     * @param $id
     * @return void
     */
    public function getBalanceSOAX($formatted = false)
    {
        if ($formatted) {
            return number_format(Auth::user()->wallet->amount);
        } else {
            return Auth::user()->wallet->amount;
        }
    }
    /**
     * getPendingSOAX
     *
     * @param  mixed $formatted
     * @return void
     */
    public function getPendingSOAX($formatted = false)
    {
        if ($formatted) {
            return number_format(TransactionFacade::getPendingTransactions());
        } else {
            return TransactionFacade::getPendingTransactions();
        }
    }
    /**
     * create at for string
     *
     * @param $date
     * @return void
     */
    public function timeName($date)
    {
        return  Carbon::parse($date)->format('d M , Y H:i:s');
    }
    /**
     *two Decimal places
     *
     * @param $value
     * @return void
     */
    public function twoDecimal($value)
    {
        return   number_format($value, 2);
    }
    /**
     * zeroDecimal
     *
     * @param  mixed $value
     * @return void
     */
    public function zeroDecimal($value)
    {
        return   round($value, 0);
    }
    /**
     *get wallet amount
     *
     * @param $created_at
     * @return void
     */
    public function walletAmount()
    {
        return   Auth::user()->wallet->amount;
    }

    /**
     *transaction Type
     *
     * @param $created_at
     * @return void
     */
    public function transactionType($transaction)
    {
        switch ($transaction->type) {
            case WalletTransaction::TYPE['ETH']:
                $data = '<strong data-toggle="tooltip" data-placement="top" title="Ethereum Deposit By You"><i class="fab fa-ethereum text-info"> ETHD</i>';
                $data .= '<span class="badge badge-light">' . $transaction->value . '</span></strong>';
                break;
            case WalletTransaction::TYPE['BTC']:
                $data = '<strong data-toggle="tooltip" data-placement="top" title="Bitcoin Deposit By You"><i class="bx bxl-bitcoin text-success"> BTCD</i>';
                $data .= '<span class="badge badge-light">' . $transaction->value . '</span></strong>';
                break;
            case WalletTransaction::TYPE['SOPXAUTO']:
                $data = '<strong data-toggle="tooltip" data-placement="top" title="SOPX To SOAX Auto Conversion By System (According To Your Redemption Settings)"><img src="' . asset('MemberArea/images/sopx.png') . '" alt="" width="15" class="img-fluid  d-inline-block"> SOPXAC';
                $data .= '<span class="badge badge-light">' . number_format($transaction->value, 4) . '</span></strong>';
                break;
            case WalletTransaction::TYPE['SOPX']:
                $data = '<strong data-toggle="tooltip" data-placement="top" title="SOPX To SOAX Manual Conversion By You"><img src="' . asset('MemberArea/images/sopx.png') . '" alt="" width="15" class="img-fluid  d-inline-block"> SOPXMC';
                $data .= '<span class="badge badge-light">' . $transaction->value . '</span></strong>';
                break;
            case WalletTransaction::TYPE['ADMIN_ACTION']:
                $data = '<strong data-toggle="tooltip" data-placement="top" title="Admins Action"><i class="fas fa-user-shield text-danger"> AA</i>';
                $data .= '<span class="badge badge-light"> $' . $transaction->value . '</span></strong>';
                break;
            case WalletTransaction::TYPE['AUTOCOMMISSIONS']:
                $data = '<strong data-toggle="tooltip" data-placement="top" title="Commissions To SOAX Auto Conversion By System (According To Your Share Settings)"><i class="fas fa-ice-cream text-warning"> CAC</i>';
                $data .= '<span class="badge badge-light">' . $transaction->value . '</span></strong>';
                break;
            case WalletTransaction::TYPE['COMMISSIONS']:
                $data = '<strong data-toggle="tooltip" data-placement="top" title="Commissions To SOAX Manual Conversion By You"><i class="fas fa-ice-cream text-warning"> CMC</i>';
                $data .= '<span class="badge badge-light">' . $transaction->value . '</span></strong>';
                break;
            case WalletTransaction::TYPE['REWARD']:
                $data = '<strong data-toggle="tooltip" data-placement="top" title="Rewards To SOAX Manual Conversion By You"><i class="fas fa-ice-cream text-warning"> RMC</i>';
                $data .= '<span class="badge badge-light">' . $transaction->value . '</span></strong>';
                break;
            case WalletTransaction::TYPE['CAPP']:
                $data = '<strong data-toggle="tooltip" data-placement="top" title="Deposit By You Using Cash APP"><img src="' . asset('MemberArea/images/coin/cashAppLogo.png') . '" alt="" width="15" class="img-fluid  d-inline-block">';
                $data .= '<span class="badge badge-light">' . $transaction->value . ' USD</span></strong>';
                break;
            case WalletTransaction::TYPE['ZELLE']:
                $data = '<strong data-toggle="tooltip" data-placement="top" title="Deposit By You Using ZELLE APP"><img src="' . asset('MemberArea/images/coin/zelleLogo.jpg') . '" alt="" width="15" class="img-fluid  d-inline-block">';
                $data .= '<span class="badge badge-light">' . $transaction->value . ' USD</span></strong>';
                break;
        }
        return  $data;
    }
    /**
     *transaction Type
     *
     * @param $created_at
     * @return void
     */
    public function adminStatus($type)
    {
        if ($type == 0) {
            $data = '<span class="badge badge-pill badge-danger"> Admin Approve <br> within 48 hrs</span>';
        } else {
            $data = '<span class="badge badge-pill badge-success">Admin Approved</span>';
        }
        return  $data;
    }
    /**
     *transaction Type
     *
     * @param $created_at
     * @return void
     */
    public function adminStatusView($type)
    {
        if ($type == 0) {
            $data = '<span class="badge badge-pill badge-danger"> Admin Approve  within 48 hrs</span>';
        } else {
            $data = '<span class="badge badge-pill badge-success">Admin Approved</span>';
        }
        return  $data;
    }
    public function purchasesStatus($status)
    {
        switch ($status) {
            case WalletTransaction::STATUS['PENDING']:
                return '<span class="badge badge-warning">PENDING</span>';
                break;
            case WalletTransaction::STATUS['COMPLETED']:
                return '<span class="badge badge-primary">COMPLETED</span>';
                break;
            case WalletTransaction::STATUS['REJECTED']:
                return '<span class="badge badge-danger">REJECTED</span>';
                break;
            case WalletTransaction::STATUS['PAID']:
                return '<span class="badge badge-success">PAID </span>
                        <span class="badge badge-danger">
                        <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                        </div>
                        Pending For Confirmation</span>';
                break;
            case WalletTransaction::STATUS['CONFIRMED']:
                return '<span class="badge badge-info">CONFIRMED</span>';
                break;
            case WalletTransaction::STATUS['PARTIALLY_CONFIRMED']:
                return '<span class="badge badge-primary">PARTIALLY_CONFIRMED</span>';
                break;
            case WalletTransaction::STATUS['CANCELLED']:
                return '<span class="badge badge-dark">CANCELLED</span>';
            case WalletTransaction::STATUS['OVER_CONFIRMED']:
                return '<span class="badge badge-secondary">OVER CONFIRMED</span>';
            case WalletTransaction::STATUS['LATE_PAYMENT']:
                return '<span class="badge badge-light">LATE PAYMENT</span>';
            default:
                break;
        }
    }

    /**
     *get SOPX balance
     *
     * @param $created_at
     * @return void
     */
    public function getBalanceSOPX()
    {
        return number_format(Auth::user()->wallet->sopx ? Auth::user()->wallet->sopx : 0, 4);
    }
    /**
     * getAwaitingSOPX
     *
     * @return void
     */
    public function getAwaitingSOPX($format = true)
    {
        if ($format) {
            return number_format(Auth::user()->wallet->tp_sopx, 4);
        } else {
            return Auth::user()->wallet->tp_sopx;
        }
    }
    /**
     *get SOPX balance
     *
     * @param $created_at
     * @return void
     */
    public function getBalanceETH()
    {
        return number_format(Auth::user()->wallet->commissions ? Auth::user()->wallet->commissions : 0, 2);
    }
    /**
     * currentRewards
     *
     * @return void
     */
    public function currentRewards()
    {
        return Auth::user()->wallet->rw_amount ? Auth::user()->wallet->rw_amount : 0;
    }
    /**
     * current Total Rewards
     *
     * @return void
     */
    public function rewardTotal()
    {
        return Auth::user()->wallet->rw_amount_t ? Auth::user()->wallet->rw_amount_t : 0;
    }
    public function redemptionRewards()
    {
        return Auth::user()->wallet ? (Auth::user()->wallet->rw_amount_t - Auth::user()->wallet->rw_amount) : 0;
    }
    /**
     * rewards Collectible
     *
     * @param  mixed $reward
     * @return void
     */
    public function rewardsCollectible($reward)
    {
        return $reward->reward - $reward->reward_rd;
    }

    /**
     *get balance withdrew
     *
     * @param $created_at
     * @return void
     */
    public function getBalanceWithdrew()
    {
        $data = CommissionsFacade::authCommissionsData();
        $totalCommissions = 0;
        foreach ($data as $key => $value) {
            $totalCommissions = $totalCommissions + $value['amount'];
        }
        return number_format((((float)$totalCommissions) - ((float)Auth::user()->wallet->commissions)), 2);
    }

    /**
     *get balance total staked
     *
     * @param $created_at
     * @return void
     */
    public function getBalanceTotalStaked()
    {
        return number_format(0, 2);
    }

    /**
     *get redemption SOPX
     *
     * @param $created_at
     * @return void
     */
    public function getRedemptionSOPX()
    {
        return number_format(0, 2);
    }

    /**
     *get actionBtn
     *
     * @param $created_at
     * @return void
     */
    public function actionBtn($id)
    {
        return
            '<div class="dropleft no-arrow mb-1">' .
            '<a class="btn btn-sm btn-icon-only text-dark" href="#" role="button"' .
            ' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
            '<i class="fas fa-cog"></i>' .
            '</a>' .
            ' <div class="dropdown-menu dropdown-menu-left"' .
            'aria-labelledby="dropdownMenuButton" x-placement="bottom-start">' .
            '<a class="dropdown-item edit-portfolio"' .
            'href="javascript:void(0)"' .
            'onclick="contractTable(\'' . $id . '\')"' .
            'class="btn btn-warning" title="">' .
            '<i class="fas fa-edit"></i>&nbsp;View Contracts' .
            '</a>' .
            '</div>' .
            '</div>';
    }

    /**
     *get actionBtn
     *
     * @param $created_at
     * @return void
     */
    public function contractViewBtn($id)
    {
        return
            '<div class="dropleft no-arrow mb-1">' .
            '<a class="btn btn-sm btn-icon-only text-dark" href="#" role="button"' .
            ' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
            '<i class="fas fa-cog"></i>' .
            '</a>' .
            ' <div class="dropdown-menu dropdown-menu-left"' .
            'aria-labelledby="dropdownMenuButton" x-placement="bottom-start">' .
            '<a class="dropdown-item edit-portfolio"' .
            'href="' . route('contracts.view', md5($id)) . '"' .
            'class="btn btn-warning" title="">' .
            '<i class="fas fa-edit"></i>&nbsp;View & &nbsp;Log' .
            '</a>' .
            '</div>' .
            '</div>';
    }

    /**
     *get loader HTML
     *
     * @param $created_at
     * @return void
     */
    public function loaderHTML()
    {
        return  '<div class="text-center">
        <div class="spinner1 spinner-border" role="status">
        <span class="sr-only">Loading...</span>
        </div> </div>';
    }
    /**
     *get contract production
     *
     * @param
     * @return void
     */
    public function getContractProduction($id)
    {
        $tempData = ContractProduction::where('contract_id', $id)->get();
        $count = 0;
        foreach ($tempData as $key => $value) {
            $count = $count + $value['amount'];
        }
        return ($count);
    }

    /**
     *get withdrawal data
     *
     * @param
     * @return void
     */
    public function getWithdrawalData()
    {
        return TransactionFacade::withdrawalData();
    }

    /**
     * withdrawType
     *
     * @return void
     */
    public function withdrawType($type, $acc_type)
    {
        if ($type == 1) {
            $data = null;
            switch ($acc_type) {
                case Withdrawal::ACCTYPES['BTC']:
                    $data = '<span class="badge badge-pill badge-warning">BTC</span>';
                    break;
                case Withdrawal::ACCTYPES['ETH']:
                    $data = '<span class="badge badge-pill badge-dark">ETH</span>';
                    break;
                case Withdrawal::ACCTYPES['SOAX']:
                    $data = '<span class="badge badge-pill badge-success">SOAX</span>';
                    break;
            }
            return $data . '<br><span class="badge badge-secondary">Convert</span>';
        } else {
            return '<span class="badge badge-info">Transfer</span>';
        }
    }
    /**
     * withdrawAdminStatus
     *
     * @param  mixed $staus
     * @return void
     */
    public function withdrawAdminStatus($status)
    {
        switch ($status) {
            case Withdrawal::STATUS['PENDING']:
                return '<span class="badge badge-warning">Pending </span>
                <small class="badge badge-danger">
                <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
                </div>
                Waiting For Approval...</small>';
                break;

            case Withdrawal::STATUS['CONFIRMED']:
                return '<span class="badge badge-success">Confirmed</span>';
                break;
            case Withdrawal::STATUS['PENDING']:
                return '<span class="badge badge-danger">Rejected</span>';
                break;
        }
    }
    /**
     * withdrawAction
     *
     * @param  mixed $data
     * @return void
     */
    public function withdrawAction($data)
    {
        if ($data['status'] == 3) {
            return '<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
            data-target="#rejectModal" data-rejectreason="' . $data['reject_reason'] . '">Rejected Reason</button>';
        } else {
            return '-';
        }
    }

    /**
     * getTotalWithdrawals
     *
     * @return void
     */
    public function getTotalWithdrawals()
    {
        return WithdrawalSettingsFacade::getTotalWithdrawals();
    }

    /**
     * getPendingWithdrawals
     *
     * @return void
     */
    public function getPendingWithdrawals()
    {
        return WithdrawalSettingsFacade::getPendingWithdrawals();
    }

    /**
     * convertUSDToETH
     *
     * @param  mixed $USD
     * @return void
     */
    public function convertUSDToETH($usd)
    {
        return EthRateFacade::getLastEthRate($usd * 1);
    }
    /**
     * getWithdrawalsTotal
     *
     * @return void
     */
    public function getWithdrawalsPending()
    {
        $amountAvailable = WithdrawalFacade::getByAuthAvailable();
        $amountRedeemed = WithdrawalFacade::getByAuthRedeemed();
        $amount = $amountAvailable + $amountRedeemed;
        return number_format($amount, 4);
    }
    /**
     * getRedeemAutoConvertedBalance
     *
     * @return void
     */
    public function getRedeemAutoConvertedBalance($formatted = true)
    {
        $value = TransactionFacade::getByTypeAndAuth(WalletTransaction::TYPE['SOPXAUTO']);
        if ($formatted) {

            return number_format($value, 4);
        } else {
            return $value;
        }
    }

    /**
     * getWithdrawalsAvailable
     *
     * @return void
     */
    public function getRedeemAvailableBalance($formatted = true)
    {
        $amount = WithdrawalFacade::getByAuthRedeemAvailable();
        if ($formatted) {
            return number_format($amount, 4);
        } else {
            return $amount;
        }
    }
    /**
     * getWithdrawalsRedeemed
     *
     * @return void
     */
    public function getRedeemedBalance()
    {
        $amount = WithdrawalFacade::getByAuthRedeemed();
        return number_format($amount, 4);
    }
    /**
     * getWithdrawalsRedeem
     *
     * @return void
     */
    public function getRedeemPendingBalance($formatted = true)
    {
        $amount = WithdrawalFacade::getByAuthRedeemPending();
        if ($formatted) {
            return number_format($amount, 4);
        } else {
            return $amount;
        }
    }
    /**
     * WTTYPE
     *
     * @param  mixed $type
     * @return void
     */
    public function WTTYPE($type)
    {
        return WalletTransaction::TYPE[$type];
    }
}
