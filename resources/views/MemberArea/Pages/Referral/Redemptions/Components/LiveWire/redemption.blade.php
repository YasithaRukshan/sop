<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Enter Amount Here</label>
                    <input type="number" class="form-control" name="amount" step="any" id="inp_amount" placeholder="Enter Amount Here"
                        aria-describedby="helpId" onkeyup="getValueCurrency()">
                    <input type="hidden" name="eth_rate_id" value="{{$lastEth['id']}}">
                    <span id="helpId" class="form-text text-muted mb-1">
                        <a href="javascript:void(0)" class="text-primary" onCLick="copyAmount('inp_amount')">
                            Maximum Redeemable Amount: <strong id="maxValue">{{$this->maxEthValue}}
                                <small>(${{ number_format($withdrawalAmount,2) }})</small></strong>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    var countData = 0;
    var wirteData = 0;
    var new_amount = 0;
    var new_address = 0;
    var withdrawalAmount = '{{$withdrawalAmount}}';
    var maxEthValue = parseFloat('{{$this->maxEthValue}}');
    withdrawalAmount = parseFloat(withdrawalAmount);
    var redeem_min_value = parseFloat('{{$this->minEthValue}}');

    $(document).ready(function () {
        // getValueCurrency();
        console.log(redeem_min_value);
        $("#usdToEthValue").html(maxEthValue);
        $("#setMaxAmount").html(maxEthValue);
    });

    function getValueCurrency() {
        new_amount = document.getElementById("inp_amount").value;
        new_address = document.getElementById("address").value;
        var acc_type = checkAcctype();
        if (new_amount) {
            setInputLoader();
            $('#sub-btn').prop('disabled', true);
            countData = countData + 1;
            @this.call('updateAmount', new_amount, acc_type, new_address);
        }

    }

    function setValues() {
        new_amount = document.getElementById("inp_amount").value;
        new_address = document.getElementById("address").value;
    }
    $(".acc_type").change(function () {
        sttAccType()
    });

    function sttAccType() {
        var acc_type = checkAcctype();
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
    }

</script>
@endpush
