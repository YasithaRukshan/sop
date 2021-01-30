<?php

namespace App\Http\Controllers\MemberArea;

use App\Events\DepositConfirmationEvent;
use App\Events\Wallet\SOAXTransactionValidationEvent;
use App\Http\Controllers\MemberArea\ParentController;
use App\Models\Contract;
use App\Models\WalletTransaction;
use App\Traits\ReferralsHelper;
use App\Traits\WalletHelper;
use Carbon\Carbon;
use domain\Facades\AutoConversionFacades\CommissionsAutoConversionFacade;
use domain\Facades\BTCPaymentFacade;
use domain\Facades\CommissionsFacade;
use domain\Facades\ContractsFacade;
use domain\Facades\ETHPaymentFacade;
use domain\Facades\MemberSOAXFacade;
use domain\Facades\StakeFacades\StakeRewardFacade;
use domain\Facades\TransactionFacade;
use domain\Facades\WalletFacade;
use Illuminate\Http\Request;

class HomeController extends ParentController
{
    use WalletHelper;
    use ReferralsHelper;
    /**
     * View Auth Dashboard
     *
     * @return void
     */
    public function index(Request $request)
    {
        $response['tc'] = $this;
        return view('MemberArea.Pages.Dashboard.dashboard')->with($response);
    }

    /**
     * walletData
     *
     * @return void
     */
    public function walletData()
    {

        return TransactionFacade::walletData();
    }

    /**
     * contractProduction
     *
     * @return void
     */
    public function contractProduction()
    {

        return ContractsFacade::contractProduction();
    }
    /**
     * sopxData
     *
     * @return void
     */
    public function sopxData()
    {
        return TransactionFacade::sopxData();
    }
    /**
     * fix The Rewards for important
     *! don't chnage anything here [Lathindu]
     * @return void
     */
    public function fixTheRewards()
    {
        // foreach (Contract::all() as $contract) {
        //     StakeRewardFacade::initializeRewards($contract->id);
        // }
        // dd("done");
    }
    public function testTr()
    {

        $arr = [];
        foreach (TransactionFacade::notConfirmedBtcTransactionsOverTimeTest() as $key => $tr) {

            if ($tr->thash) {
                $dd = BTCPaymentFacade::getInvoice($tr->thash);
                if ($dd && $dd['status'] != "Expired") {
                    $arr[$key]['p'] = BTCPaymentFacade::getInvoice($tr->thash);
                    $arr[$key]['tr'] = $tr;

                    // event(new SOAXTransactionValidationEvent($tr->thash));
                    // TransactionFacade::update($tr, ["pjob" =>1]);
                    BTCPaymentFacade::validateInvoice($tr->thash);
                }
            }
        }
        dd($arr);
    }
    public function fixthetr()
    {
        return "he he no data";
        $json = json_decode(file_get_contents(asset('acc2.json')), true);
        $arr = [];
        foreach ($json as $key => $tr) {

            // dd($tr['Id']);
            if ($transaction = TransactionFacade::get($tr['Id'])) {

                $wallet = $transaction->wallet;
                // dd($wallet, $transaction, $tr);
                $w_soax = $wallet->amount;
                $w_s_soax = $wallet->static_amount;

                $tr_soax = $transaction->amount;

                switch ($tr['Type']) {
                    case 'PaidOver':
                        $paid_soax = intval($tr['SOAX']);
                        $have_to_add = $paid_soax - $tr_soax;
                        $t = TransactionFacade::update($transaction, [
                            "amount" => $paid_soax,
                            "value" => $tr['BTC Total'],
                            "rq_amount" => $transaction->amount,
                            "status" => WalletTransaction::STATUS['OVER_CONFIRMED'],
                        ]);
                        WalletFacade::update($wallet, [
                            "amount" => $wallet->amount + $have_to_add,
                            "static_amount" => $wallet->static_amount + $have_to_add,
                        ]);
                        $arr[] = [$transaction, 'OVER_CONFIRMED'];
                        break;
                    case 'PaidLater':
                        $paid_soax = intval($tr['SOAX']);
                        $t = TransactionFacade::update($transaction, [
                            "amount" => $paid_soax,
                            "value" => $tr['BTC Total'],
                            "rq_amount" => $transaction->amount,
                            "status" => WalletTransaction::STATUS['LATE_PAYMENT'],
                        ]);
                        WalletFacade::update($wallet, [
                            "amount" => $wallet->amount + $paid_soax,
                            "static_amount" => $wallet->static_amount + $paid_soax,
                        ]);
                        $arr[] = [$transaction, 'LATE_PAYMENT'];
                        break;
                    case 'PaidPartial':
                        $paid_soax = intval($tr['SOAX']);
                        $t = TransactionFacade::update($transaction, [
                            "amount" => $paid_soax,
                            "value" => $tr['BTC Total'],
                            "rq_amount" => $transaction->amount,
                            "status" => WalletTransaction::STATUS['PARTIALLY_CONFIRMED'],
                        ]);
                        WalletFacade::update($wallet, [
                            "amount" => $wallet->amount + $paid_soax,
                            "static_amount" => $wallet->static_amount + $paid_soax,
                        ]);
                        $arr[] = [$transaction, 'PARTIALLY_CONFIRMED'];
                        break;
                        break;
                    case 'Complete':
                        $paid_soax = intval($tr['SOAX']);
                        $t = TransactionFacade::update($transaction, [
                            "amount" => $paid_soax,
                            "value" => $tr['BTC Total'],
                            "rq_amount" => $transaction->amount,
                            "status" => WalletTransaction::STATUS['CONFIRMED'],
                        ]);
                        WalletFacade::update($wallet, [
                            "amount" => $wallet->amount + $paid_soax,
                            "static_amount" => $wallet->static_amount + $paid_soax,
                        ]);
                        $arr[] = [$transaction, 'CONFIRMED'];
                        break;
                }
                CommissionsFacade::SendSOAXCommissions(TransactionFacade::get($tr['Id']));
            }
        }
        dd($arr);
    }
    /**
     * knowledgeBase
     *
     * @return void
     */
    public function knowledgeBase()
    {
        return view('MemberArea.Pages.Knowledge.index');
    }
}
