<ul id="webTicker">
    <li>| <img src="{{ asset('MemberArea/images/soax.png') }}" width="23" alt="" class="img-thumbnail d-inline">
        <span class="text-t">
            <strong>1 SOAX = ${{ config('payments.soax_to_usd') }}</strong> at
            {{ \Carbon\Carbon::now()->format('M/d h:i a') }}
        </span>
    </li>
    <li>|
        <i class="fas fa-tint"></i>
        <span class="text-t">
            <strong class="badge badge-danger">${{ $oil_price->price }}</strong>
            WTI Oil Price at <span
                class="text-danger">{{ \Carbon\Carbon::parse($oil_price->created_at)->format('M/d h:i a') }}</span>
        </span>
    </li>
    <li>| <i class="ico-sopx"></i>
        <img src="{{ asset('MemberArea/images/sopx.png') }}" width="23" alt="" class="img-thumbnail d-inline">
        <span class="text-t">
            <strong>1 SOPX = ${{ $sopx->price-18 }}</strong> at
            {{ \Carbon\Carbon::parse($sopx->created_at)->format('M/d h:i a') }}
        </span>
    </li>
    <li>|

        <span class="text-t">
            <strong class="badge badge-success"><i class="fab fa-bitcoin"></i>
                ${{ number_format($btc->rate,2) }}</strong>
            Bitcoin Price In USD at
            <span class="text-success">{{ \Carbon\Carbon::parse($btc->created_at)->format('M/d h:i a') }}</span>
        </span>
    </li>
    <li>|
        <span class="text-t">
            <strong class="badge badge-warning"><i class="fab fa-ethereum"></i>
                ${{ number_format(1/$eth->rate,2) }}</strong>
            Ethereum Price In USD at <span
                class="text-warning">{{ \Carbon\Carbon::parse($eth->created_at)->format('M/d h:i a') }}</span>
        </span>
    </li>


</ul>
