<div class="modal fade" id="withdrawmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <strong>Withdraw</strong> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Select Withdraw Currency</label>
                                <select class="form-control" name="" id="inp_with_currency">
                                    <option></option>
                                    <option>BTC</option>
                                    <option>ETH</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">SOAX Amount</label>
                                <input type="number" step="0.1" class="form-control" name="" id=""
                                    aria-describedby="helpId" placeholder="">
                                <small id="helpId" class="form-text text-muted"> Max: <strong>SOAX 500.00</strong>
                                </small>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h6 class="text-center">
                                <button class="btn btn-primary">Proceed <i class="fas fas-chevron-right"></i> </button>
                            </h6>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>