<!-- Modal -->
<div class="modal fade" id="cashAppModalId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-body pb-1">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <h2 class="modal-title h2">
                            <img style="width:30px;" src="{{ asset('MemberArea/images/coin/cashAppLogo.png') }}"
                                class="d-inline-block" alt="">
                            <strong>Pay With Cash App</strong>
                        </h2>
                        <hr>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <p class="h5 text-left"><strong>Step 1</strong>: Open Cash App on your device</p>

                    </div>
                    <div class="col-lg-12 mt-4">
                        <p class="h5 text-left"><strong class="h2">Step 2</strong>: Send payment of <span class="text-primary bg-light cappamount"></span> to
                            ID <span class="text-primary bg-light"> $HCSMSB </span> <u>with memo/note For <span
                                class="text-danger bg-light">SOP User ID : {{ Auth::user()->username }}</span></p></u>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <p class="h5 text-left"><strong>Step 3</strong>: After sending the payment, please click &apos;Payment Completed&apos; button bellow.
                        </p>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <button onClick="cancelCAppPayment()" class="btn btn-dark">Cancel</button>
                        <button onClick="completeCAppPayment()" class="btn btn-success">Confirm</button>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <h6 class=" h6">
                            The payment will be reviewed and correct amount of SOAX tokens will be addded to your
                            account withing <strong>24 Hours</strong>
                        </h6>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <h6 class="h6 text-danger"> <strong>For US Domestic Payment Only</strong> </h6>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <h6 class="text-muted h6">
                            *This service is provided by <strong>HyperCash Systems</strong> under
                            <strong>MSB licence 31000166591259</strong>
                            and has a <strong>standerd 5%</strong> processing fee.
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
