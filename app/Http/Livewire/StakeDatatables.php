<?php

namespace App\Http\Livewire;

use App\Models\Contract;
use App\Traits\FormHelper;
use App\Traits\UtilityHelper;
use App\Traits\WalletHelper;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class StakeDatatables extends LivewireDatatable
{
    use FormHelper;
    use WalletHelper;
    use UtilityHelper;
    public $hideable = 'select';
    public $exportable = true;

    public function builder()
    {
        return Contract::query()->where('customer_id', Auth::user()->id)
            ->leftJoin('portfolios', 'portfolios.id', 'contracts.portfolio_id');
    }
    public function columns()
    {
        return [
            Column::callback(['id'], function ($id) {
                return md5($id);
            })->label('Contract ID'),
            Column::name('portfolios.title')
                ->searchable()
                ->label('Portfolio'),
            DateColumn::name('created_at')
                ->searchable()
                ->label('Created Date'),

            Column::callback(['amount'], function ($amount) {
                return 'SOAX ' . $this->twoDecimal($amount);
            })->label('SOAX Staked'),

            Column::callback(['id', 'amount'], function ($id, $amount) {
                return 'SOPX ' . number_format($this->getContractProduction($id), 4);
            })->label('Production'),

            Column::callback(['id', 'customer_id'], function ($id, $customer_id) {
                return view('MemberArea.Pages.Contracts.Components.action-btn', ['id' => $id]);
            })->label('Actions')
        ];
    }
}
