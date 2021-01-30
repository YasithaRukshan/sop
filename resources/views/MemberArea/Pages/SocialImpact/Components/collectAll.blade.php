<div class="row mb-4">
    <div class="col-lg-9"></div>
    <div class="col-lg-3 float-right  bg-white">
        @if ($collectingReward>0)
        <h3 class="h3 text-left gf-title bg-white mt-4 rounded p-1">
            Collect All Rewards
            <a href="javascript:void(0)" onCLick="collectAllPayment()" style="float:right;border-radius:50%;"
                data-toggle="tooltip" data-placement="top" title="Click here to collect your ETH Rewards"
                class="btn btn-outline-dark btn-sm">
                <i class="fas fa-plus"></i>
            </a>
        </h3>
        @else
        <h3 class="h3 text-left gf-title bg-white mt-4 rounded p-1">
            Collect All  Rewards
            <a href="javascript:void(0)" style="float:right;border-radius:50%;"
                data-toggle="tooltip" data-placement="top" title="Reward Storage Empty"
                class="btn btn-outline-dark btn-sm">
                <i class="fas fa-plus"></i>
            </a>
        </h3>
        @endif
    </div>
</div>
