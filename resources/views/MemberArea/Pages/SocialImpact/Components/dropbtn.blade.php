@if ($total>0)
<a href="javascript:void(0)" onCLick="collectPayment({{ $reward->id }},{{ $total }})"
    style="float:right;border-radius:50%;" data-toggle="tooltip" data-placement="top"
    title="Click here to collect your {{ $total }} ETH Rewards" class="btn btn-outline-dark btn-sm">
    <i class="fas fa-plus"></i>
</a>
@else
<a href="javascript:void(0)" style="float:right;border-radius:50%;" data-toggle="tooltip" data-placement="top"
    title="Reward Storage Empty" class="btn btn-outline-secondary btn-sm">
    <i class="fas fa-plus"></i>
</a>
@endif
