<div class="dropdown d-inline-block">
    <a href="javascript: void(0);" class="h1" id="page-header-notifications-dropdown" data-toggle="dropdown"
        aria-haspopup="true" data-tooltip="tooltip" data-placement="top" title="Withdraw" aria-expanded="false">
        <small><i class='bx bx-wallet'></i></small>
    </a>
    <h6 class="text-drak"><small>Withdraw</small></h6>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu p-0" aria-labelledby="page-header-notifications-dropdown">
        <div class="p-3">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0"> SOPX </h6>
                </div>
            </div>
        </div>
        <div class="p-3">
            <form action="{{route('wallet.withdrawals.create')}}" method="GET" id="addsoaxValue">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Enter SOPX Amount To Withdraw</label>
                            <input type="number" class="form-control" name="amount" id="inp_amount"
                                aria-describedby="helpId" placeholder="Enter SOPX Amount" type="number" step="any"
                                required>
                            <small id="helpId" class="form-text text-muted"> 
                                <strong style="float: right"><span class="text-danger">1.5% transaction fee
                                    </span></strong>
                            </small>
                        </div>
                    </div>
                    <div class="col-12 ">
                        <h6 class="text-center">
                            <button class="btn btn-primary" type="submit"> <i class="fas fa-chevron-right"></i>
                                Next</button>
                        </h6>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
