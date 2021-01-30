<form action='{{route('social.redemptions.store')}}' method="post" id="socialRedemptionsStore">
    @csrf
    <div class="row">
        <div class="col-lg-6 col-8">
            <livewire:socialimpact.redemption />
            <div class="card">
                <div class="card-body">
                    <h6 class="text-left" for="">Select Account Type</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input acc_type" checked type="radio" name="acc_type" id="inlineRadio2"
                            value="2">
                        <label class="form-check-label" for="inlineRadio2">Transfer ETH <strong> <span
                                    id="ethValue"></span>
                            </strong> </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input acc_type" type="radio" name="acc_type" id="inlineRadio3"
                            value="3">
                        <label class="form-check-label" for="inlineRadio3">Convert SOAX<strong> <span
                                    id="soaxValueSet"></span>
                            </strong> </label>
                    </div>
                    <small id="helpId" class="form-text text-muted mb-2">Convert Select Your
                        desired convertion method</small>

                    <div class="form-group text-left" id="inputAddress">
                        <label for="">Enter Recipient Address </label>
                        <input type="text" class="form-control" name="address" id="address"
                            placeholder="Enter Recipient Address" onkeyup="setValues()">
                        <small id="helpId" class="form-text text-muted">Please Enter
                            Your <span id="currencyTypesName">ETH</span> Wallet where you would like to convert</small>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-4">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="h1">ETH <strong id="usdToEthValue"></strong></h1>
                    <p>Available For Withdrawal</p>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="divHandelingFee">
                        <div class="row justify-content-center pt-4">
                            <div class="col-lg-2">
                                <h6>Your Request</h6>
                                <h6><span id="requestValue"></span><sup id="withOutFeeUsd"></sup></h6>
                            </div>
                            <div class="col-lg-1">
                                <h6> <strong>-</strong> </h6>
                            </div>
                            <div class="col-lg-2 text-danger">
                                <h6 class="text-danger">Handling Fee</h6>
                                <h6 class="text-danger"><span id="handlingFee"></span><sup id="feeUsd"></sup></h6>
                            </div>
                            <div class="col-lg-1">
                                <h6> <strong>=</strong> </h6>
                            </div>
                            <div class="col-lg-2 text-success">
                                <h6 class="text-success">You Will Receive</h6>
                                <h6 class="text-success"><span id="allfee"></span><sup id="withFeeUsd"></sup></h6>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <span id="loader"></span>
                        <input type="hidden" name="redemptionAmount" id="redemptionAmount">
                        <button type="submit" id="sub-btn" class="btn btn-primary ">Submit </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
