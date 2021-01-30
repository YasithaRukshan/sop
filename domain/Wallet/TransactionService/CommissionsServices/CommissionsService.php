<?php

namespace domain\Wallet\TransactionService\CommissionsServices;

use App\Models\Commission;
use domain\Facades\WalletFacade;
use Illuminate\Support\Facades\Auth;

class CommissionsService
{
    protected $commissions;

    public function __construct()
    {
        $this->commissions = new Commission();
    }
    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        return $this->commissions->all();
    }
    public function getByTrIdAndUserId($wallet_id, $transaction_id)
    {
        return $this->commissions->getByTrIdAndUserId($wallet_id, $transaction_id);
    }
    /**
     * get
     *
     * @param  mixed $id
     * @return void
     */
    public function get($id)
    {
        return $this->commissions->find($id);
    }
    /**
     * create
     *
     * @param  mixed $request
     * @return void
     */
    public function create($request)
    {
        return $this->commissions->create($request);
    }
    /**
     * update
     *
     * @param  Commission $data
     * @return mixed
     */
    public function update(Commission $commissions, array $data)
    {
        $commissions->update($this->edit($commissions, $data));
    }
    /**
     * edit
     *
     * @param  Commission $transactions
     * @param  mixed $data
     * @return mixed
     */
    public function edit(Commission $commissions, $data)
    {
        return array_merge($commissions->toArray(), $data);
    }
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($commissions)
    {
        return  $commissions->delete();
    }
    /**
     * SendSOAXCommissions
     *!this commissions only generate for direct referrer
     * @param  mixed $transaction
     * @return void
     */
    public function SendSOAXCommissions($transaction)
    {
        $wallet = $transaction->wallet;
        $user = $wallet->user;
        $levels = config('commissions.levels');
        $referrer = $user->referrer; //this is level01 [direct referrer]
        foreach ($levels as $level_key => $level) {
            //check if parent referrer exists.
            if ($referrer) {
                $this->generateCommissions($user, $referrer, $transaction, $level_key, $level);
                $referrer = $referrer->referrer;
            }
        }
    }
    /**
     * generateCommissions
     *
     * !Here transaction amount is coming as SOAX
     * !we store commissions values as USD amount   [10 SOAX = 1 USD]
     * @param  mixed $user
     * @param  mixed $referrer
     * @param  mixed $transaction
     * @param  mixed $level_key
     * @param  mixed $level
     * @return void
     */
    public function generateCommissions($user, $referrer, $transaction, $level_key, $level)
    {
        $commission = $this->getByTrIdAndUserId($user->wallet->id, $transaction->id);
        if (!$commission) {
            // Calculate amount as Usd [10 SOAX = 1 USD]
            $amount = (intval($transaction->amount) * $level) * config('payments.soax_to_usd');
            $commission = $this->create([
                "wallet_id" => $referrer->wallet->id,
                "parent_wallet_id" => $user->wallet->id,
                "transaction_id" => $transaction->id,
                "amount" => $amount,
                "level" => $level_key,
                "status" => Commission::STATUS['CONFIRMED'],
            ]);
            // Update wallet temporarily Commissions
            WalletFacade::update($referrer->wallet, [
                "tp_commissions" => ($referrer->wallet->tp_commissions + $amount),
            ]);
        }
    }
    /**
     * Get auth commissions
     *
     * @return void
     */
    public function authCommissionsData()
    {
        return $this->commissions->where('wallet_id', Auth::user()->wallet->id)->get();
    }
    /**
     * getReferralsCommissions
     *
     * @param  mixed $parent_wallet_id
     * @param  mixed $wallet_id
     * @return void
     */
    public function getReferralsCommissions($wallet_id, $parent_wallet_id)
    {
        return $this->commissions->where('wallet_id', $wallet_id)
            ->where('parent_wallet_id', $parent_wallet_id)
            ->sum('amount');
    }
}
