<span class="soax-amount-nav d-none d-lg-block  d-md-block ">
    <span class="label-icon">Available SOAX</span>:
    <strong>{{ number_format(Auth::user()->wallet->amount) }}</strong>
    <div class="dropdown d-inline-block">
        <a href="{{ route('wallet.transactions.create')}}" class="h3 mt-4"
            data-tooltip="tooltip"  title="Deposit"><small><i class='bx bx-add-to-queue'></i> </small><br>
        </a>

    </div>
    {{-- @include('MemberArea.Includes.Components.add_wallet') --}}
</span>
