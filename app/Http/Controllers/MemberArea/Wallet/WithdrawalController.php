<?php

namespace App\Http\Controllers\MemberArea\Wallet;

use App\Http\Controllers\MemberArea\ParentController;
use App\Models\Withdrawal;
use App\Traits\modalHelper;
use App\Traits\UtilityHelper;
use App\Traits\WalletHelper;
use domain\Facades\BTCPaymentFacade;
use domain\Facades\TransactionFacade;
use domain\Facades\WithdrawalFacade;
use domain\Facades\WithdrawalSettingsFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends ParentController
{
    use WalletHelper;
    use modalHelper;
    use UtilityHelper;
    /**
     * View withdrawal by auth
     *
     * @param  mixed $request
     * @return void
     */
    public function index()
    {
        $response['tc'] = $this;
        $response['withdrawal'] = WithdrawalFacade::getByAuth();
        $response['settings'] = [];
        if (Auth::user()->wallet && $settings = Auth::user()->wallet->withdrawalSettings) {
            $response['settings'] = $settings;
        }
        return view('MemberArea.Pages.Wallet.Withdrawals.all')->with($response);
    }
    /**
     * create
     *
     * @param  mixed $request
     * @return void
     */
    public function create(Request $request)
    {
        $response = $this->getWithdrawalData();
        $response['amount'] = null;
        $response['tc'] = $this;
        if ($request->has('amount')) {
            $response['amount'] = $request->amount;
        }
        if (!isset($request->amount)) {
            $response['amount'] = 0;
        }
        return view('MemberArea.Pages.Wallet.Withdrawals.create')->with($response);
    }
    /**
     * Store Withdrawal Request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $status = WithdrawalFacade::make($request);
        if ($status) {
            return redirect(route('wallet.withdrawals.index'))->with('alert-success', 'Withdrawal Created Successfully');
        } else {
            return redirect(route('wallet.withdrawals.index'))->with('alert-danger', 'Can;t withdrawal this amount');
        }
    }
    /**
     * Get Btc Transaction View
     *
     * @param  mixed $request
     * @return void
     */
    public function getBtcTransaction(Request $request)
    {
        $response = BTCPaymentFacade::newAddress($request->all());
        return view('MemberArea.Pages.Wallet.New.Components.btcview')->with($response);
    }
    /**
     * Withdrawals settings
     *
     * @return void
     */
    public function settings()
    {
        $response['settings'] = [];
        if (Auth::user()->wallet && $settings = Auth::user()->wallet->withdrawalSettings) {
            $response['settings'] = $settings;
        }
        return view('MemberArea.Pages.Wallet.Withdrawals.settings')->with($response);
    }
    /**
     * Withdrawals Settings Store
     *
     * @param  mixed $request
     * @return void
     */
    public function settingsStore(Request $request)
    {
        WithdrawalSettingsFacade::make($request->all());
        return redirect()->back()->with('alert-success', 'Updated Successfully');
    }
}
