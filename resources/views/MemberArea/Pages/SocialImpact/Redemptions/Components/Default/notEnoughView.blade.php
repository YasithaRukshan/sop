<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card bg-transparent">
            <div class="card-body bg-transparent text-center">
                <h5 class="card-title mb-4 text-danger">Oops!. Your Reward balance is not enough For redeem</h5>
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <h6 class="h6">Available Rewards for Redeem</h6>
                        <h4 class="h4"> <strong>{!! $tc->ethPan(Auth::user()->wallet->rw_amount) !!}</strong></h4>
                    </div>
                    <div class="col-lg-6">
                        <h6 class="h6">Minimum Redeemable Amount</h6>
                        <h4 class="h4"> <strong>{!! $tc->ethPan(config('payments.redeem.minimum_rewards')) !!}</strong>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mt-4 text-center">
        <a href="{{ route('referrals') }}">
            <i class="fas fa-chevron-left"></i>
            Back To Share Page
        </a>
    </div>
</div>
