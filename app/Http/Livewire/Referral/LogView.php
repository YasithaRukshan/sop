<?php

namespace App\Http\Livewire\Referral;

use App\Models\Commission;
use App\Models\ShareRedemptions;
use App\Traits\ReferralTransactionHelper;
use App\Traits\UtilityHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class LogView extends   LivewireDatatable
{
    use ReferralTransactionHelper;
    use UtilityHelper;
    public $model = Commission::class;
    public $hideable = 'select';
    public $exportable = false;


    /**
     * builder
     *
     * @return void
     */
    public function builder()
    {
        return Commission::query()->where('wallet_id', Auth::user()->wallet->id);
    }

    /**
     * columns
     *
     * @return void
     */
    public function columns()
    {
        return [
            Column::callback(['wallet.user.first_name', 'wallet.user.last_name'], function ($first_name, $last_name) {
                return $first_name . ' ' . $last_name;
            })->label('Name')->searchable(),
            Column::callback(['amount'], function ($amount) {
                return $this->getSOAXValue($amount);
            })->label('SOAX Amount')->searchable(),
            Column::callback(['amount', 'id'], function ($amount, $id) {
                return $this->getCommissionValue($amount);
            })->label('Commission')->searchable(),
            Column::callback(['transaction_id'], function ($transaction_id) {
                return $this->getTransactionType($transaction_id);
            })->label('Source')->searchable(),
            Column::callback(['created_at'], function ($created_at) {
                return Carbon::parse($created_at)->format('M-d-Y H:i:s');
            })->label('Created Date')->searchable()
        ];
    }
}