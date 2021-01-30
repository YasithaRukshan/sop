<div id="buy_soax_div" >
    Add more SOAX <span class="text-success"></span>
    <div class="dropdown d-inline-block">
        <a href="#" class="text-success" id="page-header-notifications-dropdown" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">click here</a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu p-0"
            aria-labelledby="page-header-notifications-dropdown">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0"> SOAX {!! Auth::user()->soax() !!}</h6>
                    </div>
                </div>
            </div>
            <div class="p-3">
                <form action="{{route('wallet.transactions.create')}}" method="GET" id="addsoaxValue">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Enter SOAX Amount To Purchase</label>
                                <input type="number" class="form-control" name="amount" id="amount"
                                    aria-describedby="helpId" placeholder="Enter SOAX Amount" type="number" step="0.01"
                                    min="{{ config('payments.minimum_soax') }}" required>
                                <small id="helpId" class="form-text text-muted">
                                    <strong>Min: <span class="text-danger"> {{ config('payments.minimum_soax') }}
                                        </span>
                                    </strong>
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
</div>
