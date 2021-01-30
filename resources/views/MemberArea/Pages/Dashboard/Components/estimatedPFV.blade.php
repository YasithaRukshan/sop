<div class="card">
    <div class="card-body border-top" style="position: relative;">
        <div class="row" style="height: 140px;">
            <div class="col-12 h-100">
                <div class="row h-100">
                    <div class="col-12">
                        <h6 class="text-muted h6"> Projected Portfolio Value <i data-toggle="tooltip"
                                data-tooltip="tooltip" data-placement="top" title="Projected value is based on current
                                average production of your oil well porftolios and current WTI crude oil price."
                                class="fas fa-info-circle"></i>
                        </h6>
                        <h3 class="h3">SOPX {{ $estimated_value_sopx }} </h3>
                        <h5 class="h5 text-left text-muted">(${{ $estimated_value_usd }})</h5>
                    </div>
                    <div class="col-12 align-self-end">
                        <a href="{{ route('calc') }}" class="btn btn-dark btn-sm mt-4" data-toggle="tooltip"
                            data-tooltip="tooltip" data-placement="top" title="Calculate Your Future Production">
                            <i class='fas fa-calculator'></i>
                            Calculator
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
