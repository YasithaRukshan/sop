<?php

namespace App\Http\Livewire\Referral;

use App\Models\ShareRedemptions;
use App\Traits\ReferralTransactionHelper;
use App\Traits\UtilityHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class Transasctions extends  LivewireDatatable
{
    use ReferralTransactionHelper;
    use UtilityHelper;

    public $model = ShareRedemptions::class;
    public $hideable = 'select';
    public $exportable = false;


    /**
     * builder
     *
     * @return void
     */
    public function builder()
    {
        return ShareRedemptions::query()->where('wallet_id', Auth::user()->wallet->id);
    }

    /**
     * columns
     *
     * @return void
     */
    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('#')
                ->defaultSort('desc'),
            // Column::callback(['amount'], function ($amount) {
            //     return '$ ' . number_format((float)($amount), 2);
            // })->label('Amount'),
            Column::name('address')->label('Address'),
            Column::callback(['acc_type', 'red_amount'], function ($type, $redemptionAmount) {
                return $this->getTypeAmount($type, $redemptionAmount);
            })->label('Calculated Amount'),
            Column::callback(['type'], function ($type) {
                return $this->getTypeName($type);
            })->label('Type'),
            Column::callback(['status'], function ($status) {
                return $this->getStatusName($status);
            })->label('Status'),
            Column::callback(['created_at'], function ($created_at) {
                return Carbon::parse($created_at)->format('M-d-Y H:i:s');
            })->label('Created Date')
        ];
    }
}
