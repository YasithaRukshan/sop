<?php

namespace domain\wallet\WithdrawalService;

use App\Models\Withdrawal;
use App\Models\WithdrawalSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawalSettingsService
{
    protected $withdrawals_settings;
    protected $withdrawals;
    public function __construct()
    {
        $this->withdrawals_settings = new WithdrawalSettings();
        $this->withdrawals = new Withdrawal();
    }

    /**
     * get
     *
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->withdrawals_settings->find($id);
    }

    /**
     * get Account
     *
     * @param  mixed $type
     * @param  mixed $wallet_id
     * @return WithdrawalSettings
     */
    public function getAccount($type, $wallet_id)
    {
        return $this->withdrawals_settings->getAccount($type, $wallet_id);
    }

    /**
     * make
     *
     * @param  mixed $date
     * @return mixed
     */
    public function make($data)
    {
        if ($wallet = Auth::user()->wallet) {
            $data['wallet_id'] = $wallet->id;
            if ($settings = $wallet->withdrawalSettings) {
                return $this->update($settings, $data);
            } else {
                return $this->create($data);
            }
        }
    }

    /**
     * create
     *
     * @param  mixed $date
     * @return mixed
     */
    public function create($date)
    {
        return $this->withdrawals_settings->create($date);
    }

    /**
     * update
     *
     * @param  WithdrawalSettings $withdrawals_settings
     * @param  mixed $data
     * @return void
     */
    public function update(WithdrawalSettings $withdrawals_settings, array $data)
    {
        $withdrawals_settings->update($this->edit($withdrawals_settings, $data));
    }

    /**
     * edit
     *
     * @param  WithdrawalSettings $withdrawals_settings
     * @param  mixed $data
     * @return mixed
     */
    public function edit(WithdrawalSettings $withdrawals_settings, array $data)
    {
        return array_merge($withdrawals_settings->toArray(), $data);
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $withdrawals_setting = $this->get($id);
        $withdrawals_setting->delete();
    }

    /**
     * getTotalWithdrawals
     *
     * @return void
     */
    public function getTotalWithdrawals()
    {
        $users = $this->withdrawals
            ->where('customer_id', Auth::user()->id)
            ->where('status', 2)->get();
        $count = 0;
        foreach ($users as $value) {
            $count = $count + $value->sopx_amount;
        }
        return  number_format($count,4);
    }

    /**
     * getPendingWithdrawals
     *
     * @return void
     */
    public function getPendingWithdrawals()
    {
        $users = $this->withdrawals
            ->where('customer_id', Auth::user()->id)
            ->where('status', 1)->get();
        $count = 0;
        foreach ($users as $value) {
            $count = $count + $value->sopx_amount;
        }
        return  number_format($count,4);
    }
}
