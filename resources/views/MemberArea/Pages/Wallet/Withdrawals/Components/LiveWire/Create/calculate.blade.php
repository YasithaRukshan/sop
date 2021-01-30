<div class="card" wire:ignore>
    <div class="card-body">
        <div class="form-group">
            <label for="">Enter SOPX Amount Here <sup>[Min:1 SOPX]</sup> </label>
            <input type="number" class="form-control get-amount" name="sopx_amount" id="sopx_amount"
                placeholder="Enter Here.." autofocus onkeyup="getValueCurrency()" step="0.0001">
            <span id="helpId" class="form-text text-muted mb-1">
                Please Enter SOPX volume which you like to withdraw.
                <a href="javascript:void(0)" class="text-primary" onCLick="copyAmount('sopx_amount')">
                    Maximum: <strong id="maxValue">{{$withdrawalAmount}}</strong>
                </a>
            </span>
            <h6><span id="setSopxValue"></span> </strong><span id="setUSDValue"></span></h6>
        </div>
    </div>
</div>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="pills-convert-tab" name="withdraw_type" data-toggle="tab" href="#pills-convert"
            role="tab" aria-controls="pills-convert" aria-selected="true" value="1">Convert</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-transfer-tab" data-toggle="tab" name="withdraw_type" href="#pills-transfer"
            role="tab" aria-controls="pills-transfer" aria-selected="false" value="2">Transfer</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-convert" role="tabpanel" aria-labelledby="pills-convert-tab">
        <div class="card">
            <div class="card-body">
                <h6 class="text-left" for="">Select Account Type</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input acc_type" type="radio" name="acc_type" id="inlineRadio2" value="2"
                        checked>
                    <label class="form-check-label" for="inlineRadio2">ETH <strong> <span id="ethValue"></span>
                        </strong> </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input acc_type" type="radio" name="acc_type" id="inlineRadio3" value="3">
                    <label class="form-check-label" for="inlineRadio3">SOAX <strong> <span id="soaxValueSet"></span>
                        </strong> </label>
                </div>
                <small id="helpId" class="form-text text-muted mb-2">Select Your
                    desired convertion method</small>

                <div class="form-group text-left" id="inputAddress">
                    <label for="">Enter Recipient Address </label>
                    <input type="text" class="form-control" name="recipient" id="recipient"
                        placeholder="Enter Recipient Address" required>
                    <small id="helpId" class="form-text text-muted">Please Enter
                        Your <span id="currencyTypesName">BTC</span> Wallet where you would like to convert</small>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    var countData = 0;
    var wirteData = 0;
    var withdrawalAmount = parseFloat('{{$withdrawalAmount}}');
    $(document).ready(function () {
        getValueCurrency();
    });

    function getValueCurrency() {
        var new_amount = document.getElementById("sopx_amount").value;
        var acc_type = checkAcctype();
        $('#sub-btn').prop('disabled', true);
        if (new_amount) {
            countData = countData + 1;
            setLoader();
            @this.call('updateAmount', new_amount, acc_type);
        } else {
            alertDanger('Please Enter SOPX Amount');
        }
    }

    $(".acc_type").change(function () {
        var acc_type = checkAcctype();
        getValueCurrency();
        if (acc_type == 3) {
            $("#inputAddress").removeClass("d-none");
            $("#inputAddress").addClass("d-none");
            $("#divHandelingFee").removeClass("d-none");
            $("#divHandelingFee").addClass("d-none");
        } else {
            if (acc_type == 1) {
                $("#currencyTypesName").html("BTC");
            } else {
                $("#currencyTypesName").html("ETH");
            }
            $("#inputAddress").removeClass("d-none");
            $("#divHandelingFee").removeClass("d-none");
        }
    });

</script>
@endpush
